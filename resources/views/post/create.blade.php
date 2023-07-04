@extends('app')

@section('content')
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" >
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <select class="form-select" aria-label="Default select example" name="category_id">
                @foreach($categories as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                @endforeach
                    
            </select>
            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <input type="text" class="form-control" name="body">
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection