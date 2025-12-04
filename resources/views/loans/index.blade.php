@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0"><i class="bi bi-arrow-left-right me-2"></i>Daftar Peminjaman</h5>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('loans.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Peminjaman Baru
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <form action="{{ route('loans.index') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul buku atau nama anggota..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                    </a>
                </div>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Buku</th>
                        <th>Anggota</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $index => $loan)
                    <tr>
                        <td>{{ $loans->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ Str::limit($loan->book->title, 25) }}</strong>
                        </td>
                        <td>
                            {{ $loan->member->name }}
                            <br><small class="text-muted">{{ $loan->member->member_id }}</small>
                        </td>
                        <td>{{ $loan->loan_date->format('d M Y') }}</td>
                        <td>
                            @if($loan->status === 'overdue')
                            <span class="text-danger">{{ $loan->due_date->format('d M Y') }}</span>
                            @else
                            {{ $loan->due_date->format('d M Y') }}
                            @endif
                        </td>
                        <td>{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</td>
                        <td>
                            @if($loan->status === 'borrowed')
                            <span class="badge bg-primary">Dipinjam</span>
                            @elseif($loan->status === 'returned')
                            <span class="badge bg-success">Dikembalikan</span>
                            @else
                            <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>
                            @if($loan->fine_amount > 0)
                            <span class="text-danger fw-bold">Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</span>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @if($loan->status !== 'returned')
                                <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi pengembalian buku?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success" title="Kembalikan">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('loans.edit', $loan) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 48px;"></i>
                            <p class="mt-2">Belum ada data peminjaman</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end">
            {{ $loans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
