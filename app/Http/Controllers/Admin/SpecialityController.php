<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speciality;
use App\Http\Requests\StoreSpecialityRequest;
use App\Http\Requests\UpdateSpecialityRequest;
use App\Http\Controllers\Controller; // yo agregue esta

class SpecialityController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:especialidad-list')->only('index');
        $this->middleware('can:especialidad-create')->only('create', 'store');
        $this->middleware('can:especialidad-edit')->only('edit', 'update');
        $this->middleware('can:especialidad-delete')->only('destroy');
        $this->middleware('can:especialidad-show')->only('show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialities = Speciality::all();
        return view('admin.specialities.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.specialities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecialityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialityRequest $request)
    {
        Speciality::create($request->validated());

        return redirect()->route('admin.specialities.index')->with('success', 'La especialidad se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit(Speciality $speciality)
    {
        return view('admin.specialities.edit', compact('speciality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecialityRequest  $request
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialityRequest $request, Speciality $speciality)
    {
        $speciality->update($request->validated());

        return redirect()->route('admin.specialities.index')->with('success', 'La especialidad se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        $speciality->delete();

        return redirect()->route('admin.specialities.index')->with('success', 'La especialidad se eliminó con éxito');
    }
}
