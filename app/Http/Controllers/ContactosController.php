<?php

namespace App\Http\Controllers;

use App\Models\contactos;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Contacto.index');
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
        return view('Contacto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(contactos $contactos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contactos $contactos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contactos $contactos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contactos $contactos)
    {
        //
    }
}
