<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Subject;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request)
    {
        try {
            $validate = $request->safe();

            $id = date('YmdHis');

            $image_name = $validate->image->getClientOriginalName();
            $image = Storage::disk('s3')->put('images/evidence', $validate->image);
            $uri_image = Storage::disk('s3')->url($image);


            Transaction::create([
                'id' => $id,
                'subject_id' => $validate->subject_id,
                'user_id' => Auth::id(),
                'bank_name' => $validate->bank_name,
                'evidence' => $image_name,
                'evidence_url' => $uri_image,
                'ordered_on' => now(),
                'status' => 'pending'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih sudah membeli course ini !',
                'data' => null

            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi gagal',
                'error' => $e->getMessage()

            ], 404);
        }
    }

    public function index()
    {

        $data = Transaction::all();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {

            $image_name = $request->image->getClientOriginalName();
            $image = Storage::disk('s3')->put('images/evidence', $request->image);
            $uri_image = Storage::disk('s3')->url($image);


            Transaction::where('id', $id)->update([
                'bank_name' => $request->bank_name,
                'evidence' => $image_name,
                'evidence_url' => $uri_image,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih sudah membeli course ini !',
                'data' => null

            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi gagal',
                'error' => $e->getMessage()

            ], 404);
        }
    }

    public function show($id)
    {
        $data = Transaction::find($id);
    }

    public function destroy($id)
    {
        try {
            Transaction::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Deleted Success',
                'status' => '200',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Delete Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }
}
