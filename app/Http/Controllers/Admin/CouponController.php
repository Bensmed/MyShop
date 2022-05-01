<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coupons = Coupon::orderBy('created_at', 'asc')->Paginate(10);


        return view('admin.coupons.coupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.newCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon_created = Coupon::create([
            'code' => Str::upper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'max_usage' => $request->max_usage,
            'expiration_date' => $request->expiration_date,
        ]);

        if ($coupon_created) {

            return ['success' => 'Coupon crée avec succès.'];
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
        $coupon = Coupon::where('id', $id)->first();

        $expiration_date = Carbon::parse($coupon->expiration_date)->format("Y-m-d\TH:i");

        return view('admin.coupons.newCoupon', compact('coupon', 'expiration_date'));
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
        $coupon_updated = Coupon::where('id', $id)->update(
            [
                'code' => Str::upper($request->code),
                'type' => $request->type,
                'value' => $request->value,
                'max_usage' => $request->max_usage,
                'expiration_date' => $request->expiration_date,
            ]
        );

        if ($coupon_updated) {
            return ['success' => 'Mise à jour du coupon avec succès.'];
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
        $coupon_deleted = Coupon::where('id', $id)->delete();


        if ($coupon_deleted) {
            return ['success' => 'Un Coupon a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
