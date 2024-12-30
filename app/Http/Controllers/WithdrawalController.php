<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;

class WithdrawalController extends Controller
{
    public function processWithdraw($event_id, $ic_num)
    {
        $participant = RegisterEvent::where('ic_num', $ic_num)->where('event_id', $event_id)->first();

        if ($participant) {
            return view('Withdrawal.confirm', compact('participant'));
        } else {
            return redirect()->route('withdraw.confirm', ['event_id' => $event_id, 'ic_num' => $ic_num])
                ->with('error', 'Peserta tidak dijumpai.');
        }
    }

    public function confirmWithdrawal(Request $request, $event_id, $ic_num) {
    \Log::debug('Confirm Withdrawal Request:', $request->all());  
    $participant = RegisterEvent::where('ic_num', $ic_num)
                            ->where('event_id', $event_id)
                            ->first();
    if ($participant) {
        $participant->delete();
        return view('Withdrawal.success');

    } else {
        return redirect()->route('withdraw.confirm', ['event_id' => $event_id, 'ic_num' => $ic_num])->with('error', 'Peserta tidak dijumpai atau tidak sepadan dengan acara.');
    }
    }
    public function withdrawalSuccess() {
        return view('Withdrawal.success');
    }
}