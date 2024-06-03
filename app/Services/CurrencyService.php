<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Log;

class CurrencyService
{

    public function getCurrency()
    {
        return Currency::get();
    }

    public function saveCurrency($request)
    {
        // dd($request->all());
        try {
            Currency::create($request->all());
            return redirect()->back()->with('success', 'Currency added successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}