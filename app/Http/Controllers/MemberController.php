<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Member::query();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $members = $query->withCount('loans')->latest()->paginate(10);
        
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate member ID
        $lastMember = Member::orderBy('id', 'desc')->first();
        $memberId = 'MBR' . str_pad(($lastMember ? $lastMember->id + 1 : 1), 5, '0', STR_PAD_LEFT);
        
        return view('members.create', compact('memberId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|string|max:20|unique:members',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'join_date' => 'required|date',
        ]);

        $data = $request->all();
        $data['status'] = 'active';

        Member::create($data);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $member->load(['loans.book']);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if ($member->loans()->where('status', 'borrowed')->count() > 0) {
            return redirect()->route('members.index')
                ->with('error', 'Anggota tidak dapat dihapus karena masih memiliki pinjaman aktif!');
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
