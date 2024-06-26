@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-3 fw-bold">Aggiungi un nuovo progetto</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <div id="title-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div id="description-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label fw-bold">Tipo</label>
                        <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                            <option value="">Seleziona un'opzione</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div id="type_id-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <h6 class="fw-bold">Tecnologie</h6>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Tecnologie">
                        @foreach ($technologies as $technology)
                            <div class="btn-group btn-group-sm" role="group" aria-label="Tecnologie">
                                <input @checked(in_array($technology->id, old('technologies', []))) type="checkbox" class="btn-check" name="technologies[]"
                                    id="technology-{{ $technology->id }}" value="{{ $technology->id }}" autocomplete="off">
                                <label class="btn btn-outline-secondary me-2 badge rounded-pill text-dark"
                                    for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('technologies')
                        <div id="technologies-error" class="invalid-feedback d-block pt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    {{-- <div class="mb-3">
                        <label for="link" class="form-label fw-bold">Link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                            name="link" value="{{ old('link') }}">
                    </div> --}}

                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug') }}" disabled>
                        <div id="slugHelp" class="form-text">Lo slug non può essere modificato, si aggiorna in base al
                            titolo inserito.</div>
                    </div>
                    <div class="mb-3">
                        <label for="thumb" class="form-label fw-bold">Immagine</label>
                        <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb"
                            name="thumb" value="{{ old('thumb') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-5 pe-3">Salva</button>
        </form>
    </div>
@endsection
