<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::orderBy('title','asc')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Data Found',
            'data' => $data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataBook = new Book;

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required|date'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
            'status' => false,
            'message' => 'Fail Added Data',
            'data' => $validator->errors()
            ]);
        }

        $dataBook->title = $request->title;
        $dataBook->author = $request->author;
        $dataBook->publication_date = $request->publication_date;

        $post = $dataBook->save();

        return response()->json([
            'status' => true,
            'message' => 'Success Added Data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Book::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'data' => $data
            ],200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataBook = Book::find($id);

        if (empty($dataBook)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found'
            ], 404);
        }

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required|date'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
            'status' => false,
            'message' => 'Fail Updated Data',
            'data' => $validator->errors()
            ]);
        }

        $dataBook->title = $request->title;
        $dataBook->author = $request->author;
        $dataBook->publication_date = $request->publication_date;

        $post = $dataBook->save();

        return response()->json([
            'status' => true,
            'message' => 'Success Updated Data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBook = Book::find($id);

        if (empty($dataBook)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found'
            ], 404);
        }

        $post = $dataBook->delete();

        return response()->json([
            'status' => true,
            'message' => 'Success Delete Data'
        ]);
    }
}
