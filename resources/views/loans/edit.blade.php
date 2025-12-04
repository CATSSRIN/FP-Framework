@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Peminjaman</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('loans.update', $loan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Buku</label>
                        <input type="text" class="form-control" value="{{ $loan->book->title }} - {{ $loan->book->author }}" readonly disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Anggota</label>
                        <input type="text" class="form-control" value="{{ $loan->member->member_id }} - {{ $loan->member->name }}" readonly disabled>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" value="{{ $loan->loan_date->format('Y-m-d') }}" readonly disabled>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jatuh Tempo <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}" required>
                            @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div>
                            @if($loan->status === 'borrowed')
                            <span class="badge bg-primary fs-6">Dipinjam</span>
                            @elseif($loan->status === 'returned')
                            <span class="badge bg-success fs-6">Dikembalikan</span>
                            @else
                            <span class="badge bg-danger fs-6">Terlambat</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $loan->notes) }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Perbarui
                        </button>
                        @if($loan->status !== 'returned')
                        <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi pengembalian buku?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i>Kembalikan Buku
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
