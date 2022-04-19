<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $reference = $this->database->getReference('contacts')->getSnapshot()->getValue();
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $reference == null ? [] : $reference,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $postData = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        // Create a key for a new post
        $newContactKey = $this->database->getReference('contacts')->push($postData)->getKey();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $newContactKey,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $postData = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        $listKeys = $this->database->getReference('contacts')->getChildKeys();

        if (!in_array($id, $listKeys)) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found!',
                'data' => [],
            ], 400);
        }

        $updates = [
            'contacts/' . $id => $postData,
        ];

        $updateKey = $this->database->getReference()->update($updates);

        return response()->json([
            'code' => 200,
            'message' => 'Success updated!',
            'data' => $updateKey,
        ]);
    }

    public function delete($id)
    {
        $listKeys = $this->database->getReference('contacts')->getChildKeys();
        if (!in_array($id, $listKeys)) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found!',
                'data' => [],
            ], 400);
        }
        $this->database->getReference()->removeChildren([
            'contacts/' . $id
        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Success deleted!',
            'data' => [],
        ]);
    }

    public function detail($id)
    {
        $listKeys = $this->database->getReference('contacts')->getSnapshot()->getValue();
        if (!in_array($id, array_keys($listKeys))) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found!',
                'data' => [],
            ], 400);
        }
        return response()->json([
            'code' => 200,
            'message' => 'Success!',
            'data' => $listKeys[$id],
        ]);
    }
}
