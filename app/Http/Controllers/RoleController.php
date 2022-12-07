<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = new Role;

        if($request->has('sortBy')) {
            if($request->get('sortDesc') === true){
                $role = $role->orderBy($request->get('sortBy'),'desc');
            }
            else{
               $role = $role->orderBy($request->get('sortBy'),'asc');
            }
        }
        else{
           $role = $role->orderBy('role_id','desc');
        }

        $itemsPerPage = 10;
        if($request->has('itemsPerPage')){
            $itemsPerPage = $request->get('itemsPerPage');
        }
        return $role->paginate($itemsPerPage);
    }

    /**
     * getAll
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $model = New Role();
        //validate request
        $this->validate($request, [
            'roleName' => 'required'
        ]);
    //    validateRequest($model,$request,[],[]);
        return Role::create([
            'roleName' => $request->roleName
        ]);
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'roleName' => 'required|string',
        ]);

        $role = Role::findOrFail($id);

        $role->roleName = $request->roleName;
        $role->save();

        return response()->json('ok',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return response()->json('ok', 200);
    }

    
    public function assignRole(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required',
            'role_id' => 'required',
        ]);
        return Role::where('role_id', $request->role_id)->update([
            'permission' => $request->permission,
        ]);
    }

    public function getPermission()
    {
        return Auth::user()->role->permission;
    }
}
