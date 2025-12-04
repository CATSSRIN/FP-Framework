@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                    <span style="font-size: 48px;">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                </div>
                
                <h4>{{ $member->name }}</h4>
                <p class="text-muted"><code>{{ $member->member_id }}</code></p>
                
                <div class="mb-3">
                    @if($member->status === 'active')
                    <span class="badge bg-success fs-6">Aktif</span>
                    @else
                    <span class="badge bg-danger fs-6">Tidak Aktif</span>
                    @endif
                </div>
                
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Kontak</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="100"><i class="bi bi-envelope me-2"></i>Email</th>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-phone me-2"></i>Telepon</th>
                        <td>{{ $member->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-geo-alt me-2"></i>Alamat</th>
                        <td>{{ $member->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar me-2"></i>Gabung</th>
                        <td>{{ $member->join_date->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $member->loans->count() }}</h3>
                            <small>Total Pinjaman</small>
                        </div>
                        <i class="bi bi-book" style="font-size: 36px; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card green">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $member->loans->where('status', 'borrowed')->count() }}</h3>
                            <small>Sedang Dipinjam</small>
                        </div>
                        <i class="bi bi-arrow-right" style="font-size: 36px; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card red">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $member->loans->where('status', 'overdue')->count() }}</h3>
                            <small>Terlambat</small>
                        </div>
                        <i class="bi bi-exclamation-triangle" style="font-size: 36px; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($member->loans as $loan)
                            <tr>
                                <td>{{ Str::limit($loan->book->title, 30) }}</td>
                                <td>{{ $loan->loan_date->format('d M Y') }}</td>
                                <td>{{ $loan->due_date->format('d M Y') }}</td>
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
                                    <span class="text-danger">Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</span>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada riwayat peminjaman
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
