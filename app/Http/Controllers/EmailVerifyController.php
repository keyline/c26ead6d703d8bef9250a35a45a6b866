<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmailVerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * verify user token
     */
    public function verify(Request $request, $id, $token)
    {

        $id  = Helper::decoded($id);

        $token = Helper::decoded($token);

        $user = User::where('id', $id)
            ->where('remember_token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('invalid-token');
        } else {
            $user->remember_token = null;
            $user->valid = 1;
            $user->email_verified_at = Carbon::now()->timestamp;
            $user->save();
            return redirect()->route('active-token');
        }
    }

   /*
    public function invalidToken()
    {
        view('email-templates.invalidToken');
    }

    public function activeToken()
    {
        view('email-templates.activeToken');
    }
    */
}
