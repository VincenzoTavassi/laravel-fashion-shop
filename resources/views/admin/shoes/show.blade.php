@extends('layouts.app')
{{-- @dd(empty($shoe->image)) --}}
@section('content')
  <div class="container">
    <h1 class="my-3">{{ $shoe->brand }} - {{ $shoe->model }}</h1>

    <div class="buttons_detail d-flex">
      <a href="{{ route('admin.shoes.index') }}" class="btn btn-primary my-3">Torna alla lista</a>
      <a href="{{ route('admin.shoes.edit', $shoe) }}" class="btn btn-primary my-3 ms-auto">Modifica</a>
    </div>
    <div class="card">
      <div class="card-body clearfix">
        <img src="{{ $shoe->getImage() }}" class="float-end w-50 ms-2" alt="Shoe image">
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
