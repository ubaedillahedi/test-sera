<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MongodbController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $arrBook = [];
        foreach ($books as $book) {
            $arrBook[] = [
                '_id' => $book->_id,
                'name' => $book->name,
                'tahun' => $book->tahun,
            ];
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $arrBook == null ? [] : $arrBook,
        ], 200);
    }

    public function detail($id)
    {
        $book = Book::find($id);
        $response = [];

        if ($book != null) $response = [
            'id' => $book->_id,
            'name' => $book->name,
            'tahun' => $book->tahun,
        ];

        return response()->json([
            'code' => 200,
            'message' => 'Success!',
            'data' => $response,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'tahun' => 'required|numeric',
        ]);

        $postData = [
            'name' => $request->name,
            'tahun' => $request->tahun,
        ];

        $result = Book::create($postData);

        return response()->json([
            'code' => 200,
            'message' => 'Success inserted!',
            'data' => $result,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'tahun' => 'required|numeric',
        ]);

        $book = Book::find($id);

        if ($book == null) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found!',
                'data' => null,
            ]);
        }

        $book->name = $request->name;
        $book->phone = $request->phone;
        $result = $book->save();

        return response()->json([
            'code' => 200,
            'message' => 'Success updated!',
            'data' => $result,
        ]);
    }

    public function delete($id)
    {
        $book = Book::find($id);

        if ($book == null) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found!',
                'data' => null,
            ]);
        }
        $result = $book->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success deleted!',
            'data' => $result,
        ]);
    }
}
