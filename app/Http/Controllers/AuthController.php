<?php

namespace App\Http\Controllers;
use App\Services\FirebaseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $firebase;
    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase->getDatabase();
    }
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('login'); // Tạo file login.blade.php trong thư mục views
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập từ Firebase
        $data = $this->firebase->getReference('users/admin')->getValue();

        if ($data !== null) {
            if ($data['password'] !== $request->password) {
                return back()->withErrors(['login' => 'Invalid username or password']);
            } else {
                session(['user' => $data]);
                return redirect()->route('home');
            }
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }

    // Hiển thị trang home
    public function home()
    {
        $user = session('user');
        return view('home', compact('user')); // Tạo file home.blade.php trong thư mục views
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('login'); // Chuyển hướng về trang đăng nhập
    }
}