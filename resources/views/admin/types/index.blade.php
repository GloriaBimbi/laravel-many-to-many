@extends('layouts.app')

@section('title', 'Types')

@section('content')
<section>
    <div class="container my-5">

        <a href="{{ route('admin.types.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i> Add New Type</a>

        <h1 class="my-4">Types' List</h1>
        <table class="table table-primary table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Color</th>
                    <th>Badge</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->label}}</td>
                    <td>{{$type->color}}</td>
                    <td>{!! $type->getBedge() !!}</td>
                    <td>
                        <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary my-1 px-5"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning my-1 px-5"><i class="fa-solid fa-pencil"></i></a>
                        <a class="btn btn-danger my-1 px-5" data-bs-target="#delete-type-{{ $type->id }}-modal" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i></a>                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="100%">No Types Found...</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $types->links('pagination::bootstrap-5') }}
    </div>
</section>
@endsection

@section('modal')
    @foreach($types as $type)
    <div class="modal fade" id="delete-type-{{ $type->id }}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <form action="{{ route('admin.types.destroy', $type) }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Type</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              You are deleting {!! $type->getBedge() !!} type. This operation is not reversible.
              <br></br>
              <strong><strong class="text-danger">Attention: </strong>this procedure will delete every single related Projects.</strong>
              <br></br>
              <div>Choose another Type for the Project related to the Type you want to delete:</div>
              <select class="form-select mt-2" name="delete-action" id="delete-action">
                <option value="delete">Delete Projects</option>

                @foreach($types as $type_option)
                  @if($type_option->id != $type->id)
                    <option value="{{ $type_option->id}}">Associa a: "{{ $type_option->label }}"</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    @endforeach
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

