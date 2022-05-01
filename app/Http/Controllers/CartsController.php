<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Processing;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Settings::select('currency')->where('id', 1)->first()->currency;

        return view('pages.checkout', compact('currency'));
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

        if (!$request->get('product_id')) {
            return [
                'message' => 'Cart items returned',
                'items' => Cart::where('user_id', auth()->user()->id)->count(),
            ];
        }

        // Getting product details
        $product = Product::where('id', $request->get('product_id'))->first();


        $productFoundInCart = Cart::where('product_id', $request->get('product_id'))->pluck('id');


        if ($productFoundInCart->isEmpty()) {


            if ($product->sale_price == null) {
                $on_sale = false;
            } else {
                $on_sale = true;
            }


            // Adding Product in cart.

            if ($on_sale) {
                $cart = Cart::create([
                    'product_id' => $product->id,
                    'quantity' => $request->get('quantity'),
                    'price' => $product->sale_price,
                    'user_id' => auth()->user()->id,
                ]);
            } else {
                $cart = Cart::create([
                    'product_id' => $product->id,
                    'quantity' => $request->get('quantity'),
                    'price' => $product->price,
                    'user_id' => auth()->user()->id,
                ]);
            }
        } else {
            // Incrementing Product Quantity.

            $quantity = Cart::where('product_id', $request->get('product_id'))->first("quantity");

            if (($quantity["quantity"] + $request->get('quantity')) <= 10) {
                $cart = Cart::where('product_id', $request->get('product_id'))->increment('quantity', $request->get('quantity'));
            } else {
                // Limit exceeded error

                return ['error' => "Limite dépassée, max de 10 quantité par article."];
            }
        }

        // Check user Cart items

        if ($cart) {
            return [
                'message' => 'Cart Updated',
                'items' => Cart::where('user_id', auth()->user()->id)->count(),
            ];
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

    public function getCartItemsForCheckout()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->user()->id)->get();

        $finalData = [];

        $amount = 0;

        if (isset($cartItems)) {

            foreach ($cartItems as $cartItem) {

                if ($cartItem->product) {

                    foreach ($cartItem->product as $cartProduct) {

                        if ($cartProduct->id == $cartItem->product_id) {

                            $finalData[$cartItem->product_id]['id'] = $cartProduct->id;

                            $finalData[$cartItem->product_id]['name'] = $cartProduct->name;

                            $finalData[$cartItem->product_id]['slug'] = $cartProduct->slug;

                            $finalData[$cartItem->product_id]['sale_price'] = $cartItem->price;

                            $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;

                            $finalData[$cartItem->product_id]['image_name'] = $cartProduct->image_name;

                            $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;

                            $amount += $cartItem->price * $cartItem->quantity;

                            $finalData['totalAmount'] = $amount;
                        }
                    }
                }
            }
        }


        return response()->json($finalData);
    }

    public function processOrder(Request $request)
    {
        $fullName = $request->get('fullName');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $wilaya = $request->get('wilaya');
        $commune = $request->get('commune');
        $orders = $request->get('order');
        $amount = $request->get('amount');

        $ordersArray = [];

        // Getting order details

        foreach ($orders as $order) {

            if (isset($order['id'])) {
                $ordersArray[$order['id']]['product_id'] = $order['id'];
                $ordersArray[$order['id']]['product_name'] = $order['name'];
                $ordersArray[$order['id']]['price'] = $order['sale_price'];
                $ordersArray[$order['id']]['quantity'] = $order['quantity'];
            }
        }

        $processingDetails = Processing::create([
            'client_name' => $fullName,
            'client_address' => $address,
            'client_wilaya' => $wilaya,
            'client_commune' => $commune,
            'client_phone' => $phone,
            'amount' => $amount,
            'status' => 'En attente',
            'order_details' => json_encode($ordersArray)
        ]);

        if ($processingDetails) {
            // Clear the cart after order success

            Cart::where('user_id', auth()->user()->id)->delete();

            return ['success' => 'Commande complétée avec succès.'];
        } else {

            return ['error' => "Échec de la commande, contacter le support!"];
        }
    }

    public function deleteItem(Request $request)
    {

        if ($request->get('productId')) {
            $productId = $request->get('productId');

            Cart::where([['user_id', '=', auth()->user()->id], ['product_id', '=', $productId]])->delete();

            return ['success' => 'Article supprimer avec succès.'];
        } else {
            return ['error' => "Échec de la supression, Réessayez plus tard!"];
        }
    }

    public function applyCoupon($code)
    {

        $coupon_found = Coupon::where([['code',  $code], ['expiration_date', '>=', Carbon::now()->toDateString()]])->first();

        if ($coupon_found) {
            return [
                'success' => 'Coupon appliqué',
                'type' => $coupon_found->type,
                'value' => $coupon_found->value
            ];
        } else {
            return ['error' => "Entrer un coupon valide!"];
        }
    }
}
