<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(){
        return view('articles.create');
    }

    public function store(Reqyest $request){

    $validated = $request->validate([
            'title'   => ['required','string','min:3','max:150'],
            'slug'    => ['nullable','string','max:180'],
            'content' => ['nullable','string'],
            'tags'    => ['nullable','string'],
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.min'      => 'Le titre doit contenir au moins :min caractères.',
            'title.max'      => 'Le titre doit contenir au plus :max caractères.',
        ]);


     return back()
            ->withInput()
            ->with('status', 'Formulaire reçu avec succès !');
    }

    


}
