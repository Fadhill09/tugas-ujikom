<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Kategori | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    @include('style.admin')
</head>

<body>

    @include('admin.pages.header')

    @include('admin.pages.sidebar')



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kategori</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <div class="container">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">
                        + Tambah Kategori
                    </button>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->kategori }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal{{ $category->id }}">
                                         <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Form Hapus -->
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus kategori ini?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                        
                        @endforeach
                    </table>
                    {{ $categories->links() }}
                </div>

              @foreach ($categories as $key => $category)
                  <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('categories.update', $category) }}" method="POST"
                                        class="modal-content">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nama Kategori</label>
                                                <input type="text" name="kategori" value="{{ $category->kategori }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                @endforeach
                <!-- Modal Create -->
                <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('categories.store') }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="kategori" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>

    </main><!-- End #main -->

    @include('admin.pages.footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    @include('style.admin')

</body>

</html>
