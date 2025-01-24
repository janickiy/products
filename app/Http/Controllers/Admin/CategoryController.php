<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\EditRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('category.index')->with('title', 'Категория товаров');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('category.create_edit')->with('title', 'Добавление категории');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('success', 'Информация успешно добавлена');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $row = Category::find($id);

        if (!$row) abort(404);

        return view('category.create_edit', compact('row'))->with('title', 'Редактирование категории');
    }

    /**
     * @param EditRequest $request
     * @return RedirectResponse
     */
    public function update(EditRequest $request): RedirectResponse
    {
        $row = Category::find($request->id);

        if (!$row) abort(404);

        $row->name = $request->input('name');

        $row->save();

        return redirect()->route('admin.category.index')->with('success', 'Данные обновлены');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request): void
    {
        Category::find($request->id)->delete();
    }
}
