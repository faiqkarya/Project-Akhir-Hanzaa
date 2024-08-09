<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(7);

        // render view
        return view('customers.index', [
            'customers' => SpladeTable::for($customers)
                ->withGlobalSearch(columns: ['nama_pelanggan', 'alamat'])
                ->column(key: 'nama_pelanggan', searchable: true, sortable: true, canBeHidden: false)
                ->column(key: 'no_ktp', searchable: true, sortable: true)
                ->column(key: 'alamat', label: 'Alamat')
                ->column('aksi')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // render view
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'nama_pelanggan'     => 'required|min:5',
            'no_ktp'             => 'required|min:5',
            'alamat'             => 'required|min:5'
        ]);


        // insert new post to db
        Customer::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_ktp' => $request->no_ktp,
            'alamat' => $request->alamat,
        ]);

        Toast::title('Berhasil!')
            ->message('Data Pelanggan Berhasil ditambahkan')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return redirect(route('customers.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        // render view
        return view('customers.update', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // validate request
        $this->validate($request, [
            'nama_pelanggan'     => 'required|min:5',
            'no_ktp'     => 'required|min:16',
            'alamat'           => 'required|min:5'
        ]);

        // update post data by id
        $customer->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_ktp' => $request->no_ktp,
            'alamat' => $request->alamat,
        ]);

        Toast::title('Berhasil!')
            ->message('Data Pelanggan Berhasil diubah')
            ->success()
            ->rightTop()
            ->autoDismiss(15);


        // render view
        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // delete customer data by id
        $customer->delete();

        Toast::title('Berhasil!')
            ->message('Data Pelanggan Berhasil dihapus')
            ->success()
            ->rightTop()
            ->autoDismiss(15);

        // render view
        return back();
    }
}
