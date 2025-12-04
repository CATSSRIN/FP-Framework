<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_categories' => Category::count(),
            'total_members' => Member::count(),
            'active_loans' => Loan::where('status', 'borrowed')->count(),
            'overdue_loans' => Loan::where('status', 'overdue')->count(),
            'returned_today' => Loan::whereDate('return_date', today())->count(),
        ];

        $recentLoans = Loan::with(['book', 'member'])
            ->latest()
            ->limit(5)
            ->get();

        $overdueLoans = Loan::with(['book', 'member'])
            ->where('status', 'overdue')
            ->limit(5)
            ->get();

        $popularBooks = Book::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentLoans', 'overdueLoans', 'popularBooks'));
    }
}
