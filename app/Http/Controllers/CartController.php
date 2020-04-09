<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    use GetCategoryList;

    /**
     * cart blueprint
     * * id product id
     * * product
     * * amount
     * * total
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        $carts = session('cart');

        if (request()->wantsJson()) {
            return response()->json($carts);
        }
    }

    public function create(\Faker\Generator $faker) {
        return view('cart.checkout', [
            'cats' => $this->getList(),
            'userName' => explode(' ', auth()->user()->name),
            'address' => $faker->address,
            'card' => $faker->creditCardNumber
        ]);
    }

    public function done(Request $request) {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carts = session('cart', []);
        if ($this->checkIfIdExsits($request->get('id'), $carts)) {
            return response()->json(['exists' => true]);
        }

        $cart = request()->validate([
            'id' => 'required|exists:products,id',
            'product' => 'required',
            'amount' => 'required|numeric',
            'total' => 'required|numeric'
        ]);

        session()->push('cart', $cart);

        return response()->json($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('cart.show', [
            'cats' => $this->getList(),
            // 'cart' => session('cart')
        ]);
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
        $carts = session('cart', []);

        if (empty($carts)) {
            return response()->json(['empty' => true]);
        }

        if (!$this->checkIfIdExsits($pid, $carts)) {
            return response()->json(['exists' => false]);
        }

        ['amount' => $amount, 'total' => $total] = request()->validate([
            'amount' => 'required|numeric',
            'total' => 'required|numeric'
        ]);

        foreach ($carts as &$cart) {
            if ($cart['id'] === $pid) {
                $cart['amount'] = $amount;
                $cart['total'] = $total;
            }
        }

        session()->put('cart', $carts);

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
    public function destroy(int $id)
    {
        $carts = session('cart', []);

        if (empty($carts)) {
            return response()->json(['empty' => true]);
        }

        if (!$this->checkIfIdExsits($id, $carts)) {
            return response()->json(['exists' => false]);
        }



        $i = 0;
        foreach ($carts as &$cart) {
            if ($cart['id'] === $id) {
                unset($carts[$i]);
            }
            $i++;
        }

        session()->put('cart', array_values($carts));

        return response()->json(['deleted' => true]);
    }

    private function checkIfIdExsits(int $id, array $carts): bool
    {
        return in_array($id, array_column($carts, 'id'));
    }
}
