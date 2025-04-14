<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ProfileController extends Controller
{
    
        // $pegawai = Auth::user();

        // $pegawai = User::all();
        // return response()->json([
        //     'status'  => true,
        //     'message' => 'Data Profile',
        //     'data'    => $pegawai,
        // ], 200);

        // return response()->json([
        //     'success' => false,
        //     'message' => 'User not found'
        // ], 404);
    
       public function getProfile()
    {
        $pegawai = Auth::user();

        return response()->json([
            'status'  => true,
            'message' => 'Data Profile',
            'data'    => $pegawai,
        ], 200);
    }
}
