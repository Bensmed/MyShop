<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::orderBy('name', 'Asc')->paginate(25);

        return view('admin.store.collections.collections', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('name', 'Asc')->get();

        return view('admin.store.collections.newCollection', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $collection_created = Collection::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        $collection_id = Collection::all()->last()->id;

        foreach ($request->selected_products_id as $selected_product_id) {

            Product::where('id', $selected_product_id)->update(
                [
                    'collection_id' => $collection_id,
                ]
            );
        }

        if ($collection_created) {

            return ['success' => 'Collection sauvgarder avec succès.'];
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
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('name', 'Asc')->get();

        $collection = Collection::where('id', $id)->first();

        $selected_products = Product::where('collection_id', $id)->pluck("id");

        return view('admin.store.collections.newCollection', compact('products', 'collection', 'selected_products'));
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
        $collection_updated = Collection::where('id', $id)->update(
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]
        );

        Product::where('collection_id', $id)->update(
            [
                'collection_id' => null,
            ]
        );

        foreach ($request->selected_products_id as $selected_product_id) {

            Product::where('id', $selected_product_id)->update(
                [
                    'collection_id' => $id,
                ]
            );
        }

        if ($collection_updated) {
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
        try {
            $collection_deleted = Collection::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return ['error' => "Impossible de la suppression. Cette collection est liée à d'autres produits!"];
        }
        if ($collection_deleted) {
            return ['success' => 'Une collection a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
