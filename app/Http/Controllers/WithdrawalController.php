<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;

class WithdrawalController extends Controller
{
    public function showWithdrawForm()
    {
        return view('Withdrawal.withdraw'); 
    }

    public function processWithdraw(Request $request)
    {
        $request->validate([
            'ic_num' => 'required|string|max:12',
        ]);

        $participant = RegisterEvent::where('ic_num', $request->ic_num)->first();

        if ($participant) {
            return view('Withdrawal.confirm', compact('participant'));
        } else {
            return redirect()->route('withdraw.form')->with('error', 'No kad pengenalan tidak dijumpai.');
        }
    }

    public function confirmWithdrawal(Request $request)
    {
        $participant = RegisterEvent::find($request->participant_id);

        if ($participant) {
            $participant->delete();
            return redirect()->route('withdraw.form')->with('success', 'Pendaftaran berjaya dibatalkan.');
        } else {
            return redirect()->route('withdraw.form')->with('error', 'No kad pengenalan tidak dijumpai.');
        }
    }
}
