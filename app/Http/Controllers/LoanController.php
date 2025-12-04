<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member']);
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('book', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })->orWhereHas('member', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%");
            });
        }
        
        // Check and update overdue loans
        Loan::where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);
        
        $loans = $query->latest()->paginate(10);
        
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('available_stock', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        
        return view('loans.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
            'notes' => 'nullable|string',
        ]);

        $book = Book::findOrFail($request->book_id);
        
        if ($book->available_stock <= 0) {
            return redirect()->back()
                ->with('error', 'Buku tidak tersedia untuk dipinjam!')
                ->withInput();
        }

        $member = Member::findOrFail($request->member_id);
        
        if ($member->status !== 'active') {
            return redirect()->back()
                ->with('error', 'Anggota tidak aktif!')
                ->withInput();
        }

        // Create loan
        Loan::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'notes' => $request->notes,
            'status' => 'borrowed',
        ]);

        // Decrease available stock
        $book->decrement('available_stock');

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $loan->load(['book', 'member']);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $books = Book::all();
        $members = Member::all();
        
        return view('loans.edit', compact('loan', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $loan->update([
            'due_date' => $request->due_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    /**
     * Return a book
     */
    public function returnBook(Request $request, Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Buku sudah dikembalikan!');
        }

        $returnDate = Carbon::now();
        $fineAmount = 0;

        // Calculate fine if overdue (Rp 1000 per day)
        if ($returnDate->gt($loan->due_date)) {
            $daysOverdue = $returnDate->diffInDays($loan->due_date);
            $fineAmount = $daysOverdue * 1000;
        }

        $loan->update([
            'return_date' => $returnDate,
            'status' => 'returned',
            'fine_amount' => $fineAmount,
        ]);

        // Increase available stock
        $loan->book->increment('available_stock');

        $message = 'Buku berhasil dikembalikan!';
        if ($fineAmount > 0) {
            $message .= ' Denda: Rp ' . number_format($fineAmount, 0, ',', '.');
        }

        return redirect()->route('loans.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        if ($loan->status === 'borrowed') {
            // Restore book stock if loan is being deleted
            $loan->book->increment('available_stock');
        }

        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
