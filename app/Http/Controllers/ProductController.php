<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use GetCategoryList;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $c_slug, string $sub)
    {
        return view('product.index', [
            'cats' => $this->getList(),
            'slug' => [$c_slug, $sub],
            'title' => ucwords(str_replace('-', ' ', $sub)),
        ]);
    }

    public function filterBrands(string $cat_slug, string $brands)
    {
        $brands = explode(',', $brands);

        return response()->json(
            Product::where('category_slug', $cat_slug)
                ->whereIn('brand', $brands)
                ->paginate(30)
        );
    }

    public function filterCondition(string $cat_slug, int $is_used)
    {
        return response()->json(
            Product::where('category_slug', $cat_slug)
                ->where('is_used', (int) $is_used)
                ->paginate(30)
        );
    }

    public function filterByPrice(
        string $cat_slug,
        float $from,
        float $to
    ) {
        return response()->json(
            Product::where('category_slug', $cat_slug)
                ->whereBetween(DB::raw('price-(save/100*price)'), [$from, $to])
                ->paginate(30)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', [
            'cats' => $this->getList(),
        ]);
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['user', 'pi']);

        return view('product.show', [
            'cats' => $this->getList(),
            'p' => $product
        ]);
    }

    public function find(Request $request)
    {
        $q = $request->get('q');

        $p = Product::with(['rates', 'pCat'])
            ->where('name', 'LIKE', "%$q%")
            ->orWhere('brand', 'LIKE', "%$q%")
            ->latest()
            ->paginate(30);

        if (request()->wantsJson()) {
            return response()->json($p);
        }

        $request->flash();

        return view('product.index', [
            'cats' => $this->getList(),
            'slug' => ['search', ''],
            'title' => ucwords($q),
            'pros' => $p
        ]);
    }

    public function dailyDeal()
    {
        $p = Product::with('daily')
            ->paginate(30);

        if (request()->wantsJson()) {
            return response()->json($p);
        }

        return view('product.index', [
            'cats' => $this->getList(),
            'slug' => ['search', ''],
            'title' => 'daily',
            'pros' => $p
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
