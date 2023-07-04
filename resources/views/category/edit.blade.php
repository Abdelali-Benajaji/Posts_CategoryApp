@extends('app')

@section('content')

    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" value="{{$category->image}}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" value="{{$category->name}}">
            </div>
            
            <button type="submit" class="btn btn-success">Upadte</button>
    </form>
@endsection