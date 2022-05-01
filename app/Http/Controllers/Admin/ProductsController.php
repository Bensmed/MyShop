<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currency = Settings::select('currency')->where('id', 1)->first()->currency;

        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('name', 'Asc')->Paginate(25);

        return view('admin.store.products.products', compact('products', 'currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all('id', 'name');


        return view('admin.store.products.newProduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = request()->file('image');
        $image_name = $image->getClientOriginalName();
        $image_name = time() . '_' . $image_name;

        $image->move(public_path('/images/products'), $image_name);

        $product_created = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image_name' => $image_name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'on_sale' => $request->on_sale,
            'category_id' => $request->category,
            'in_stock' => $request->in_stock,
        ]);

        if ($product_created) {

            return ['success' => 'Produit sauvgarder avec succès.'];
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

        $product = Product::where('id', $id)->first();

        $categories = Category::all('id', 'name');

        return view('admin.store.products.newProduct', compact('categories', 'product'));
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
        if ($request->image_changed == 1) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);

            $image = request()->file('image');
            $image_name = $image->getClientOriginalName();
            $image_name = time() . '_' . $image_name;

            $image->move(public_path('/images/products'), $image_name);

            $old_image_name = Product::where('id', $id)->pluck('image_name');

            if (File::exists(public_path("/images/products/" . $old_image_name[0]))) {

                File::delete(public_path("images/products/" . $old_image_name[0]));
            }

            $product_updated = Product::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'description' => $request->description,
                    'image_name' => $image_name,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'on_sale' => $request->on_sale,
                    'category_id' => $request->category,
                    'in_stock' => $request->in_stock,
                ]
            );
        } else {
            $product_updated = Product::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'description' => $request->description,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'on_sale' => $request->on_sale,
                    'category_id' => $request->category,
                    'in_stock' => $request->in_stock,
                ]
            );
        }
        if ($product_updated) {
            return ['success' => 'Mise à jour du produit avec succès.'];
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
            $productFoundInCart = Cart::where('product_id', $request->id)->pluck('id');

            if (!$productFoundInCart->isEmpty()) {
                Cart::where('product_id', $request->id)->delete();
            }

            $product_deleted = Product::where('id', $request->id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }

        if ($product_deleted) {
            return ['success' => 'Un produit a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }

    public function stock(Request $request, $id)
    {
        $stock_updated = Product::where('id', $id)->update(
            [
                'in_stock' => $request->stock,

            ]
        );


        if ($stock_updated) {
            return ['success' => 'Mise à jour du stock avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }
}
