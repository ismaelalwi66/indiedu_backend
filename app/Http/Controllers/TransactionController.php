<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Subject;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {

        $subject = Subject::where('name', $request->product)->first();
        $id = date('YmdHis');

        $data = Transaction::create([
            'id' => $id,
            'user_id' => Auth::id(),
            'subject_id' => $subject->id,
            'ordered_on' => now(),
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Silahkan segera lunasi pembayaran'

        ]);
    }

    public function index()
    {

        $data = Transaction::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ]);
    }

    public function show()
    {
        $data = Transaction::find(Auth::id())->get();
    }
}
