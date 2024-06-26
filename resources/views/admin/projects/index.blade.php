@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- mostro il messaggio di conferma cancellazione --}}
        @include('partials.message-success')

        <div class="d-flex justify-content-between align-items-center pb-3">
            <h1 class="py-4 fw-bold">Elenco progetti</h1>
            {{-- <div>
                <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Aggiungi nuovo</a>
            </div> --}}
            {{-- filtro paginazione --}}
            <div>
                <form class="d-flex" action="{{ route('admin.projects.index') }}" method="GET">
                    @csrf
                    <label class="me-2" for="per_page"><small class=" text-secondary">Elementi per
                            pagina</small></label>
                    <div class="col-xs-2 me-2">
                        <select class="form-select form-select-sm" aria-label="Seleziona il numero di elementi per pagina"
                            name="per_page" id="per_page">
                            <option selected value="5" @selected($projects->perPage() == 5)>5</option>
                            <option value="10" @selected($projects->perPage() == 10)>10</option>
                            <option value="15" @selected($projects->perPage() == 15)>15</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Applica</button>
                </form>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Opzioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td class="fw-bold">{{ $project->title }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>
                            <span class="badge rounded-pill border"
                                style="color:{{ $project->type?->color }}">{{ $project->type?->name }}</span>
                        </td>
                        <td>
                            @forelse ($project->technologies as $technology)
                                <span class="badge rounded-pill"
                                    style="background-color:{{ $technology->color }}">{{ $technology->name }}</span>
                            @empty
                                <small class="fst-italic fw-lighter">n/a</small>
                            @endforelse
                        </td>
                        <td class="d-flex align-items-center justify-content-center gap-4 py-3">
                            <div>
                                <a class="btn btn-success"
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}"><i
                                        class="fa-solid fa-eye"></i></a>
                            </div>
                            <div>
                                <a class="btn btn-warning text-white"
                                    href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}"><i
                                        class="fa-solid fa-pencil"></i></a>
                            </div>
                            <div class="trash-btn" data-project-title="{{ $project->title }}"
                                data-project-slug="{{ $project->slug }}" data-bs-toggle="modal"
                                data-bs-target="#delete-modal">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pt-2">{{ $projects->links() }}</div>

    </div>
    <!-- Modal -->
    @include('partials.delete-modal')
@endsection
