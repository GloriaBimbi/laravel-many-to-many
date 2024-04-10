@extends('layouts.app')

@section('title', empty($type->id) ? 'New Type' : 'Edit Type')

@section('content')
<section>
    <div class="container">
        <a href="{{ route('admin.types.index') }}" class="btn btn-primary my-5">Go back to Types' List</a>

        <h1>{{ empty($type->id) ? 'New Type' : 'Edit Type' }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger my-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ empty($type->id) ? route('admin.types.store') : route('admin.types.update', $type) }}" method="POST" class="mb-5 row g-3">
            @csrf
            @unless(empty($type->id))
                @method('PATCH')
            @endunless
            <div class="mb-3 col-6">
              <label for="label" class="form-label">Label</label>
              <input type="text" class="form-control @error('label') is-invalid @enderror" id="label"  name="label" value={{ old('label', $type->label) }}>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="color" class="form-label">Color</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" id="color"  name="color" value={{ old('color', $type->color) }}>
                @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            <div class="mb-3 col-4">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-1"></i>{{ empty($type->id) ? 'Save' : 'Edit' }}</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection