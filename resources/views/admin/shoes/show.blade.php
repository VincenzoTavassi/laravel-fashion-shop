@extends('layouts.app')

@section('content')
    {{-- @dump($shoe) --}}
    <div class="container">
        <h1 class="my-3">{{ $shoe->brand }} - {{ $shoe->model }}</h1>

        <a href="{{ route('admin.shoes.index') }}" class="btn btn-primary my-3">Torna alla lista</a>
        <div class="card">
            <img src="{{ $shoe->image }}" class="card-img-top" alt="Shoe image">
            <div class="card-body">
                <h5 class="card-title">{{ $shoe->model }}</h5>
                <p class="card-text">Brand: {{ $shoe->brand }}</p>
                <p class="card-text">Materiale: {{ $shoe->material }}</p>
                <p class="card-text">Colore: {{ $shoe->color }}</p>
                <p class="card-text">Prezzo: € {{ $shoe->price }}</p>
                <p class="card-text">Creato il: {{ $shoe->created_at }}</p>
                <p class="card-text">Aggiornato il: {{ $shoe->updated_at }}</p>
                <p class="card-text">{{ $shoe->description }}</p>

            </div>
        </div>

    </div>
@endsection
