@extends('layouts.app')

@section('content')
    <section class="container">

        <h1 class="my-3">Scarpe</h1>
        <a href="{{ route('admin.shoes.create') }}" class="btn btn-primary">Crea</a>

        <table class="table my-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Modello</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shoes as $shoe)
                    <tr>
                        <th scope="row">{{ $shoe->id }}</th>
                        <td>{{ $shoe->brand }}</td>
                        <td>{{ $shoe->model }}</td>
                        <td>€ {{ $shoe->price }}</td>
                        <td>
                            <a href="{{ route('admin.shoes.show', $shoe) }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.shoes.edit', $shoe) }}"><i
                                    class="fa-solid fa-pen-to-square ms-3"></i></a>
                            <button class="fa-solid fa-trash btn-icon ms-3 text-danger" data-bs-toggle="modal"
                                data-bs-target="#delete-modal-{{ $shoe->id }}">
                                {{-- <i class="fa-solid fa-trash"></i> --}}
                            </button>
                        </td>
                    </tr>
                @empty
                    <h2>Non ci sono scarpe</h2>
                @endforelse
            </tbody>
        </table>

        {{ $shoes->links() }}

    </section>
@endsection

@section('modals')
    @foreach ($shoes as $shoe)
        <!-- Modal -->
        <div class="modal fade" id="delete-modal-{{ $shoe->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="delete-modal-{{ $shoe->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-modal-{{ $shoe->id }}-label">Conferma eliminazione</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Sei sicuro di voler eliminare la canzone <strong>{{ $shoe->title }}</strong> con ID
                        <strong> {{ $shoe->id }}</strong>? <br>
                        L'operazione non è reversibile!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                        <form action="{{ route('admin.shoes.destroy', $shoe) }}" method="POST" class="">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
