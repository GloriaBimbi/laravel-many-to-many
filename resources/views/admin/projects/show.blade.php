@extends('layouts.app')

@section('title', 'Show Project')

@section('content')
<section>
    <div class="container">
        <a class="btn btn-primary mt-5" href="{{ route('admin.project.index') }}">Go back to Projects' List</a>

        <h1 class="mt-5">{{ $project->title }}</h1>
        <div class="mb-5"><b>Slug:</b> {{ $project->slug }}</div>
        <div class="row">
          <div class="col-6">
            <div class="mb-5"><b>Type:</b> {!! $project->type->getBedge() !!}</div>
            <div class="mb-5"><b>Technology:</b> {{ $project->getTechnologiesToText() }}</div>
            <p>{{ $project->content }}</p>
          </div>
          <div class="col-6">
            {{-- visualizzo l'immagine solo nel caso in cui ci sia --}}
            @if(!empty($project->image))
              <img src=" {{ asset('storage/' . $project->image) }} " alt="posted image" style="width: 400px">
            @endif
          </div>
        </div>
        
        





        <div class="d-flex gap-5 my-5">
            <a class="btn btn-warning" href="{{ route('admin.project.edit', $project) }}"><i class="fa-solid fa-pencil"></i> Edit <i>"{{ $project->title }}"</i> Project </a>
            <a class="btn btn-danger" href="{{ route('admin.project.destroy', $project) }}" data-bs-target="#delete-project-{{ $project->id }}-modal" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete <i>"{{ $project->title }}"</i> Project </a>
        </div>
    </div>
</section>
@endsection

@section('modal')
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
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection