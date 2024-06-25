@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="py-3">{{ $project->title }}</h1>

        <div class="row">
            <div class="col-4">
                <div>
                    <img class="w-100" src="{{ asset('storage/' . $project->thumb) }}" alt="">

                </div>
            </div>
            <div class="col-8">
                <p>{{ $project->description }}</p>
                {{-- <dd>Link</dd> --}}
                {{-- <dt class="pb-4">{{ $project->link }}</dt> --}}
                <dd>Slug</dd>
                <dt>{{ $project->slug }}</dt>
                <div class="pt-3">
                    <span class="pe-2">Tipo</span>
                    <span class="badge rounded-pill border"
                        style="color:{{ $project->type?->color }}">{{ $project->type?->name }}</span>
                </div>
                <div class="pt-3">
                    <span class="pe-2">Tecnologie</span>
                    @forelse ($project->technologies as $technology)
                        <span class="badge rounded-pill"
                            style="background-color:{{ $technology->color }}">{{ $technology->name }}</span>
                    @empty
                        <small class="fst-italic fw-lighter">Nessun risultato trovato</small>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
@endsection
