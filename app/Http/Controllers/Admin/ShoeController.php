<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoes = Shoe::Paginate(10);
        return view('admin.shoes.index', compact('shoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoe = new Shoe;
        return view('admin.shoes.form', compact('shoe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoe = new Shoe;
        $data = $request->all();
        $data_validate = $this->validation($data);
        $shoe->fill($data_validate);
        $data_validate['is_available'] = $request->has('is_available' ? 1 : 0);
        $shoe->save();
        return to_route('admin.shoes.show', $shoe)->with('message', 'Scarpa creata');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function show(Shoe $shoe)
    {
        return view('admin.shoes.show', compact('shoe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoe $shoe)
    {
        return view('admin.shoes.form', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoe $shoe)
    {
        $data = $request->all();
        $data_validate = $this->validation($data);
        $data_validate['is_available'] = $request->has('is_available' ? 1 : 0);
        $shoe->update($data_validate);
        return view('admin.shoes.show', compact('shoe'))->with('message', 'Scarpa modificata con successo');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return to_route('admin.shoes.index')->with('message', 'Scarpa eliminata!')
            ->with('message-type', 'danger');
    }
    // Validazione
    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'brand' => 'required|string|max:50',
                'model' => 'required|string|max:100',
                'material' => 'string|max:100|nullable',
                'image' => 'nullable|image|mimes:jpg,png,jpeg',
                'color' => 'required|string|max:20',
                'price' => 'required|decimal:2',
                'description' => 'string',
                'is_available' => 'boolean',
            ],
            [
                'brand.required' => 'Il brand è obbligatorio',
                'brand.string' => 'Il brand deve essere una stringa',
                'brand.max' => 'Il testo deve avere massimo 50 caratteri',

                'model.required' => 'Il modello è obbligatorio',
                'model.string' => 'Il modello deve essere una stringa',
                'model.max' => 'Il testo deve avere massimo 100 caratteri',

                'material.string' => 'Il materiale deve essere una stringa',
                'material.max' => 'Il testo deve avere massimo 100 caratteri',

                'image.image' => 'Inserisci un file',
                'image.mimes' => 'I formati accettati sono: jpg, png or jpeg',

                'color.required' => 'Il colore è obbligatorio',
                'color.string' => 'Il colore deve essere una stringa',
                'color.max' => 'Il testo deve avere massimo 20 caratteri',

                'price.required' => 'Il prezzo è obbligatorio',
                'price.decimal' => 'Il prezzo deve essere un numero',

                'description.string' => 'La descrizione deve essere una stringa',

            ]
        )->validate();
        return $validator;
    }
}
