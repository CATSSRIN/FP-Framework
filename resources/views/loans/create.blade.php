@extends('layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-plus-lg me-2"></i>Peminjaman Buku Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                        <select name="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->title }} - {{ $book->author }} (Tersedia: {{ $book->available_stock }})
                            </option>
                            @endforeach
                        </select>
                        @error('book_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($books->isEmpty())
                        <small class="text-danger">Tidak ada buku yang tersedia untuk dipinjam</small>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                        <select name="member_id" class="form-select @error('member_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->member_id }} - {{ $member->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('member_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="loan_date" class="form-control @error('loan_date') is-invalid @enderror" value="{{ old('loan_date', date('Y-m-d')) }}" required>
                            @error('loan_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jatuh Tempo <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
                            @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Default: 14 hari dari tanggal pinjam</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Perhatian:</strong> Denda keterlambatan adalah Rp 1.000 per hari.
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" {{ $books->isEmpty() ? 'disabled' : '' }}>
                            <i class="bi bi-check-lg me-1"></i>Simpan Peminjaman
                        </button>
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
