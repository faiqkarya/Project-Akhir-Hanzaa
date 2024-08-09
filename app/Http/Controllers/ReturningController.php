<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Returning;
use App\Models\Status;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Carbon\Carbon;
use ProtoneMedia\Splade\Facades\Toast;

class ReturningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returnings = Returning::latest()->paginate(7);

        $returnings->transform(function ($returning) {
            $tanggalPenyewaan = Carbon::parse($returning->rental->tanggal_penyewaan);
            $tanggalDikembalikan = Carbon::parse($returning->tanggal_dikembalikan);
            $tanggalPengembalian = Carbon::parse($returning->rental->tanggal_pengembalian);

            // Menghitung durasi sewa
            $durasi = $tanggalDikembalikan->greaterThan($tanggalPenyewaan) ? $tanggalDikembalikan->diffInDays($tanggalPenyewaan) : 0;
            $returning->durasi = $durasi;

            // Menghitung hari keterlambatan
            $today = Carbon::today();
            $terlambat = $today->greaterThan($tanggalPengembalian) ? $today->diffInDays($tanggalPengembalian) : 0;
            $returning->lateDay = $terlambat;

            return $returning;
        });

        // $status_id = 3;
        // $status = Rental::where('status_id', $status_id);

        // Render view
        return view('returnings.index', [
            'returnings' => SpladeTable::for($returnings)
                ->column(key: 'kode', label: 'Kode')
                ->column(key: 'item_id', label: 'Nama Barang')
                ->column(key: 'customer_id', label: 'Nama Pelanggan')
                ->column(key: 'tanggal_penyewaan', label: 'Tanggal Penyewaan')
                ->column(key: 'tanggal_pengembalian', label: 'Tanggal Pengembalian')
                ->column(key: 'tanggal_dikembalikan', label: 'Dikembalikan')
                ->column(key: 'durasi', label: 'Durasi')
                ->column(key: 'terlambat', label: 'Terlambat')
                ->column('aksi')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rentals = Rental::all();
        $returnings = Returning::all();


        // dd($return); // Debugging
        // $rentals->transform(function ($rental) {

        // });

        return view('returnings.create', compact('rentals', 'returnings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // validate request
        $this->validate($request, [
            'rental_id'                  => 'required',
            'tanggal_dikembalikan'  => 'required|date',
        ]);

        $tanggal_dikembalikan = now();

        // insert new post to db
        Returning::create([
            'rental_id' => $request->rental_id,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
        ]);


        Toast::title('Berhasil!')
            ->message('Data Pengembalian Berhasil ditambahkan')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return redirect(route('returnings.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //get post by ID
        $returnings = Returning::findOrFail($id);
        // $rentals = Rental::findOrFail($id);

        // Merubah format menjadi rupiah
        $returnings->harga = number_format($returnings->rental->item->harga, 0, ',', '.');
        $returnings->harga_denda = number_format($returnings->rental->item->harga_denda, 0, ',', '.');

        // Menghitung terlambat
        $returning = $returnings;
        $returning->lateDay = null;

        $tanggalPengembalian = Carbon::parse($returning->rental->tanggal_pengembalian);

        $todays = date_create(date('Y-m-d'));
        $today = Carbon::parse($todays);

        if ($today->greaterThan($tanggalPengembalian)) {
            $terlambat = date_diff($tanggalPengembalian, $today);
            $returning->lateDay = $terlambat->format("%a");
        } else {
            $returning->lateDay = 0;
        }

        // Menghitung denda
        $returnings->denda = $returning->lateDay * $returnings->rental->item->harga_denda;
        $returnings->denda = number_format($returnings->denda, 0, ',', '.');

        //render view with post
        return view('returnings.show', [
            'returnings' => $returnings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Returning $returning)
    {
        return view('returnings.update', [
            'returning' => $returning]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Returning $returning)
    {
        // validate request
        $this->validate($request, [
            'tanggal_dikembalikan'  => 'required|date',
        ]);

        $rental_id = $returning->rental_id; 

        // update returning data by id
        $returning->update([
            'rental_id' => $rental_id,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
        ]);

        Toast::title('Berhasil!')
            ->message('Data Pengembalian Berhasil diubah')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        return redirect(route('returnings.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Returning $returning)
    {
         // delete rental data by id
         $returning->delete();
         Toast::title('Berhasil!')
             ->message('Data Pengembalian Berhasil dihapus')
             ->success()
             ->rightTop()
             ->autoDismiss(15);
 
         // render view
         return back();
    }
}
