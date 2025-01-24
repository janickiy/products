<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StockIn\AddRequest;
use App\Models\Products;
use App\Models\StockIn;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('stock.index')->with('title', 'Текущие остатки товаров');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $options = Products::getOption();

        return view('stock_in.create', compact('options'))->with('title', 'Учет прихода товара');
    }

    /**
     * @param AddRequest $request
     * @return RedirectResponse
     */
    public function store(AddRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
           StockIn::create($request->all());

            $fields = 'product_id, quantity';
            $insertStr = "(" . $request->product_id . ", " . $request->quantity  .")";

            DB::insert("INSERT INTO `stock` ({$fields}) VALUES {$insertStr} ON DUPLICATE KEY UPDATE `quantity`=`quantity` + VALUES(`quantity`)");
        });

        return redirect()->route('admin.stock_in.index')->with('success', 'Приход успешно учтен!');
    }
}
