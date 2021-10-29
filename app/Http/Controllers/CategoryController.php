<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $lang = in_array($request->get('language'), Config::get('constants.default_languages')) ? $request->get('language') : 'es';

        $categories = Category::query()
            ->with(['description' => function ($query) use ($lang) {
                $query->where('language', $lang);
            }])->get();

        return view('categories.index', ['lang' => $lang, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        /** @var Category $category*/
        $category = Category::query()->create([
            'slug' => Str::random(10),
        ]);

        foreach (Config::get('constants.default_languages') as $language){
            $category->description()->create([
                'name' => $data["name_$language"],
                'language' => $language,
            ]);
        }

        Alert::success('Éxito!', 'Categoría Creada Correctamente');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function edit(Request $request, $slug)
    {
        $lang = in_array($request->get('language'), Config::get('constants.default_languages')) ? $request->get('language') : 'es';
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        return view('categories.edit', ['category' => $category, 'lang' => $lang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param $slug
     * @return string
     */
    public function update(UpdateCategoryRequest $request, $slug): string
    {
        $data = $request->validated();
        /**@var Category $category*/
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        foreach (Config::get('constants.default_languages') as $language){
            $description = $category->translation($language);
            if ($description) {
                $description->update(['name' => $data["name_$language"]]);
            }
        }

        Alert::success('Éxito!', 'Categoría Actualizada Correctamente');

        return redirect('categories');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($slug)
    {
        /**@var Category $category*/
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        if ($category->events()->exists()){
            Alert::error('Ups!', 'Categoría con eventos asociados');
            return redirect('categories');

        }

        $category->delete();
        Alert::success('Éxito!', 'Categoría Eliminada Correctamente');
        return redirect('categories');

    }
}
