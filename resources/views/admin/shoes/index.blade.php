@extends('layouts.app')

@section('content')
  <section class="container">

    <h1 class="mb-5">{{ isset($shoes) ? 'Scarpe' : 'Cestino' }}</h1>
    @if (isset($shoes))
      <div class="button_index d-flex">
        <a href="{{ route('admin.shoes.create') }}" class="btn btn-primary">Crea</a>
        <a href="{{ url('admin/shoes/trash') }}" class="btn btn-danger ms-auto">Cestino</a>
      </div>
    @endif
    @if (Route::current()->getName() == 'admin.shoes.trash')
      <a href="{{ route('admin.shoes.index') }}" class="btn btn-primary my-3">Torna alla lista</a>
    @endif

    <table class="table my-3">
      <thead>
        <tr>
          <th scope="col">
            <a href="{{ Request::url() }}?sort=id&order={{ $sort == 'id' && $order != 'desc' ? 'desc' : 'asc' }}">
              ID
            </a>
            @if ($sort == 'id')
              <a href="{{ Request::url() }}?sort=id&order={{ $sort == 'id' && $order != 'desc' ? 'desc' : 'asc' }}">
                <i class="fa-solid fa-caret-down ms-2 d-inline-block @if ($order == 'desc') rotate-180 @endif">
                </i>
              </a>
            @endif
          </th>
          <th scope="col">Anteprima</th>
          <th scope="col">
            <a href="{{ Request::url() }}?sort=brand&order={{ $sort == 'brand' && $order != 'desc' ? 'desc' : 'asc' }}">
              Brand
              @if ($sort == 'brand')
                <a
                  href="{{ Request::url() }}?sort=brand&order={{ $sort == 'brand' && $order != 'desc' ? 'desc' : 'asc' }}">
                  <i
                    class="fa-solid fa-caret-down ms-2 d-inline-block @if ($order == 'desc') rotate-180 @endif">
                  </i>
                </a>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{ Request::url() }}?sort=model&order={{ $sort == 'model' && $order != 'desc' ? 'desc' : 'asc' }}">
              Modello
              @if ($sort == 'model')
                <a
                  href="{{ Request::url() }}?sort=model&order={{ $sort == 'model' && $order != 'desc' ? 'desc' : 'asc' }}">
                  <i
                    class="fa-solid fa-caret-down ms-2 d-inline-block @if ($order == 'desc') rotate-180 @endif">
                  </i>
                </a>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{ Request::url() }}?sort=price&order={{ $sort == 'price' && $order != 'desc' ? 'desc' : 'asc' }}">
              Prezzo
              @if ($sort == 'price')
                <a
                  href="{{ Request::url() }}?sort=price&order={{ $sort == 'price' && $order != 'desc' ? 'desc' : 'asc' }}">
                  <i
                    class="fa-solid fa-caret-down ms-2 d-inline-block @if ($order == 'desc') rotate-180 @endif">
                  </i>
                </a>
              @endif
            </a>
          </th>
          @if (isset($trashedshoes))
            <th scope="col">
              <a
                href="{{ Request::url() }}?sort=deleted_at&order={{ $sort == 'deleted_at' && $order != 'desc' ? 'desc' : 'asc' }}">
                Data Eliminazione
                @if ($sort == 'deleted_at')
                  <a
                    href="{{ Request::url() }}?sort=deleted_at&order={{ $sort == 'deleted_at' && $order != 'desc' ? 'desc' : 'asc' }}">
                    <i
                      class="fa-solid fa-caret-down ms-2 d-inline-block @if ($order == 'desc') rotate-180 @endif">
                    </i>
                  </a>
                @endif
              </a>
            </th>
          @endif
          <th scope="col" class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($shoes))
          @forelse($shoes as $shoe)
            <tr>
              <th scope="row">{{ $shoe->id }}</th>
              <td><img src="{{ $shoe->getImage() }}" class="table_image" alt=""></td>
              <td>{{ $shoe->brand }}</td>
              <td>{{ $shoe->model }}</td>
              <td>€ {{ $shoe->price }}</td>
              <td class="text-end">
                <a href="{{ route('admin.shoes.show', $shoe) }}" title="Mostra il prodotto"><i
                    class="fa-solid fa-eye"></i></a>
                <a href="{{ route('admin.shoes.edit', $shoe) }}" title="Modifica il prodotto"><i
                    class="fa-solid fa-pen-to-square ms-3"></i></a>
                <button class="fa-solid fa-trash btn-icon ms-3 text-danger" data-bs-toggle="modal"
                  title="Elimina il prodotto" data-bs-target="#delete-modal-{{ $shoe->id }}">
                </button>
              </td>
            </tr>
          @empty
            <h2>Non ci sono scarpe</h2>
          @endforelse
        @endif
        @if (isset($trashedshoes))
          @forelse($trashedshoes as $shoe)
            <tr>
              <th scope="row">{{ $shoe->id }}</th>
              <td><img src="{{ $shoe->getImage() }}" class="table_image" alt=""></td>
              <td>{{ $shoe->brand }}</td>
              <td>{{ $shoe->model }}</td>
              <td>€ {{ $shoe->price }}</td>
              <td>{{ $shoe->deleted_at }}</td>
              <td class="text-end">
                <button class="fa-solid fa-trash btn-icon ms-3 text-danger" data-bs-toggle="modal"
                  data-bs-target="#delete-modal-{{ $shoe->id }}" title="Elimina il prodotto">
                </button>
                <button class="fa-solid fa-recycle btn-icon ms-3 text-success" data-bs-toggle="modal"
                  data-bs-target="#restore-modal-{{ $shoe->id }}" title="Ripristina il prodotto">
                </button>
              </td>
            </tr>
          @empty
            <h2>Cestino vuoto.</h2>
          @endforelse
        @endif
      </tbody>
    </table>

    @if (isset($shoes))
      {{ $shoes->links() }}
    @endif
  </section>
@endsection

@section('modals')

  @if (isset($trashedshoes))
    @foreach ($trashedshoes as $shoe)
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
              Sei sicuro di voler eliminare il prodotto <strong>{{ $shoe->model }}</strong> con ID
              <strong> {{ $shoe->id }}</strong>? <br>
              L'operazione non è reversibile!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

              <form action="{{ route('admin.shoes.forcedelete', $shoe->id) }}" method="POST" class="">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="restore-modal-{{ $shoe->id }}" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="restore-modal-{{ $shoe->id }}-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-{{ $shoe->id }}-label">Conferma Ripristino</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
              Sei sicuro di voler ripristinare il prodotto <strong>{{ $shoe->model }}</strong> con ID
              <strong> {{ $shoe->id }}</strong>?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

              <form action="{{ route('admin.shoes.restore', $shoe->id) }}" method="POST" class="">
                @method('put')
                @csrf

                <button type="submit" class="btn btn-success">Ripristina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
  @if (isset($shoes))
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
              Sei sicuro di voler spostare nel cestino il prodotto <strong>{{ $shoe->model }}</strong> con ID
              <strong> {{ $shoe->id }}</strong>?
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
  @endif
@endsection
