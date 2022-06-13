<?php

namespace App\Observers;

use App\Models\Store;

class StoreObserver
{
    /**
     * Handle the Store "created" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function created(Store $store)
    {
        // Update default store values
        if($store->default == true) {
            Store::where('id', '!=', $store->id)->update(['default' => false]);
        }
    }

    /**
     * Handle the Store "updated" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function updated(Store $store)
    {
        // Update default store values
        if($store->default == true) {
            Store::where('id', '!=', $store->id)->update(['default' => false]);
        }
    }

    /**
     * Handle the Store "deleted" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function deleted(Store $store)
    {
        //
    }

    /**
     * Handle the Store "restored" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function restored(Store $store)
    {
        //
    }

    /**
     * Handle the Store "force deleted" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function forceDeleted(Store $store)
    {
        //
    }
}
