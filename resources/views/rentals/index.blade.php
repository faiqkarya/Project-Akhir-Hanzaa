<x-app-layout>
    <x-slot name="header">
        {{ __('Data Sewa') }}
    </x-slot>

    <x-panel>
        <!-- btn create -->
        <div class="flex">
            <Link href="/rentals/create" class="px-4 py-2 bg-gray-100 rounded-md text-sm border flex rentals-center gap-2 text-gray-700" modal>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                <path d="M9 12l6 0"></path>
                <path d="M12 9l0 6"></path>
            </svg>
            Tambahkan Data Penyewaan
            </Link>
        </div>
        <!-- table component -->
        <x-splade-table :for="$rentals">
            <x-slot:empty-state>
                <div class="flex text-center justify-center text-red-500">Tidak ada Data Sewa yang ditampilkan</div>
                </x-slot>

                @cell('user_id', $rentals)
                {{ $rentals->user->name }}
                @endcell

                @cell('kode', $rentals)
                <p>{{ $rentals->kode }}</p>
                <div style="color: green;">
                    @if($rentals->status->status_name == 'Dikembalikan')
                    {!! 
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>' 
                    !!}
                    @endif
                </div>
                @endcell

                @cell('item_id', $rentals)
                {{ $rentals->item->nama_barang }}
                @endcell

                @cell('customer_id', $rentals)
                {{ $rentals->customer->nama_pelanggan }}
                @endcell

                @cell('status_id', $rentals)
                {{ $rentals->status->status_name }}
                @endcell

                @cell('terlambat', $lateDays)
                {{ $lateDays->lateDay . ' hari' }}
                @endcell

                @cell('gambar', $rentals)
                <img src="{{ asset('/storage/rentals/' . $rentals->gambar) }}" class="rounded-md w-1/3" />
                @endcell

                <!-- action button -->
                @cell('aksi', $rentals)
                <div class="flex gap-2">
                    <Link modal href="{{ route('rentals.show', $rentals->id) }}" class="rounded-full p-2 bg-orange-300 text-white hover:bg-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                    </svg>
                    </Link>
                    <Link modal href="{{ route('rentals.edit', $rentals->id) }}" class="rounded-full p-2 bg-orange-300 text-white hover:bg-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                    </Link>
                    <x-splade-form action="{{ route('rentals.destroy', $rentals->id) }}" confirm="Delete Data" confirm-text="Apakah anda yakin ingin menghapus data ini?" confirm-button="Ya" cancel-button="No" method="delete">
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