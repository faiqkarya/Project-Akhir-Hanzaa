<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\Returning;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh: Mengambil data statistik untuk dashboard
        $totalItems = Item::count();
        $totalCustomers = Customer::count();
        $totalRentals = Rental::count();
        $totalRetuurnings = Returning::count();

        // Mengirim data ke dashboard
        return view('dashboard', [
            'totalItems' => $totalItems,
            'totalCustomers' => $totalCustomers,
            'totalRentals' => $totalRentals,
            'totalReturnings' => $totalRetuurnings,
        ]);
    }

    public function navigationData()
    {
        // Contoh: Mengambil data untuk navigation
        $totalCustomers = Customer::count();
        $totalItems = Item::count();
        $totalRentals = Rental::count();

        // Mengirim data ke navigation
        return view('partials.navigation', [
            'totalCustomers' => $totalCustomers,
            'totalItems' => $totalItems,
            'totalRentals' => $totalRentals,
        ]);
    }
}
