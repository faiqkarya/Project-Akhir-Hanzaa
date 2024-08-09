<x-splade-modal max-width="6xl">
    <h1 class="text-lg text-gray-700 text-center font-bold" style="font-size: 40px;">Detail Pengembalian</h1>

    <div class="container pt-5">
        <div class="row flex">
            <div class="col-lg-6 p-4">
                <img src="storage/items/{{ $returnings->rental->item->gambar }}" class="rounded-md" width="450px" alt="">
                <p style="font-size: 20px;">{{ $returnings->rental->kode }}</p>
            </div>
            <div class="col-lg-6 p-4">
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Barang</h1>
                    <p><span style="font-weight: bold;">Nama Barang</span> : {{ $returnings->rental->item->nama_barang }}</p>
                    <p><span style="font-weight: bold;">Harga Sewa</span> : Rp {{ $returnings->harga }}/hari</p>
                    <p><span style="font-weight: bold;">Harga Denda</span> : Rp {{ $returnings->harga_denda }}/hari</p>
                </div>
                <br>
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Pelanggan</h1>
                    <p><span style="font-weight: bold;">Nama</span> : {{ $returnings->rental->customer->nama_pelanggan }}</p>
                    <p><span style="font-weight: bold;">No KTP</span> : {{ $returnings->rental->customer->no_ktp }}</p>
                    <p><span style="font-weight: bold;">Alamat</span> : {{ $returnings->rental->customer->alamat }}</p>
                </div>
                <br>
                <div class="row">
                    <h1 style="font-size: 25px; font-weight: bold;">Penyewaan</h1>
                    <p><span style="font-weight: bold;">Tanggal Sewa</span> : {{ $returnings->rental->tanggal_penyewaan }}</p>
                    <p><span style="font-weight: bold;">Tanggal Pengembalian</span> : {{ $returnings->rental->tanggal_pengembalian }}</p>
                </div>
                <br>
                <div class="row flex">
                    <div class="col-lg-5 py-4 pe-4">
                        <h1 style="font-size: 25px; font-weight: bold;">Ketentuan</h1>
                        <p><span style="font-weight: bold;">Terlambat</span> : {{ $returnings->lateDay }}/Hari</p>
                        <p><span style="font-weight: bold;">Denda</span> : Rp {{ $returnings->denda }}</p>
                    </div>
                    <div class="col-lg-7 p-4">
                    <h1 style="font-size: 25px; font-weight: bold;">Pengembalian</h1>
                        <p><span style="font-weight: bold;">Dikembalikan</span> : {{ $returnings->tanggal_dikembalikan }}/Hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-splade-modal>