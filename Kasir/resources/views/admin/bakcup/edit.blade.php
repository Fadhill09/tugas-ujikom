<div class="container">
    <h3>Edit Produk</h3>
    <form action="{{ route('products.update',$product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $product->nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" value="{{ $product->kategori }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $product->harga }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $product->stok }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto</label><br>
            @if($product->foto)
                <img src="{{ asset('storage/'.$product->foto) }}" width="100"><br>
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

