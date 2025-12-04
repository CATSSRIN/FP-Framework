@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Daftar Buku</h5>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Buku
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <form action="{{ route('books.index') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, ISBN..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary w-100">
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
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>ISBN</th>
                        <th width="100">Stok</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $book->title }}</strong>
                            @if($book->publication_year)
                            <br><small class="text-muted">{{ $book->publication_year }}</small>
                            @endif
                        </td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge bg-secondary">{{ $book->category->name }}</span></td>
                        <td>{{ $book->isbn ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $book->available_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->available_stock }}/{{ $book->stock }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
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
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 48px;"></i>
                            <p class="mt-2">Belum ada data buku</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end">
            {{ $books->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
