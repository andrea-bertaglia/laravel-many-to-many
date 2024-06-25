@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- mostro il messaggio di conferma cancellazione --}}
        @include('partials.message-success')

        <div class="d-flex justify-content-between align-items-center pb-3">
            <h1 class="py-4 fw-bold">Elenco progetti</h1>
            <div>
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Aggiungi nuovo</a>

            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Tipo</th>
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
                            <span class="badge rounded-pill"
                                style="background-color:{{ $project->type?->color }}">{{ $project->type?->name }}</span>
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
    </div>
    <!-- Modal -->
    @include('partials.delete-modal')
@endsection
