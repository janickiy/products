<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StockIn\AddRequest;
use App\Models\Products;
use App\Models\Sales;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        $options = Products::getOption();

        return view('sales.create', compact('options'))->with('title', 'Учет продаж товара');
    }

    /**
     * @param AddRequest $request
     * @return RedirectResponse
     */
    public function store(AddRequest $request): RedirectResponse
    {
        $current_quantity = Stock::select('quantity')->where('product_id',$request->product_id)->count();

        if ($current_quantity >= $request->quantity) return back()->with('error', 'Недостаточно товара на складе');

        DB::transaction(function () use ($request): void {
            Sales::create($request->all());

            $stock = Stock::where('product_id',$request->product_id)->first();
            $stock->quantity = $stock->quantity - $request->quantity;
            $stock->save();
        });

        return redirect()->route('sales.index')->with('success', 'Продажа успешно учтена!');
    }
}
