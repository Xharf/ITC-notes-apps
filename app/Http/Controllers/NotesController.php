<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    // public function index()
    // {
    //     $notes = Note::all();
    //     return response()->json([
    //         "status" => "success",
    //         "message" => "Notes have been retrieved successfully",
    //         "data" => $notes,
    //     ], 200);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $note = Note::create([
            'text' => $request->input('text'),
        ]);

        return response()->json([
            'status' => "success",
            'message' => "Notes have been stored successfully",
            'data' => $validator->validated(),
        ], 200);
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'status' => "error",
                'message' => "Id harus berupa angka",
            ]);
        }

        $note = Note::find($id);

        if ($note) {
            return response()->json([
                'status' => "success",
                'message' => "Notes with id '$id' have been retrieve successfully",
                'data' => $note,
            ], 200);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Notes with id '$id' not found",
            ], 404);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     Note::where('id', $id)->update([
    //         'text' => $request->input('text')
    //     ]);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'data was successfully updated',
    //         'data' => Note::find($id),
    //     ]);
    // }


    // public function destroy($id)
    // {
    //     Note::destroy($id);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'data was successfully deleted',
    //     ]);
    // }
}
