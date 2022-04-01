<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\NerdleEntry;

class SubmitNerdleController extends Controller
{
    public function show() {
        if (Auth::user()) {
            return view('submitnerdle');
        }
        return back();
    }

    public function update(Request $request) {
        if ($request->has('submit')) {
            // Validate input
            $validator = Validator::make($request->all(), [
                'attempts' => ['required'],
            ])->validateWithBag('submit');
            
            // Create new Nerdle Entry
            $entry = NerdleEntry::create([
                'user_id' => Auth::user()->id,
                'attempts' => $request->attempts,
                'date' => date('Y-m-d')
            ]);
        }
        return redirect('/');
    }
}
