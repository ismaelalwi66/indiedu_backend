<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {

        $section = Section::where('name', $request->product)->first();
        $id = date('YmdHis');

        $data = Transaction::create([
            'id' => $id,
            'user_id' => Auth::id(),
            'section_id' => $section->id,
            'ordered_on' => now(),
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Silahkan segera lunasi pembayaran'

        ]);
    }
}
