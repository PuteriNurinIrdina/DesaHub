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
        // Fetch info
        $user = auth()->user();

        // Initialize query for activity logs
        $query = ActivityLog::where('account_id', $user->id);

        // If a search query is provided, filter by activity details or activity type
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->input('search');
            $query->where(function($query) use ($searchTerm) {
                $query->where('activityDetails', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('activityType', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Fetch activity logs for the logged-in user
        $activityLogs = $query->latest()->limit(10)->get();

        return view('account.dashboard', compact('user', 'activityLogs'));
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
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $admin = Auth::guard('web')->user();

            // Verify if the current password matches
            if (!Hash::check($request->current_password, $admin->password)) {
                return redirect()->back()->with('error', 'Kata laluan semasa tidak sah.');
            }

            // Update the password
            DB::table('account')
                ->where('id', $admin->id)
                ->update([
                    'password' => bcrypt($request->new_password),
                ]);

            return redirect()->route('dashboard')->with('success', 'Kata laluan telah berjaya diubah.');
        }
}