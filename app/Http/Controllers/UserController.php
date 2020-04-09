<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(User $user)
    {
        abort_if($user->id !== auth()->id(), 403);

        $countOrders = DB::table('orders')
            ->selectRaw('COUNT(id) as oc')
            ->where('user_id', $user->id)
            ->get();

        $sentOrders = DB::table('orders')
            ->selectRaw('COUNT(id) as sc')
            ->where('user_id', $user->id)
            ->where('sent', true)
            ->get();

        $products = DB::table('products')
            ->selectRaw('COUNT(id) as pc')
            ->where('user_id', $user->id)
            ->get();

        $totalPaid = DB::table('orders')
            ->selectRaw('SUM(total) as paid')
            ->where('user_id', $user->id)
            ->get();

        return view('user.index', compact(
            'user',
            'countOrders',
            'sentOrders',
            'products',
            'totalPaid'
        ));
    }

    public function getOrders(User $user)
    {
        $orders = Order::where('user_id', $user->id)
            ->with('product')
            ->paginate(40);

        return view('user.orders', compact('user', 'orders'));
    }
}
