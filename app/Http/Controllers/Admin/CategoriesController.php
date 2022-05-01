<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'Asc')->Paginate(25);

        return view('admin.store.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.store.categories.newCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Str::slug($request->name));
        $category_created = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        if ($category_created) {

            return ['success' => 'Catégorie sauvgarder avec succès.'];
        } else {

            return ['error' => "Échec de l'enregistrement, réessayer plus tard!"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();


        return view('admin.store.categories.newCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category_updated = Category::where('id', $id)->update(
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]
        );

        if ($category_updated) {
            return ['success' => 'Mise à jour du catégorie avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete(Request $request)
    {
        try {
            $category_deleted = Category::where('id', $request->id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return ['error' => "Impossible de la suppression. Cette catégorie est liée à d'autres produits!"];
        }
        if ($category_deleted) {
            return ['success' => 'Une catégorie a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
