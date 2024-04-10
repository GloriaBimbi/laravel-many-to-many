@extends('layouts.app')

@section('title', 'Show Type')

@section('content')
<section>
  <div class="container">
      <a class="btn btn-primary mt-5" href="{{ route('admin.types.index') }}">Go back to Types' List</a>

      
      <h1 class="mt-5">{{ $type->label }}</h1>
      <div class="mb-5"><b>Color:</b> {{ $type->color }}</div>
      <div class="mb-5"><b>Badge:</b> {!! $type->getBedge() !!}</div>

      <h3>Related Projects</h3>
      <table class="table primary-table">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th></th>
        </thead>
        <tbody>
          @foreach($related_projects as $project)
          <tr>
            <td> {{ $project->id }} </td>
            <td> {{ $project->title }} </td>
            <td>
              <a class="btn btn-primary py-0" href="{{ route('admin.project.show', $project)}}"><i class="fa-solid fa-eye fa-xs"></i></a>
              <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning py-0"><i class="fa-solid fa-pencil"></i></a>
              <a class="btn btn-danger py-0" data-bs-target="#delete-project-{{ $project->id }}-modal" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $related_projects->links('pagination::bootstrap-5') }}

      <div class="d-flex gap-5 my-5">
          <a class="btn btn-warning" href="{{ route('admin.types.edit', $type) }}"><i class="fa-solid fa-pencil"></i> Edit <i>"{{ $type->label }}"</i> Type </a>
          {{-- <a class="btn btn-danger" href="{{ route('admin.types.destroy', $type) }}" data-bs-target="#delete-type-{{ $type->id }}-modal" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete <i>"{{ $type->label }}"</i> Type </a> --}}
      </div>
  </div>
</section>
@endsection

{{-- modale per la show del type
@section('modal')
  <div class="modal fade" id="delete-type-{{ $type->id }}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Type</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          You are deleting. This operation is not reversible. Are you sure you want to proceed? 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection --}}

{{-- modale per i projects nella tabella nella show dei types --}}
@section('modal')
  @foreach($related_projects as $project)
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