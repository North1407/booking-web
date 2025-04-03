<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase->getDatabase();
    }

    public function storeData()
    {
        $data = ['name' => 'John Doe', 'email' => 'johndoe@example.com'];
        $this->firebase->getReference('users')->push($data);

        return response()->json(['message' => 'Data stored successfully']);
    }

    public function getData()
    {
        $data = $this->firebase->getReference('users')->getValue();
        return response()->json($data);
    }
}
