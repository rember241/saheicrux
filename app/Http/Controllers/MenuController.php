<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Menu::orderBy('sorting', 'ASC')->get();
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
        $this->validate($request, [
            'title' => 'required',
            'icon' => 'required',
        ]);

        $tests = Menu::all()->toArray();
        $count = 0;
        foreach($tests as $key => $test) {
                $count = $key + 1;
        }
        return Menu::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'path' => $request->path ? $request->path : '',
            'parent_id' => $request->parent_id ? $request->parent_id : 0,
            'sorting' => $count,
            'isActive' => $request->isActive,
            'color' => $request->color,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sorting(Request $request)
    {
        $menus = Menu::all();
        foreach ($menus as $menu) {
            $menu->timestamps = false;
            $id = $menu->menu_id;
            foreach ($request->menus as $menuFrontEnd) {
                if ($menuFrontEnd['menu_id'] == $id) {
                    $menu->update(['sorting' => $menuFrontEnd['sorting']]);
                }
            }
        }
        return response()->json([], 201);
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
            'title' => 'required|string',
            'icon' => 'required|string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->title = $request->title;
        $menu->icon = $request->icon;
        $menu->path = $request->path ? $request->path : '';
        $menu->parent_id =$request->parent_id;
        $menu->isActive = $request->isActive;
        $menu->color = $request->color;
        $menu->save();

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
        //
    }
}
