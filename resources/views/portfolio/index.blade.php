@extends('admin.base')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Portfolios</h3>
        <a href="{{ route('portfolios.create') }}" class="btn btn-primary">+ Add Portfolio</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->titulo }}</td>
                    <td>{{ $p->categoria }}</td>
                    <td><img src="{{ asset('storage/'.$p->imagen) }}" width="80"></td>
                    <td>
                        <a href="{{ route('portfolios.edit', $p->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('portfolios.destroy', $p->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this portfolio?')">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $portfolios->links() }}
</div>
@endsection
