@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">{{ $shoe->id ? 'Modifica - ' . $shoe->model : 'Aggiungi una scarpa' }}
        </h2>
        <div class="card">
            <div class="card-body">
                @if ($shoe->id)
                    <form action="{{ route('admin.shoes.update', $shoe) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    @else
                        <form method="POST" action="{{ route('admin.shoes.store') }}" enctype="multipart/form-data">
                            @csrf
                @endif
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="@error('brand') is-invalid @enderror form-control" id="brand"
                        name="brand" value="{{ old('brand', $shoe->brand) }}">
                    @error('brand')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Modello</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model"
                        name="model" value="{{ old('model', $shoe->model) }}">
                    @error('model')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label">Materiale</label>
                    <input type="text" class="form-control @error('material') is-invalid @enderror" id="material"
                        name="material" value="{{ old('material', $shoe->material) }}">
                    @error('material')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    @if($shoe->image) <img src="{{$shoe->getImage()}}" alt="" class="d-block" id="image-preview" width="300px"> @endif
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" value="{{ old('image', $shoe->image) }}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Colore</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                        name="color" value="{{ old('color', $shoe->color) }}">
                    @error('color')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                        id="price" name="price" value="{{ old('price', $shoe->price) }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description">{{ old('description', $shoe->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="is_available" class="form-label">Disponibile</label>
                    <input type="checkbox" class="form-check-control @error('is_available') is-invalid @enderror"
                        id="is_available" name="is_available" value="1" @checked(old('is_available', $shoe->is_available))>
                    @error('is_available')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit"
                        class="btn btn-primary">{{ $shoe->id ? 'Modifica' . $shoe->title : 'Salva' }}</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        const imageEl = document.getElementById('image');
        const imagePreviewEl = document.getElementById('image-preview');
        const imagePlaceholder = imagePreviewEl.src;
        imageEl.addEventListener(
            'change', () => {
                if (imageEl.files && imageEl.files[0]) {
                    const reader = new FileReader();
                    reader.readAsDataURL(imageEl.files[0]);
                    reader.onload = e => {
                        imagePreviewEl.src = e.target.result;
                    }
                } else {
                    imagePreviewEl.src = imagePlaceholder;
                }
            });
    </script>
@endsection
