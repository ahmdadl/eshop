<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(User $user)
    {
        abort_if($user->id !== auth()->id(), 403);

        if (Gate::allows('change-role')) {
            $state = $this->loadAdminStats($user);
        } else {
            $state = $this->loadUserStats($user);
        }

        [
            $countOrders,
            $sentOrders,
            $products,
            $totalPaid,
            $usersCount,
            $revCount
        ] = $state;

        return view('user.index', compact(
            'user',
            'countOrders',
            'sentOrders',
            'products',
            'totalPaid',
            'usersCount',
            'revCount'
        ));
    }

    public function getOrders(User $user)
    {
        $orders = Order::where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->paginate(40);

        return view('user.orders', compact('user', 'orders'));
    }

    public function getProducts(User $user)
    {
        $products = Product::with(['orders', 'pCat'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(40);

        return view('user.products', compact('user', 'products'));
    }

    public function getUsers(User $user)
    {
        abort_if(Gate::denies('change-role'), 403);

        $users = User::withCount('products')
            ->withCount('orders')
            ->paginate(30);

        return view('user.super', compact('users'));
    }

    public function updateRole(User $user)
    {
        abort_if(Gate::denies('change-role'), 403);

        ['super' => $isSuper] = request()->validate([
            'super' => 'required|bool'
        ]);

        $user->role = $isSuper ? (User::SuperRole) : 0;

        $user->update();

        return response()->json(['updated' => true]);
    }

    private function loadUserStats($user): array
    {
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

        return [
            $countOrders,
            $sentOrders,
            $products,
            $totalPaid,
            0,
            0
        ];
    }

    private function loadAdminStats($user)
    {
        $productsCount = DB::table('products')
            ->selectRaw('COUNT(id) as pc')
            ->get();

        $countOrders = DB::table('orders')
            ->selectRaw('COUNT(id) as oc')
            ->get();

        $sentOrders = DB::table('orders')
            ->selectRaw('COUNT(id) as sc')
            ->where('sent', true)
            ->get();

        $totalPaid = DB::table('orders')
            ->selectRaw('SUM(total) as paid')
            ->get();

        $usersCount = DB::table('users')
            ->selectRaw('COUNT(id) as uc')
            ->get();

        $revCount = DB::table('rates')
            ->selectRaw('COUNT(id) as rc')
            ->get();

        return [
            $countOrders,
            $sentOrders,
            $productsCount,
            $totalPaid,
            $usersCount,
            $revCount
        ];
    }
}
