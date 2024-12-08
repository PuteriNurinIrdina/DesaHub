<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccController extends Controller
{
    // Show login page
    public function login()
    {
        return view('account.login');
    }

    // Handle login submission
    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("email", "password");

        $account = Account::where('email', $credentials['email'])->first();

        if (!$account) {
            return redirect(route('login'))->with('error', 'E-mel Tidak Diketemui');
        } elseif (!Hash::check($credentials['password'], $account->password)) {
            return redirect(route('login'))->with('error', 'Salah Kata Laluan');
        } elseif (!$account->status) {
            return redirect(route('login'))->with('error', 'Akaun anda telah dinyahaktifkan.');
        }

        if (Auth::attempt($credentials)) {
            // Check if the logged-in user is an admin
            if (Auth::user()->status) {
                return redirect()->intended(route('dashboard')); // Redirect to the admin page
            } else {
                return redirect()->intended(route('login')); // Redirect to the regular user page
            }
        }

        return redirect(route('login'))->with('error', 'Salah E-mel/Kata Laluan');
    }

    // Registration page
    function register()
    {
        return view('account.register');
    }

    // Handle registration submission
    public function registerPost(Request $request)
    {
        $data = $request->validate([
            "fullname" => "required",
            "email" => "required|email|unique:account,email",
            "password" => "required|string|min:8",
        ], [
            'email.unique' => 'E-mel telah diambil.',
            'password.min' => 'Kata laluan mesti sekurang-kurangnya 8 karakter.',
        ]);

        $account = new Account();
        $account->fullname = $request->fullname;
        $account->email = $request->email;
        $account->password = Hash::make($request->password);
        $account->save();

        if ($account->save()) {
            return redirect(route('login'))->with('success', 'Pendaftaran Berjaya');
        }

        return redirect(route('register'))->with('error', 'Pendaftaran Tidak Berjaya');
    }

    // Dashboard page
    public function dashboard()
    {
        // Fetch admin info
        $admin = auth()->user();

        /* Fetch counts
        $totalEvents = Event::count();
        $totalProducts = Product::count(); */

        // Fetch activity log
        $activityLogs = ActivityLog::latest()->limit(10)->get();

        return view('account.dashboard', compact('admin', 'activityLogs'));
    }

    public function default()
    {
        return view('account.default');
    }

    // Edit account page
    public function editAcc()
    {
        $account = Auth::user();
        return view('account.editAcc', ['account' => $account]);
    }

    // Handle edit account submission
    public function editAccPost(Request $request)
    {
        $account = Auth::user();

        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:account,email,' . $account->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $account->fullname = $request->fullname;
        $account->email = $request->email;
        $account->phone = $request->phone;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $account->profile_picture = $path;
        }

        $account->save();

        return redirect()->route('dashboard')->with('success', 'Maklumat akaun telah berjaya dikemas kini!');
    }

    // Logout the account
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out of their session

        // Optionally invalidate the session and regenerate the token for added security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berjaya log keluar.');
    }

    // Delete Account
    public function deleteAcc() {
        $account = Auth::user();

        $account ->delete();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Akaun anda telah berjaya dihapuskan.');
    }

    // Password reset page
    public function resetpassword()
    {
        return view('account.resetpassword');
    }

    // Handle password reset submission
    public function resetpasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:account,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = DB::table('account')->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'E-mel tidak ditemui.');
        }

        DB::table('account')
            ->where('email', $request->email)
            ->update([
                'password' => bcrypt($request->password),
            ]);

        Mail::to($user->email)->send(new PasswordResetSuccessMail());

        return redirect()->route('login')->with('success', 'Kata laluan telah berjaya ditetapkan semula.');
    }
}