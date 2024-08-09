<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Rental;

class RentalObserver
{
    /**
     * Handle the Rental "created" event.
     */
    public function created(Rental $rental): void
    {
        $item = Item::find($rental->item_id);

        if ($item) {
            $item->stok -= 1; // Mengurangi stok item
            $item->save(); // Simpan perubahan stok
        }
    }

    /**
     * Handle the Rental "updated" event.
     */
    public function updated(Rental $rental): void
    {
        //
    }

    /**
     * Handle the Rental "deleted" event.
     */
    public function deleted(Rental $rental): void
    {
        //
    }

    /**
     * Handle the Rental "restored" event.
     */
    public function restored(Rental $rental): void
    {
        //
    }

    /**
     * Handle the Rental "force deleted" event.
     */
    public function forceDeleted(Rental $rental): void
    {
        //
    }
}
