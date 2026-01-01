@extends('admin.base')

@section('content')
<div class="container mt-4">
    <h3>Add Portfolio</h3>

    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="categoria" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="descripcion" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="imagen" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Save</button>
        <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
