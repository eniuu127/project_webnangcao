<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
    
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Bạn không có quyền vào admin']);
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
    }

    public function dashboard()
    {   
        $products = Product::all(); 
        return view('admin.dashboard', compact('products'));
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }
}
