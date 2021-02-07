<?php

namespace App\Http\Controllers\Api;

use App\Models\Auteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuteurRequest;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auteurs = Auteur::orderBy('created_at', 'desc')->get();
        return response()->json(['auteurs' => $auteurs]);
        // return response()->json(['auteurs' => Auteur::all()],200);
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
    public function store(AuteurRequest $request)
    {
       $auteur = new Auteur; 
       $auteur->nom = $request->nom;
       $auteur->prenom = $request->prenom;
       $auteur->date_naissance = $request->date_naissance;
       $auteur->nationalite = $request->nationalite;
       $auteur->save(); 
       return response()->json(['auteur'=> $auteur],200);
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
        $auteur = Auteur::find($id); 
        $auteur->nom = $request->nom;
        $auteur->prenom = $request->prenom;
        $auteur->date_naissance = $request->date_naissance;
        $auteur->nationalite = $request->nationalite;
        $auteur->save(); 
        return response()->json(['auteur'=> $auteur],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $auteur = Auteur::findOrFail($id)->delete(); 
    //    $auteur = Auteur::findOrFail($id);
    //  $auteur->delete();
        return response()->json(['auteur'=> $auteur],200);
    }
}
