@extends('layouts.app')

@section('content')

<section class="container">

    <h1 class="my-3">Scarpe</h1>

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
                <th scope="row">{{$shoe->id}}</th>
                <td>{{$shoe->brand}}</td>
                <td>{{$shoe->model}}</td>
                <td>€ {{$shoe->price}}</td>
                <td>Dettaglio</td>
            </tr>
            @empty
            <h2>Non ci sono scarpe</h2>
            @endforelse
        </tbody>
    </table>

    {{$shoes->links()}}

</section>


@endsection