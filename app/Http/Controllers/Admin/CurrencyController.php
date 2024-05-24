<?php

namespace App\Http\Controllers\admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::get();
        return view('admin.currency.index', compact('currencies'));
    }

    public function save(Request $request)
    {
        try {
            // dd($request->all());
            $currency = new Currency();
            $currency->name = $request->name;
            $currency->code = $request->code;
            // $currency->status = $request->status;
            $currency->save();
            return redirect()->back()->with('success', 'Currency added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
            Log::error($e->getMessage());
        }
    }
}
