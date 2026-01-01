@extends('admin.base')

@section('content')
<div class="container mt-4">
    <h3>Edit Portfolio</h3>

    <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="titulo" value="{{ $portfolio->titulo }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="categoria" value="{{ $portfolio->categoria }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ $portfolio->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="imagen" class="form-control">
            <div class="mt-2">
                <img src="{{ asset('storage/'.$portfolio->imagen) }}" width="120">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">💾 Update</button>
        <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
