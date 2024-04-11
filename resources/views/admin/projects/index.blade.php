@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<section>
    <div class="container my-5">

        <a href="{{ route('admin.project.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i> Add New Project</a>

        <h1 class="my-4">Projects' List</h1>
        <table class="table table-primary table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Technology</th>
                    <th>Abstract</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>{{$project->title}}</td>
                    <td>{!! $project->type->getBedge() !!}</td>
                    <td>{{ $project->getTechnologiesToText() }}</td>
                    <td>{{$project->getAbstract(100)}}</td>
                    <td>
                        <a href="{{ route('admin.project.show', $project) }}" class="btn btn-primary my-1 px-5"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning my-1 px-5"><i class="fa-solid fa-pencil"></i></a>
                        <a class="btn btn-danger my-1 px-5" data-bs-target="#delete-project-{{ $project->id }}-modal" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i></a>                    </td>
                </tr>
                @empty
                <tr>
                  <td colspan="100%">No Projects Found...</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
</section>
@endsection

@section('modal')
    @foreach($projects as $project)
    <div class="modal fade" id="delete-project-{{ $project->id }}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Project</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              You are deleting "{{ $project->title }}" project. This operation is not reversible. Are you sure you want to proceed? 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form action="{{ route('admin.project.destroy', $project) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

