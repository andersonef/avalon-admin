<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/06/16
 * Time: 19:32
 */

namespace Andersonef\AvalonAdmin\Http\Controllers\Panel;


use Andersonef\AvalonAdmin\Facades\Category;
use Andersonef\AvalonAdmin\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('AvalonAdmin::content.panel.categories.index');
    }

    public function create()
    {
        return view('AvalonAdmin::content.panel.categories.create');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category)
            return abort(404);
        return view('AvalonAdmin::content.panel.categories.edit', ['category' => $category]);
    }


    public function store(CategoryRequest $request)
    {
        try{
            Category::create($request->only(['categoryName', 'categoryDescription', 'categoryInternal']));
            return redirect()->route('avalon.admin.panel.categories.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Categories.store.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try{
            Category::destroy($id);
            return redirect()->route('avalon.admin.panel.categories.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Categories.destroy.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function update($id, CategoryRequest $request)
    {
        try{
            Category::update($id, $request->only(['categoryName', 'categoryDescription', 'categoryInternal']));
            return redirect()->route('avalon.admin.panel.categories.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Categories.update.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}