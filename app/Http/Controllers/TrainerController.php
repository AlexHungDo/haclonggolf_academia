<?php

namespace App\Http\Controllers;
use  App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $trainers=Trainer::all();
        return view('admin.trainer.index', compact('trainers'));
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
    public function edit(Trainer $trainer)
    {
        return view('admin.trainer.edit', compact('trainer'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Trainer $trainer)
    {
        //
        $request->validate([
            'full_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        $trainer -> update([
            $trainer->full_name = $request->input('full_name'),
            $trainer->address = $request->input('address'),
            $trainer->phone_number = $request->input('phone_number')
        ]);

        return redirect()->route('trainers.index')->with('success', 'Sửa thành công!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
