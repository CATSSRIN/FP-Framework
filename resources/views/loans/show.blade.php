@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Detail Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Buku</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Judul</th>
                                <td>{{ $loan->book->title }}</td>
                            </tr>
                            <tr>
                                <th>Penulis</th>
                                <td>{{ $loan->book->author }}</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>{{ $loan->book->isbn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td><span class="badge bg-secondary">{{ $loan->book->category->name }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Anggota</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">ID Anggota</th>
                                <td><code>{{ $loan->member->member_id }}</code></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $loan->member->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $loan->member->email }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $loan->member->phone ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="text-muted">Informasi Peminjaman</h6>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="140">Tanggal Pinjam</th>
                                <td>{{ $loan->loan_date->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jatuh Tempo</th>
                                <td>
                                    @if($loan->status === 'overdue')
                                    <span class="text-danger">{{ $loan->due_date->format('d F Y') }}</span>
                                    @else
                                    {{ $loan->due_date->format('d F Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Durasi Pinjam</th>
                                <td>{{ $loan->loan_date->diffInDays($loan->due_date) }} hari</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="140">Tanggal Kembali</th>
                                <td>{{ $loan->return_date ? $loan->return_date->format('d F Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($loan->status === 'borrowed')
                                    <span class="badge bg-primary fs-6">Dipinjam</span>
                                    @elseif($loan->status === 'returned')
                                    <span class="badge bg-success fs-6">Dikembalikan</span>
                                    @else
                                    <span class="badge bg-danger fs-6">Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Denda</th>
                                <td>
                                    @if($loan->fine_amount > 0)
                                    <span class="text-danger fw-bold fs-5">Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-success">Tidak ada denda</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($loan->notes)
                <hr>
                <h6 class="text-muted">Catatan</h6>
                <p>{{ $loan->notes }}</p>
                @endif
                
                <hr>
                
                <div class="d-flex gap-2">
                    @if($loan->status !== 'returned')
                    <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi pengembalian buku?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>Kembalikan Buku
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('loans.edit', $loan) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
