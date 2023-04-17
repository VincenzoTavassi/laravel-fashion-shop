@extends('layouts.app')
@section('content')
  <div class="container">
    <h1 class="mb-5">Shop</h1>
    <div class="row row-cols-4 g-5">
      @foreach ($shoes as $shoe)
        <div class="col">
          <div class="card p-3">
            <img src="{{ $shoe->getImage() }}" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $shoe->brand }}</h5>
              <p class="card-text">{{ $shoe->model }}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Materiale: {{ $shoe->material }}</li>
              <li class="list-group-item">Colore: {{ $shoe->color }}</li>
              <li class="list-group-item">Prezzo: €{{ $shoe->price }}</li>
            </ul>
            <div class="card-body">
              <a href="{{ route('guest.detail') }}?id={{ $shoe->id }}" class="btn btn-primary w-100">Dettaglio</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endsection
