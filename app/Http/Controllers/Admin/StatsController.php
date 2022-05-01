<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Processing;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Settings::select('currency')->where('id', 1)->first()->currency;

        $canceled = Processing::where('status', 'Annulé')->count();

        $delivered = Processing::where('status', 'Livré')->count();

        $earnings = Processing::sum('amount');

        if ($earnings >= 1000) {
            $earnings = round($earnings / 1000, 2)  . "k";   // NB: you will want to round this
        }

        $total_sales = Processing::all()->count();

        $today_sales = Processing::whereDate('created_at', Carbon::today())->count();

        $yesterday_sales = Processing::whereDate('created_at', Carbon::yesterday())->count();

        $week_sales = Processing::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])->count();

        $month_sales = Processing::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        $year_sales = Processing::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();

        return view('admin.stats.stats', compact('currency', 'canceled', 'delivered', 'earnings', 'total_sales', 'today_sales', 'yesterday_sales', 'week_sales', 'month_sales', 'year_sales'));
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

    public function getChartValues()
    {

        $chart_values = [];

        for ($i = 1; $i <= 12; $i++) {
            $value = Processing::whereMonth('created_at', '=', $i)->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
            array_push($chart_values, $value);
        }

        return [
            'success' => true,
            'values' => $chart_values
        ];
    }

    public function getLatestSales()
    {
        $currency = Settings::select('currency')->where('id', 1)->first()->currency;


        $latest_sales = Processing::latest()->take(5)->get();


        if ($latest_sales) {

            return [
                'success' => true,
                'values' => $latest_sales,
                'currency' => $currency,
            ];
        }
    }

    public function getLatestProducts()
    {

        $latest_products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')->latest()->take(5)->get();

        if ($latest_products) {

            return [
                'success' => true,
                'values' => $latest_products,
            ];
        }
    }
}
