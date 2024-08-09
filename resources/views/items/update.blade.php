<x-splade-modal>
    <h1 class="text-lg text-gray-700 text-center font-semibold">Ubah Data Pelanggan</h1>
    <x-panel>
        <x-splade-form :default="['category_id' => $item->category_id, 'nama_barang' => $item->nama_barang, 'harga' => $item->harga, 'harga_denda' => $item->harga_denda, 'deskripsi' => $item->deskripsi, 'stok' => $item->stok]" :action="route('items.update', $item->id)" class="flex flex-col gap-4" method="put">
            <div class="flex gap-4">
                {{-- form input --}}
                <div class="w-1/2 flex flex-col gap-4">
                    <x-splade-select name="category_id" Label="Category">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </x-splade-select>
                    <x-splade-input name="nama_barang" type="text" label="Name Item" placeholder="Masukkan Nama Barang" />
                    <x-splade-input name="harga" type="number" label="Harga" placeholder="Masukkan Harga" />
                    <x-splade-input name="harga_denda" type="number" label="Harga Denda" placeholder="Masukkan Harga Denda" />
                    <x-splade-textarea name="deskripsi" autosize label="Deskripsi" />
                    <x-splade-file name="gambar" :show-filename="true" label="Gambar" />
                    <x-splade-input name="stok" type="number" label="Stok Barang" placeholder="Masukkan Stok Barang" />
                    <div class="flex gap-2 items-center">
                        <button type="submit" class="bg-gray-700 p-2 text-white rounded-md text-sm flex items-center gap-1 hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            Update
                        </button>
                        <Link href="/items" class="bg-rose-700 p-2 text-white rounded-md text-sm flex items-center gap-1 hover:bg-rose-800">
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
                {{-- preview gambar --}}
                <div class="w-1/2">
                    <div class="flex flex-col gap-4" v-if="form.gambar">
                        <div class="border-b p-2">
                            <h1 class="text-lg text-gray-700 font-semibold">PREVIEW gambar</h1>
                        </div>
                        <img v-if="form.gambar" :src="form.$fileAsUrl('gambar')" class="rounded-md" />
                    </div>
                </div>
            </div>
        </x-splade-form>
    </x-panel>
</x-splade-modal>