<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;

class VehicleCRUDController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vehicles'] = Vehicle::orderBy('id','desc')->paginate(5);
    
        return view('vehicles.index', $data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicles.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $Vehicle = new Vehicle;
        $Vehicle->title = $request->title;
        $Vehicle->description = $request->description;
        $Vehicle->save();
     
        return redirect()->route('vehicles.index')
                        ->with('success','Vehicle has been created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show',compact('vehicle'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit',compact('vehicle'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $Vehicle = Vehicle::find($id);
        $Vehicle->title = $request->title;
        $Vehicle->description = $request->description;
        $Vehicle->save();
    
        return redirect()->route('vehicles.index')
                        ->with('success','Vehicle Has Been updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $Vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    
        return redirect()->route('vehicles.index')
                        ->with('success','Vehicle has been deleted successfully');
    }
}
