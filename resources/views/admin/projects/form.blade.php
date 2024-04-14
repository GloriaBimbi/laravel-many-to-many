@extends('layouts.app')

@section('title', empty($project->id) ? 'New Project' : 'Edit Project')

@section('content')
<section>
    <div class="container">
        <a href="{{ route('admin.project.index') }}" class="btn btn-primary my-5">Go back to Projects' List</a>

        <h1>{{ empty($project->id) ? 'New Project' : 'Edit Project' }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger my-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ empty($project->id) ? route('admin.project.store') : route('admin.project.update', $project) }}" method="POST" class="mb-5 row g-3" enctype="multipart/form-data">
            @csrf
            @unless(empty($project->id))
                @method('PATCH')
            @endunless
            <div class="mb-3 col-6">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"  name="title" value={{ old('title', $project->title) }}>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-6">
              <label for="type_id" class="form-label">Type</label>
              <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                <option value="" class="d-none">Select Type</option>
                @foreach($types as $type)
                  <option {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }} value="{{ $type->id }}">{{$type->label}}</option>
                @endforeach
              </select>
              @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-8">
              <label for="content" class="form-label">Content</label>
              <br>
              <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="13">{{ old('content', $project->content) }}</textarea>
              @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-4">
              <div class="@error('technologies') is-invalid @enderror">
                @foreach($technologies as $technology)
                  <input {{ in_array($technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }} type="checkbox" name="technologies[]" id="technologies-{{ $technology->id }}" class="form-check-input @error('technologies') is-invalid @enderror" value="{{ $technology->id }}">
                  <label for="technologies-{{ $technology->id }}" class="form-check-label @error('technologies') is-invalid @enderror">{{ $technology->label }}</label>
                  <br>
                @endforeach
              </div>
              @error('technologies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-12">
              <label for="image" class="form-label">Image Post</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="mb-3 col-4">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-1"></i>{{ empty($project->id) ? 'Save' : 'Edit' }}</button>
            </div>
        </form>
        
    </div>
</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection