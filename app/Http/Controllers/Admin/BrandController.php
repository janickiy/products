<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Brand\EditRequest;
use App\Http\Requests\Brand\StoreRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('brand.index')->with('title', 'Категория товаров');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('brand.create_edit')->with('title', 'Добавление категории');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Brand::create($request->all());

        return redirect()->route('admin.brand.index')->with('success', 'Информация успешно добавлена');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $row = Brand::find($id);

        if (!$row) abort(404);

        return view('brand.create_edit', compact('row'))->with('title', 'Редактирование производителя');
    }

    /**
     * @param EditRequest $request
     * @return RedirectResponse
     */
    public function update(EditRequest $request): RedirectResponse
    {
        $row = Brand::find($request->id);

        if (!$row) abort(404);

        $row->name = $request->input('name');

        $row->save();

        return redirect()->route('admin.brand.index')->with('success', 'Данные обновлены');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request): void
    {
        Brand::find($request->id)->delete();
    }
}
