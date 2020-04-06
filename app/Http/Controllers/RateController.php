<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{

    private static $vRules = [
        'rate' => 'required|numeric|min:0|max:5',
        'message' => 'nullable|string|min:5'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return response()->json(
            Rate::with('user')
                ->where('product_id', $product->id)
                ->latest()
                ->paginate(7)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        $r = request()->validate(self::$vRules);

        $r = new Rate($r + ['user_id' => auth()->id()]);

        $product->rates()->save($r);

        $r->load('user');

        return response()->json([
            'created' => true,
            'obj' => $r
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        $r = (object)request()->validate([
            'user_id' => 'required|exists:users,id'
        ] + self::$vRules);

        abort_unless($r->user_id === auth()->id(), 403);

        $rate->rate = $r->rate;
        $rate->message = $r->message;

        $rate->save();

        return response()->json(['obj' => $rate]);
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
}
