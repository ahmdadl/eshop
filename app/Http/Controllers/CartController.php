<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
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

        $carts = session('cart', []);
        $outCarts = [];
        $amountError = false;

        $ids = collect($carts)->pluck('id');
        $products = Product::without(['rates', 'user', 'pi', 'pcat'])
            ->whereIn('id', $ids)
            ->get(['id', 'amount']);

        // loop check if any product is out of stock
        for ($i = 0; $i < sizeof($products); $i++) {
            $cp = $carts[$i];
            $p = $products[$i];

            if ($p->id === $cp['id']) {
                $cp['product']['amount'] = $p->amount;
                if ($p->amount < 1) {
                    $amountError = true;
                }
            }
            $outCarts[] = $cp;
        }

        session()->put('cart', $outCarts);

        $outCarts[] = ['amountErr' => $amountError];

        return response()->json($outCarts);
    }

    public function create()
    {
        return view('cart.checkout', [
            'cats' => $this->getList(),
            'userName' => explode(' ', auth()->user()->name),
            'address' => Arr::random(['2732 Connelly Keys Suite 758Yostburgh, WA 46872-2314', '9965 Wyman Circle Suite 203New Erickamouth, OK 53434-7598', '694 Rocky Estates Suite 694West Berenice, NY 96502']),
            'card' => Arr::random(['12364545423264546455'])
        ]);
    }

    public function done(Request $request)
    {
        $req = request()->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string|min:10',
            'card' => 'required|numeric|min:1000000'
        ]);

        $carts = session('cart');

        abort_unless(!!sizeof($carts), 404);

        foreach ($carts as $cart) {
            auth()->user()->orders()->create([
                'product_id' => $cart['id'],
                'address' => $req['address'],
                'amount' => $cart['amount'],
                'total' => $cart['total']
            ]);
            $p = Product::find($cart['id']);
            $p->amount -= (int) $cart['amount'];
            $p->update();
        }

        session()->put('cart', []);

        return back()->with('success', true);
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
