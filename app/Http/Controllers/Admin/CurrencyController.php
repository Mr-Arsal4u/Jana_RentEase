<?php

namespace App\Http\Controllers\admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    public function index()
    {
        // $currencies = Currency::get();
        $currencies = $this->currencyService->getCurrency();

        return view('admin.currency.index', compact('currencies'));
    }

    public function save(Request $request)
    {
        return $this->currencyService->saveCurrency($request);
    }
}
