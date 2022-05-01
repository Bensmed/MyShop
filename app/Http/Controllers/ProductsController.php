<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $slug = null)
    {
        $currency = Settings::select('currency')->where('id', 1)->first()->currency;

        $product = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->where([
                ['products.id', '=', $id],
            ])->first();

        if (isset($product)) {

            return view('pages.product', compact('product', 'currency'));
        } else {
            return view('pages.product');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function getProductInfo(Request $request)
    {
        $product = Product::where('id', $request->get('id'))->first();

        $finalData = [];


        if (isset($product)) {

            $finalData[$product->id]['id'] = $product->id;

            $finalData[$product->id]['name'] = $product->name;

            $finalData[$product->id]['sale_price'] = $product->sale_price;

            $finalData[$product->id]['quantity'] = $request->get('quantity');
        }



        return response()->json($finalData);
    }


    public function productsByCategory($id = 1, $slug = null)
    {


        $categoryInfo = Category::where('id', $id)->first();
        $category = [];

        if (isset($categoryInfo)) {

            $category = [
                'id' => $categoryInfo->id,
                'name' => $categoryInfo->name,
                'slug' => $categoryInfo->slug,
                'description' => $categoryInfo->description,
            ];

            $categories = Category::all();

            if (isset($categories)) {


                $productsByCategory = Product::where('category_id', $id)->get();

                if (isset($productsByCategory)) {

                    $products = [];
                    foreach ($productsByCategory as $product) {
                        $products[$product->id] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'price' => $product->price,
                            'sale_price' => $product->sale_price,
                            'on_sale' => $product->on_sale,
                            'image_name' => $product->image_name,
                        ];
                    }


                    return view('pages.category', compact('category', 'categories', 'products'));
                } else {
                    return view('pages.category', compact('category', 'categories'));
                }
            } else {
                return view('pages.category', compact('category'));
            }
        } else {
            return view('pages.category');
        }
    }


    public function productSortBy(Request $request, $id, $slug = null)
    {


        $categoryInfo = Category::where('id', $id)->first();
        $category = [];

        if (isset($categoryInfo)) {

            $category = [
                'id' => $categoryInfo->id,
                'name' => $categoryInfo->name,
                'slug' => $categoryInfo->slug,
                'description' => $categoryInfo->description,
            ];

            $categories = Category::all();

            if (isset($categories)) {


                $productsByCategory = Product::where('category_id', $id)->orderBy('name', 'desc')->get();

                if (isset($productsByCategory)) {

                    $products = [];
                    foreach ($productsByCategory as $product) {
                        $products[$product->id] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'price' => $product->price,
                            'sale_price' => $product->sale_price,
                            'image_name' => $product->image_name,
                        ];
                    }


                    return view('pages.category', compact('category', 'categories', 'products'));
                } else {
                    return view('pages.category', compact('category', 'categories'));
                }
            } else {
                return view('pages.category', compact('category'));
            }
        } else {
            return view('pages.category');
        }
    }
}
