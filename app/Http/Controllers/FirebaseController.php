<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{


    public function storeData()
    {
        $data = ['name' => 'John Doe', 'email' => 'johndoe@example.com'];
        $this->firebase->getReference('users')->push($data);

        return response()->json(['message' => 'Data stored successfully']);
    }

    public function getData()
    {
        $data = $this->firebase->getReference('users/admin')->getValue();
        return response()->json($data);
    }
}
