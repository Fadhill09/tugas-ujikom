<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Daftar Menu | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

 @include('style.admin')
</head>

<body>

    @include('admin.pages.header')

    @include('admin.pages.sidebar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Menu</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="container">
                    <!-- Tombol untuk memunculkan modal -->
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#tambahProdukModal">
                        Tambah Produk
                    </button>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            {{-- <th>Foto</th> --}}
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            {{-- <th>Deskripsi</th> --}}
                            <th>Aksi</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                {{-- <td>
                                    @if ($product->foto)
                                        <img src="{{ asset('storage/' . $product->foto) }}" width="80">
                                    @endif
                                </td> --}}
                                <td>{{ $product->nama }}</td>
                                <td>{{ $product->category->kategori ?? '-' }}</td>

                                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }}</td>
                                {{-- <td>{{ $product->deskripsi }}</td> --}}
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#DetailProdukModal{{ $product->id }}">
                                     <i class="bi bi-info-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editProdukModal{{ $product->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $products->links() }}
                </div>

                <!-- Modal Tambah Produk -->
                <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('products.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kategori</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" >
                                    </div>
                                    <div class="mb-3">
                                        <label>Foto</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control"></textarea>
                                    </div>
                                    <button class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($products as $product)
                    <!-- Modal Edit Produk -->
                    <div class="modal fade" id="editProdukModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="editProdukLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProdukLabel{{ $product->id }}">Edit Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama" value="{{ $product->nama }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Harga</label>
                                            <input type="number" name="harga" value="{{ $product->harga }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Stok</label>
                                            <input type="number" name="stok" value="{{ $product->stok }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Foto</label><br>
                                            @if ($product->foto)
                                                <img src="{{ asset('storage/' . $product->foto) }}" width="100"
                                                    class="mb-2"><br>
                                            @endif
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
                                        </div>
                                        <button class="btn btn-success">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($products as $product)
                    <!-- Modal Detail Produk -->
                    <div class="modal fade" id="DetailProdukModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="DetailProdukLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DetailProdukLabel{{ $product->id }}">Detail Produk
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Kolom kiri: foto + deskripsi -->
                                        <div class="col-md-5 text-center">
                                            @if ($product->foto)
                                                <img src="{{ asset('storage/' . $product->foto) }}"
                                                    class="img-fluid rounded mb-3" alt="{{ $product->nama }}">
                                            @else
                                                <img src="{{ asset('template/assets/img/no-image.png') }}"
                                                    class="img-fluid rounded mb-3" alt="No Image">
                                            @endif

                                            <!-- Divider -->
                                            <hr class="my-3">

                                            <!-- Deskripsi di bawah gambar -->
                                            <div class="text-start">
                                                <p><strong>Deskripsi:</strong><br> {{ $product->deskripsi ?? '-' }}</p>
                                            </div>
                                        </div>

                                        <!-- Kolom kanan: detail singkat -->
                                        <div class="col-md-7">
                                            <h4>Nama: {{ $product->nama }}</h4>
                                            <p><strong>Kategori:</strong> {{ $product->category->kategori ?? '-' }}</p>

                                            <p><strong>Harga:</strong> Rp
                                                {{ number_format($product->harga, 0, ',', '.') }}</p>
                                            <p><strong>Stok:</strong> {{ $product->stok }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


    </main><!-- End #main -->

    @include('admin.pages.footer')

</body>
  @include('style.admin')
</html>
