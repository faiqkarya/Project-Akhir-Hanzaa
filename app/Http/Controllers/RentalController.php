<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Rental;
use App\Models\Returning;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Number;
use ProtoneMedia\Splade\Facades\Toast;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data rentals dengan relasi yang diperlukan
        $rentals = Rental::latest()->paginate(7);
        $rental = $rentals;
        $rental->lateDay = null;

        // Loop melalui setiap rental dan hitung hari keterlambatan
        foreach ($rentals as $rental) {
            $tanggalPenyewaan = Carbon::parse($rental->tanggal_penyewaan);
            $tanggalPengembalian = Carbon::parse($rental->tanggal_pengembalian);

            // Untuk menghitung durasi sewa
            // if ($tanggalPengembalian->greaterThan($tanggalPenyewaan)) {
            //     $rental->lateDay = $tanggalPengembalian->diffInDays($tanggalPenyewaan);
            // } else {
            //     $rental->lateDay = 0;
            // }

            $todays = date_create(date('Y-m-d'));
            $today = Carbon::parse($todays);

            if ($today->greaterThan($tanggalPengembalian)) {
                $terlambat = date_diff($tanggalPengembalian, $today);
                $rental->lateDay = $terlambat->format("%a");
            } else {
                $rental->lateDay = 0;
            }
        }

        // Render view
        return view('rentals.index', [
            'rentals' => SpladeTable::for($rentals)
                ->column(key: 'user_id', label: 'Admin')
                ->column(key: 'kode', label: 'Kode')
                ->column(key: 'item_id', label: 'Nama Barang')
                ->column(key: 'customer_id', label: 'Nama Pelanggan')
                ->column(key: 'tanggal_penyewaan', label: 'Tanggal Penyewaan')
                ->column(key: 'tanggal_pengembalian', label: 'Tanggal Pengembalian')
                ->column(key: 'terlambat', label: 'Terlambat')
                ->column(key: 'status_id', label: 'Status')
                ->column('aksi'),
            'lateDays' => $rental->lateDay
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $customers = Customer::all();

        // render view
        return view('rentals.create', compact('items', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            // 'kode'                  => 'required',
            'item_id'               => 'required',
            'customer_id'           => 'required',
            'tanggal_penyewaan'     => 'required|date',
            'tanggal_pengembalian'  => 'required|date',
        ]);

        $kode = 'RENT-' . mt_rand(10000, 99999);
        $user_id = 3;
        $status_id = 2;

        // insert new post to db
        Rental::create([
            'kode' => $kode,
            'user_id' => $user_id,
            'item_id' => $request->item_id,
            'customer_id' => $request->customer_id,
            'tanggal_penyewaan' => $request->tanggal_penyewaan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_id' => $status_id,
        ]);

        Toast::title('Berhasil!')
            ->message('Data Penyewa Berhasil ditambahkan')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return redirect(route('rentals.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //get post by ID
        $rentals = Rental::findOrFail($id);

        // Merubah format menjadi rupiah
        $rentals->harga = number_format($rentals->item->harga, 0, ',', '.');
        $rentals->harga_denda = number_format($rentals->item->harga_denda, 0, ',', '.');

        // Menghitung terlambat
        $rental = $rentals;
        $rental->lateDay = null;

        $tanggalPengembalian = Carbon::parse($rental->tanggal_pengembalian);

        $todays = date_create(date('Y-m-d'));
        $today = Carbon::parse($todays);

        if ($today->greaterThan($tanggalPengembalian)) {
            $terlambat = date_diff($tanggalPengembalian, $today);
            $rental->lateDay = $terlambat->format("%a");
        } else {
            $rental->lateDay = 0;
        }

        // Menghitung denda
        $rentals->denda = $rental->lateDay * $rentals->item->harga_denda;
        $rentals->denda = number_format($rentals->denda, 0, ',', '.');

        //render view with post
        return view('rentals.show', [
            'rentals' => $rentals
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        $items = Item::all();
        $customers = Customer::all();

        // render view
        return view('rentals.update', [
            'rental' => $rental,
            'items' => $items,
            'customers' => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        // Validate request
        $this->validate($request, [
            'item_id'               => 'required',
            'customer_id'           => 'required',
            'tanggal_penyewaan'     => 'required|date',
            'tanggal_pengembalian'  => 'required|date',
        ]);

        // Ambil data rental sebelum diupdate
        $oldItemId = $rental->item_id;

        // Update data rental
        $rental->update([
            'kode'                 => $rental->kode,
            'user_id'              => $rental->user_id,
            'item_id'              => $request->item_id,
            'customer_id'          => $request->customer_id,
            'tanggal_penyewaan'    => $request->tanggal_penyewaan,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_id'            => $rental->status_id,
        ]);

        // Jika item_id berubah, kurangi stok dari item lama dan item baru
        if ($oldItemId != $request->item_id) {
            // Kurangi stok item lama
            $oldItem = Item::find($oldItemId);
            if ($oldItem) {
                $oldItem->stok += 1; // Kembalikan stok item lama
                $oldItem->save();
            }

            // Kurangi stok item baru
            $newItem = Item::find($request->item_id);
            if ($newItem) {
                $newItem->stok -= 1; // Kurangi stok item baru
                $newItem->save();
            }
        }

        Toast::title('Berhasil!')
            ->message('Data Penyewaan Berhasil diubah')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        return redirect(route('rentals.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        // delete rental data by id
        $rental->delete();
        Toast::title('Berhasil!')
            ->message('Data Penyewaan Berhasil dihapus')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return back();
    }
}
