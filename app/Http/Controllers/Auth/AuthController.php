<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
   // عرض صفحة تسجيل الدخول
   public function showLoginForm()
   {
       return view('auth.login'); // عرض صفحة تسجيل الدخول
   }

   // تسجيل الدخول
   public function login(Request $request)
   {
       // التحقق من المدخلات
       $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ]);

       // محاولة التحقق من المستخدم
       $credentials = $request->only('email', 'password');

       if (Auth::attempt($credentials)) {
           return redirect()->intended('/'); // إعادة التوجيه بعد تسجيل الدخول بنجاح
       }

       return back()->withErrors([
           'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
       ]);
   }

    // عرض صفحة التسجيل
    public function showRegistrationForm()
    {
        return view('auth.register'); // تأكد من أنك أنشأت الـ view الخاصة بالتسجيل
    }

    // التسجيل
    public function register(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // إنشاء مستخدم جديد
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // تسجيل الدخول بعد إنشاء الحساب
        Auth::login($user);

        return redirect()->route('home'); // إعادة التوجيه بعد التسجيل
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout(); // تسجيل الخروج
        return redirect('login'); // إعادة التوجيه إلى الصفحة الرئيسية بعد تسجيل الخروج
    }
}
