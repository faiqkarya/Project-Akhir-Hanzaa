<x-app-layout>
    <x-slot name="header">
        {{ __('Data Pelanggan') }}
    </x-slot>

    <x-panel>
        <!-- btn create -->
        <div class="flex">
            <Link href="/customers/create" class="px-4 py-2 bg-gray-100 rounded-md text-sm border flex items-center gap-2 text-gray-700" modal>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                <path d="M9 12l6 0"></path>
                <path d="M12 9l0 6"></path>
            </svg>
            Tambah Pelanggan
            </Link>
        </div>
        <!-- table component -->
        <x-splade-table :for="$customers">
            <x-slot:empty-state>
                <div class="flex text-center justify-center text-red-500">Tidak ada Data Pelanggan yang ditampilkan</div>
                </x-slot>

                <!-- action button -->
                @cell('aksi', $customers)
                <div class="flex gap-2">
                    <Link modal href="{{ route('customers.edit', $customers->id) }}" class="rounded-full p-2 bg-orange-300 text-white hover:bg-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                    </Link>
                    <x-splade-form action="{{ route('customers.destroy', $customers->id) }}" confirm="Delete Data" confirm-text="Apakah anda yakin ingin menghapus data ini?" confirm-button="Ya" cancel-button="No" method="delete">
                        <button type="submit" class="rounded-full p-2 bg-rose-300 text-white hover:bg-rose-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </x-splade-form>
                </div>
                @endcell
        </x-splade-table>
    </x-panel>
</x-app-layout>