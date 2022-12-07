<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.role_id')
                        ->select('users.*', 'roles.roleName');

        if($request->has('sortBy')) {
            if($request->get('sortDesc') === true){
                $users = $users->orderBy($request->get('sortBy'),'desc');
            }
            else{
               $users = $users->orderBy($request->get('sortBy'),'asc');
            }
        }
        else{
           $users = $users->orderBy('id','desc');
        }

        $itemsPerPage = 10;
        if($request->has('itemsPerPage')){
            $itemsPerPage = $request->get('itemsPerPage');
        }
        
        return $users->paginate($itemsPerPage);
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
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'role_id' => $fields['role_id'],
            'password' => bcrypt($fields['password']),
        ]);

        // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            // 'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate request
        $this->validate($request, [
            'name' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'role_id' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];
        $user = User::where('id', $request->id)->update($data);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = User::findOrFail($id);

        $role->delete();

        return response()->json('ok', 200);
    }

    public function getLogInUser()
    {
        return Auth::user();
    }
}
