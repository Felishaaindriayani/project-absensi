<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiProfileController extends Controller
{
    public function index()
    {
        $pegawai = User::all();
        return response()->json([
            'status'  => true,
            'message' => 'Data Profile',
            'data'    => $pegawai,
        ], 200);
    }
}
