@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center pb-3">
            <h1 class="py-4 fw-bold">Elenco tipologie</h1>
            <div>
                <a class="btn btn-success" href="{{ route('admin.types.create') }}">Aggiungi nuova tipologia</a>

            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Colore</th>
                    <th scope="col">Badge</th>
                    <th scope="col">Opzioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->color }}</td>
                        <td>
                            <span class="badge rounded-pill"
                                style="background-color:{{ $type->color }}">{{ $type->name }}</span>
                        <td class="d-flex align-items-center justify-content-center gap-4">
                            <div>
                                <a class="btn btn-warning text-white"
                                    href="{{ route('admin.types.edit', ['type' => $type->id]) }}">Modifica</a>
                            </div>
                            <div>
                                <a class="btn btn-danger text-white"
                                    href="{{ route('admin.types.destroy', ['type' => $type->id]) }}">Cancella</i></a>
                            </div>
                        <td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
