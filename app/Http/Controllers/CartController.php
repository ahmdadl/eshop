<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * cart blueprint
     * * id product id
     * * product
     * * amount
     * * total
     */
    public function __construct()
    {
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $cart = request()->validate([
            'id' => 'required|exists:products,id',
            'product' => 'required',
            'amount' => 'required|numeric',
            'total' => 'required|numeric'
        ]);

        // check if product id was added before
        foreach (session('cart') as $c) {
            if ($c['id'] === $cart['id']) {
                return response()->json([
                    'exists' => true
                ]);
            }
        }

        session()->push('cart', $cart);

        return response()->json($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $pid)
    {
        ['amount' => $amount] = request()->validate([
            'amount' => 'required|numeric'
        ]);

        $updated = [];

        foreach (session('cart') as $cart) {
            if ($cart['id'] === $pid) {
                $cart['amount'] = $amount;
            }
            $updated[] = $cart;
        }

        session()->put('cart', $updated);

        return response()->json([
            'updated' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
