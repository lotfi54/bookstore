<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Models\Auteur;
use App\Models\Livres;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livres = Livres::orderBy('created_at', 'desc')->get();
        $genres = Genre::all();
        $auteurs = Genre::all();
        return response()->json(['livres' => $livres,'genres' => Genre::pluck('nom')->all(),'auteurs' => Auteur::pluck('nom')->all()],200);
    
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
        $this->validate($request,[
            'titre' => 'required',
           
            'auteur' => 'required',
            'genre' => 'required',
            'date_achat' => 'required',
            'date_parution' => 'required',
            'date_parution' => 'required',
            'langue_livre' => 'required',
            'isbn' => 'required',
            'nbr_pages' => 'required',
            'annee' => 'required',
        ]);
        $photo = $request->file('photo');
   
        if(isset($photo))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$photo->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('livre'))
            {
                Storage::disk('public')->makeDirectory('livre');
            }

            $livreImage = Image::make($photo)->resize(1600,1066)->save();
            Storage::disk('public')->put('livre/'.$imageName,$livreImage);

        } else {
            $imageName = "default.png";
        }
        $livre = new Livre();
        $livre->user_id = Auth::id();
        $livre->title = $request->title;
        $livre->date_achat = $request->date_achat;
        $livre->date_parution = $request->date_parution;
        $livre->langue_livre = $request->langue_livre;
        $livre->annee = $request->annee;
        $livre->isbn = $request->isbn;
        $livre->nbr_pages = $request->nbr_pages;
        $livre->photo = $imageName;
        $livre->save();

        $livre->genres()->attach($request->genres);
        $livre->auteur()->attach($request->auteur);

   return response()->json(['livre'=> $livre],200);
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
        //
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
