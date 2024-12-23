<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\Event;
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

        if ($account && Hash::check($credentials['password'], $account->password)) {
            if (Auth::attempt($credentials)) {
                if (Auth::user()->status) {
                    return redirect()->intended(route('dashboard'));
                } else {
                    return redirect()->intended(route('login'));
                }
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
            "role" => "required",
        ], [
            'fullname.required' => 'Sila isi nama.',
            'email.email' => 'E-mel mesti mengandungi format yang sah dengan simbol @',
            'email.unique' => 'E-mel telah diambil.',
            'password.min' => 'Kata laluan mesti sekurang-kurangnya 8 karakter.',
            'role.required' => 'Sila pilih peranan.',
        ]);

        $account = new Account();
        $account->fullname = $request->fullname;
        $account->email = $request->email;
        $account->password = Hash::make($request->password);
        $account->role = $request->role;
        $account->save();

        if ($account->save()) {
            return redirect(route('login'))->with('success', 'Pendaftaran Berjaya');
        }

        return redirect(route('register'))->with('error', 'Pendaftaran Tidak Berjaya');
    }

    // Dashboard page
    public function dashboard(Request $request)
    {
        $user = auth()->user();

        $eventCount = Event::where('account_id', Auth::id())->count();
        $productCount = Product::where('account_id', Auth::id())->count();

        $query = ActivityLog::where('account_id', $user->id);

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->input('search');
            $query->where(function($query) use ($searchTerm) {
                $query->where('activityDetails', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('activityType', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $activityLogs = $query->latest()->limit(10)->get();

        return view('account.dashboard', compact('user', 'eventCount', 'productCount', 'activityLogs'));
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

        if ($account->save()) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Kemaskini',
                'activityDetails' => 'kemaskini maklumat akaun',
            ]);

            return redirect(route('editAcc'))->with('success', 'Maklumat akaun telah berjaya dikemas kini!');
        }

        return redirect(route('editAcc'))->with('error', 'Maklumat akaun tidak berjaya dikemas kini.');
    }

    // Logout the account
    public function logout(Request $request)
    {
        Auth::logout();

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

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.different' => 'Kata laluan baru mesti berbeza daripada kata laluan semasa.',
            'new_password.min' => 'Kata laluan baru mesti mempunyai sekurang-kurangnya 8 karakter.',
            'confirm_password.required' => 'Sahkan kata laluan perlu diisi.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata laluan semasa tidak betul.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata laluan berjaya ditukar.');
    }
}