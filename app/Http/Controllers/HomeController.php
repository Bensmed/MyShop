<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Collection;
use App\Models\PageContent;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $currency = Settings::select('currency')->where('id', 1)->first()->currency;

        $sliders = Slider::all();

        $banners = Banner::all();

        $categories = Category::select('id', 'name')->get();
        // dd($categories);
        $products_by_category = [];

        foreach ($categories as $category) {
            // dd($category->name);
            $products_cat = Product::where([['category_id', $category->id], ['in_stock', 1]])->get();
            // dd($products);
            foreach ($products_cat as $product) {

                $products_by_category[$category->id][$product->id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "price" => $product->price,
                    "sale_price" => $product->sale_price,
                    "on_sale" => $product->on_sale,
                    "image_name" => $product->image_name,
                    "category" => $category->name,
                ];
            }
        }


        $collections = Collection::select('id', 'name')->get();
        // dd($categories);
        $products_by_collection = [];

        foreach ($collections as $collection) {
            // dd($category->name);
            $products_coll = Product::where([['collection_id', $collection->id], ['in_stock', 1]])->get();
            // dd($products);
            foreach ($products_coll as $product) {

                $products_by_collection[$collection->id][$product->id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "price" => $product->price,
                    "sale_price" => $product->sale_price,
                    "on_sale" => $product->on_sale,
                    "image_name" => $product->image_name,
                    "collection" => $collection->name,
                ];
            }
        }


        return view('home', compact('currency', 'products_by_category', 'products_by_collection', 'sliders', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function getAboutPage()
    {

        $coded_content = PageContent::where('page_name', 'about')->first()->content;

        $content = base64_decode($coded_content);

        return view('about', compact('content'));
    }


    public function getSecurityPage()
    {

        $coded_content = PageContent::where('page_name', 'security')->first()->content;

        $content = base64_decode($coded_content);

        return view('security', compact('content'));
    }
}
