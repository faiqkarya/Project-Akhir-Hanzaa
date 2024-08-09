<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Categories;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Item::latest()->paginate(7);
        // render view
        return view('items.index', [
            'items' => SpladeTable::for($items)
                ->column(key: 'category_id', label: 'Kategori')
                ->column('nama_barang')
                ->column('deskripsi')
                ->column('gambar')
                ->column('stok')
                ->column('aksi')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        // render view
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'category_id'     => 'required',
            'harga'     => 'required',
            'harga_denda'     => 'required',
            'nama_barang'            => 'required|min:5',
            'deskripsi'     => 'required|min:5',
            'gambar'           => 'required|image|mimes:jpeg,jpg,png',
            'stok'           => 'required|max:20',
        ]);


        // upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/items', $gambar->hashName());

        // insert new post to db
        Item::create([
            'category_id' => $request->category_id,
            'harga' => $request->harga,
            'harga_denda' => $request->harga_denda,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar->hashName(),
            'stok' => $request->stok,
        ]);

        Toast::title('Berhasil!')
            ->message('Data Barang Berhasil ditambahkan')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Categories::all();

        return view('items.update', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
{
    // Validasi request
    $this->validate($request, [
        'category_id'    => 'required',
        'harga'          => 'required',
        'harga_denda'    => 'required',
        'nama_barang'    => 'required',
        'deskripsi'      => 'required|min:5',
        'gambar'         => 'nullable|image|mimes:jpeg,jpg,png',
        'stok'           => 'required',
    ]);

    // Cek apakah ada file gambar baru yang diunggah
    if ($request->file('gambar')) {
        // Upload gambar baru
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/items', $gambar->hashName());

        // Hapus gambar lama
        Storage::delete('public/items/' . $item->gambar);

        // Update item data gambar dengan nama gambar baru
        $item->gambar = $gambar->hashName();
    }

    // Update data item dengan mempertahankan gambar lama jika tidak ada gambar baru
    $item->update([
        'category_id'   => $request->category_id,
        'harga'         => $request->harga,
        'harga_denda'   => $request->harga_denda,
        'nama_barang'   => $request->nama_barang,
        'deskripsi'     => $request->deskripsi,
        'gambar'        => $item->gambar, // Tetap menggunakan gambar lama jika tidak ada gambar baru
        'stok'          => $request->stok,
    ]);

    Toast::title('Berhasil!')
        ->message('Data Barang Berhasil diubah')
        ->success()
        ->rightTop()
        ->autoDismiss(15);

    // Redirect ke halaman index items
    return redirect(route('items.index'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // delete customer data by id
        $item->delete();

        Toast::title('Berhasil!')
            ->message('Data Barang Berhasil dihapus')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return back();
    }
}
