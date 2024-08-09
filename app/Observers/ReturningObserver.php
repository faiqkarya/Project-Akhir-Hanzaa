<?php

namespace App\Observers;

use App\Models\Rental;
use App\Models\Returning;

class ReturningObserver
{
    /**
     * Handle the Returning "created" event.
     */
    public function created(Returning $returning): void
    {
        // Menghapus data rental yang terkait
        // $rental = Rental::find($returning->rental_id);
        // if ($rental) {
        //     $rental->delete();
        // }
        // Temukan rental yang terkait
        $rental = Rental::find($returning->rental_id);

        if ($rental) {
            // Update status rental
            $rental->status_id = 1; // Misalnya, status ID 1 untuk 'Dikembalikan'
            $rental->save();
            
            // Update stok item terkait
            if ($rental->item) {
                $rental->item->stok += 1; // Menambahkan stok item
                $rental->item->save(); // Simpan perubahan stok
            }
        }
    }

    /**
     * Handle the Returning "updated" event.
     */
    public function updated(Returning $returning): void
    {
        //
    }

    /**
     * Handle the Returning "deleted" event.
     */
    public function deleted(Returning $returning): void
    {
        $rental = Rental::find($returning->rental_id);

        if ($rental) {
            // Update status rental
            $rental->status_id = 2; // Misalnya, status ID 1 untuk 'Dikembalikan'
            $rental->save();
            
            // Update stok item terkait
            if ($rental->item) {
                $rental->item->stok -= 1; // Mengurangi stok item
                $rental->item->save(); // Simpan perubahan stok
            }
        }
    }

    /**
     * Handle the Returning "restored" event.
     */
    public function restored(Returning $returning): void
    {
        //
    }

    /**
     * Handle the Returning "force deleted" event.
     */
    public function forceDeleted(Returning $returning): void
    {
        //
    }
}
