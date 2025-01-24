<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\EditRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view('products.create_edit')->with('title', 'Добавление товара');
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

        return view('products.create_edit', compact('row'))->with('title', 'Редактирование товара');
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
