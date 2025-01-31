<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Products\EditRequest;
use App\Http\Requests\Products\StoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('products.index')->with('title', 'Товары');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $options = Category::getOption();
        $optionsBrand = Brand::getOption();

        return view('products.create_edit', compact('options', 'optionsBrand'))->with('title', 'Добавление товара');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Products::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Информация успешно добавлена');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $row = Products::find($id);

        if (!$row) abort(404);

        $options = Category::getOption();
        $optionsBrand = Brand::getOption();

        $brand_id = $row->brand_id;
        $category_id = $row->category_id;

        return view('products.create_edit', compact('row', 'options', 'optionsBrand', 'brand_id', 'category_id'))->with('title', 'Редактирование товара');
    }

    /**
     * @param EditRequest $request
     * @return RedirectResponse
     */
    public function update(EditRequest $request): RedirectResponse
    {
        $row = Products::find($request->id);

        if (!$row) abort(404);

        $row->name = $request->input('name');
        $row->category_id = $request->input('category_id');
        $row->brand_id = $request->input('category_id');
        $row->code = $request->input('code');
        $row->price = $request->input('price');
        $row->description = $request->input('description');
        $row->save();

        return redirect()->route('admin.products.index')->with('success', 'Данные обновлены');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request): void
    {
        Products::find($request->id)->delete();
    }
}
