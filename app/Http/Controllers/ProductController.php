<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UpdateProduct;
use App\Product;
use App\User;
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
            Product::with('pCat')->where('category_slug', $cat_slug)
                ->whereIn('brand', $brands)
                ->paginate(30)
        );
    }

    public function filterCondition(string $cat_slug, int $is_used)
    {
        return response()->json(
            Product::with('pCat')->where('category_slug', $cat_slug)
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
            Product::with('pCat')->where('category_slug', $cat_slug)
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
    public function store(Request $request, int $user_id)
    {
        $req = (object) $request->validate([
            'cat' => 'required|numeric|exists:categories,id',
            'subCat' => 'required|numeric|exists:categories,id',
            'name' => 'required|string',
            'brand' => 'required|string',
            'info' => 'required|string|min:10',
            'price' => 'required|numeric|min:1',
            'amount' => 'required|numeric|min:1',
            'save' => 'required|numeric|min:0|max:100',
            'color' => 'required|string',
            'is_new' => 'sometimes'
        ]);

        $subCat = Category::find($req->subCat);

        $req->user_id = $user_id;
        $req->category_slug = $subCat->slug;
        $req->is_used = isset($req->is_new) ? false : true;
        $req->color = explode(',', $req->color);
        $req->img = $this->getImgArr();

        unset($req->cat);
        unset($req->subCat);
        unset($req->is_new);

        $subCat->products()->create((array) $req);

        return redirect(
            '/' . app()->getLocale() . '/user/' . $user_id . '/products'
        );
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
    public function edit(int $user_id, Product $product)
    {
        return view('product.create', [
            'cats' => $this->getList(),
            'p' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, Product $product)
    {
        $req = (object) $request->validated();

        $product->name = $req->name;
        $product->brand = $req->brand;
        $product->info = $req->info;
        $product->price = $req->price;
        $product->amount = $req->amount;
        $product->save = $req->save;
        $product->color = explode(',', $req->color);
        $product->is_used = isset($req->is_new) ? false : true;

        $product->update();

        return redirect('/' . app()->getLocale() . '/p/' . $product->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json(['deleted' => true]);
        }

        return redirect('/');
    }
}
