@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="my-4">{{ $shoe->id ? 'Modifica - ' . $shoe->title : 'Aggiungi una scarpa' }}
    </h2>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('admin.shoes.store') }}" method="post">
          @csrf

          <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand">
          </div>
          <div class="mb-3">
            <label for="model" class="form-label">Modello</label>
            <input type="text" class="form-control" id="model" name="model">
          </div>
          <div class="mb-3">
            <label for="material" class="form-label">Materiale</label>
            <input type="text" class="form-control" id="material" name="material">
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="text" class="form-control" id="image" name="image">
          </div>
          <div class="mb-3">
            <label for="color" class="form-label">Colore</label>
            <input type="text" class="form-control" id="color" name="color">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="text" class="form-control" id="price" name="price">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea type="text" class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="is_available" class="form-label">Disponibile</label>
            <input type="checkbox" class="form-check-control" id="is_available" name="is_available" value="1">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Aggiungi</button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
