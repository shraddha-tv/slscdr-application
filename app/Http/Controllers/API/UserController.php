<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Model\UserState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\UserState  $userState
     * @return \Illuminate\Http\Response
     */
    public function show(UserState $userState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\UserState  $userState
     * @return \Illuminate\Http\Response
     */
    public function edit(UserState $userState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\UserState  $userState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserState $userState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\UserState  $userState
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserState $userState)
    {
        //
    }
}
