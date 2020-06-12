<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Model\Remark;

use App\Http\Resources\Doner as DonerResource;


class DonerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DonerResource::collection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'mobile' => 'required',
                'gender' => 'required',
                'birth_day' => 'required',
                'nic' => 'required|unique:users',
            ]);

            $request['password'] = bcrypt('password');

            $user = User::create($request->all());

            $user->remarks()->create([
                'body' => "Create New",
                'user_id' => $request->user()->id,
            ]);

            return response()->json(["message" => "Add New Doner Successfully"], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Somthing want to wrong on the server."], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function show(Remark $remark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'mobile' => 'required',
                'gender' => 'required',
                'birth_day' => 'required',
                'nic' => 'required|unique:users',
                'remark' => 'required',
            ]);

            $user->update($request->all());

            $user->remarks()->create([
                'body' => "Create New",
                'user_id' => $request->user()->id,
            ]);

            return response()->json(["message" => "Update Doner Successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Somthing want to wrong on the server."], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
