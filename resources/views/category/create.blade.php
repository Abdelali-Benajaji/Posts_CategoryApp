@extends('app')

@section('content')
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" >
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection