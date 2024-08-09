<x-splade-modal max-width="6xl">
    <h1 class="text-lg text-gray-700 text-center font-bold" style="font-size: 40px;">Detail Penyewaan</h1>

    <div class="container pt-5">
        <div class="row flex">
            <div class="col-lg-6 p-4">
                <img src="storage/items/{{ $rentals->item->gambar }}" class="rounded-md" width="450px" alt="">
                <p style="font-size: 20px;">{{ $rentals->kode }}</p>
            </div>
            <div class="col-lg-6 p-4">
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Barang</h1>
                    <p><span style="font-weight: bold;">Nama Barang</span> : {{ $rentals->item->nama_barang }}</p>
                    <p><span style="font-weight: bold;">Harga Sewa</span> : Rp {{ $rentals->harga }}/hari</p>
                    <p><span style="font-weight: bold;">Harga Denda</span> : Rp {{ $rentals->harga_denda }}/hari</p>
                </div>
                <br>
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Pelanggan</h1>
                    <p><span style="font-weight: bold;">Nama</span> : {{ $rentals->customer->nama_pelanggan }}</p>
                    <p><span style="font-weight: bold;">No KTP</span> : {{ $rentals->customer->no_ktp }}</p>
                    <p><span style="font-weight: bold;">Alamat</span> : {{ $rentals->customer->alamat }}</p>
                </div>
                <br>
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Penyewaan</h1>
                    <p><span style="font-weight: bold;">Tanggal Sewa</span> : {{ $rentals->tanggal_penyewaan }}</p>
                    <p><span style="font-weight: bold;">Tanggal Pengembalian</span> : {{ $rentals->tanggal_pengembalian }}</p>
                </div>
                <br>
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Ketentuan</h1>
                    <p><span style="font-weight: bold;">Terlambat</span> : {{ $rentals->lateDay }}/Hari</p>
                    <p><span style="font-weight: bold;">Denda</span> : Rp {{ $rentals->denda }}</p>
                </div>
            </div>
        </div>
    </div>
</x-splade-modal>