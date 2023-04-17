<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';

        $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'desc';

        $shoes = Shoe::orderBy($sort, $order)->paginate(10)->withQueryString();

        return view('admin.shoes.index', compact('shoes', 'order', 'sort'));
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
        if (Arr::exists($data_validate, 'image')) { // Se c'è un'immagine nell'array $data_validate
            $path = Storage::put('uploads', $data_validate['image']); // Ottieni il path e salvala nella cartella uploads
            $data_validate['image'] = $path; // Il dato da salvare in db diventa il path dell'immagine
        }
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
        if (Arr::exists($data_validate, 'image')) { // Se c'è un'immagine nell'array $data_validate
            if ($shoe->image) Storage::delete($shoe->image);
            $path = Storage::put('uploads', $data_validate['image']); // Ottieni il path e salvala nella cartella uploads
            $data_validate['image'] = $path; // Il dato da salvare in db diventa il path dell'immagine

        }
        $data_validate['is_available'] = $request->has('is_available' ? 1 : 0);
        $shoe->update($data_validate);
        return view('admin.shoes.show', compact('shoe'))->with('message', 'Scarpa modificata con successo');;
    }

    /**
     * Soft deletes the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    {
        // if ($shoe->image) Storage::delete($shoe->image);
        $shoe->delete();
        return to_route('admin.shoes.index')->with('message', 'Scarpa spostata nel cestino!')
            ->with('message-type', 'danger');
    }

    /**
     * Force deletes the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function forcedelete(Int $id)
    {
        $shoe = Shoe::where('id', $id)->onlyTrashed()->first();
        if ($shoe->image) Storage::delete($shoe->image);
        $shoe->forceDelete();
        return to_route('admin.shoes.trash')->with('message', 'Scarpa eliminata definitivamente!')
            ->with('message-type', 'danger');
    }

    /**
     * Restores the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function restore(Int $id)
    {
        $shoe = Shoe::where('id', $id)->onlyTrashed()->first();
        $shoe->restore();
        return to_route('admin.shoes.index')->with('message', 'Scarpa ripristinata!');
    }

    /**
     * Display a listing of the trashed resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';

        $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'desc';

        $trashedshoes = Shoe::onlyTrashed()->orderBy($sort, $order)->paginate(10)->withQueryString();
        // @dd($trashedshoes);

        return view('admin.shoes.index', compact('trashedshoes', 'order', 'sort'));
    }



    // ******************
    //   FUNCTIONS 
    // ******************


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
                'price' => 'required|numeric|max:9999.99',
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
                'price.max' => 'Il prezzo massimo deve essere di €9999.99',

                'description.string' => 'La descrizione deve essere una stringa',

            ]
        )->validate();
        return $validator;
    }
}
