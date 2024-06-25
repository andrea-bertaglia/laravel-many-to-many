@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-3 fw-bold">Aggiungi una nuova tipologia</h1>

        <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div id="name-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="color" class="form-label fw-bold">Colore</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                            name="color" value="{{ old('color') }}">
                        @error('color')
                            <div id="color-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mt-5 pe-3">Salva</button>
                </div>


        </form>
    </div>
@endsection
