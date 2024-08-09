<x-splade-modal>
    <h1 class="text-lg text-gray-700 text-center font-semibold">Tambah Data Pelanggan</h1>
    <x-panel>
        <x-splade-form action="/customers" enctype='multipart/form-data'>
            <div class="gap-4">
                {{-- form input --}}
                <div class="flex flex-col gap-4">
                    <x-splade-input name="nama_pelanggan" type="text" label="Nama Pelanggan" placeholder="Masukkan Nama Pelanggan" />
                    <x-splade-input name="no_ktp" type="text" label="Nomor KTP" placeholder="Masukkan No KTP" />
                    <x-splade-input name="alamat" type="text" label="Alamat" placeholder="Masukan Alamat Pelanggan" />
                    <div class="flex gap-2 items-center">
                        <button type="submit" class="bg-gray-700 p-2 text-white rounded-md text-sm flex items-center gap-1 hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            Save
                        </button>
                        <Link href="/customers" class="bg-rose-700 p-2 text-white rounded-md text-sm flex items-center gap-1 hover:bg-rose-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l4 4"></path>
                            <path d="M5 12l4 -4"></path>
                        </svg>
                        Back
                        </Link>
                    </div>
                </div>
            </div>
        </x-splade-form>
    </x-panel>
</x-splade-modal>