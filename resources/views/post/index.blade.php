@extends('app')

@section('content')


<div>

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="text-center">{{$message}}</p>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger">
            <p class="text-center">{{$message}}</p>
        </div>
    @endif
    <a href="/category" style="float:left" class="btn btn-warning mb-2">Categories</a>
    <a href="/post/create" style="float:right" class="btn btn-primary mb-2">Create New Post</a>
    
    <table class="table table-striped">
        <thead class="table-dark">
            <th class="text-center">#id</th>
            <th class="text-center">Image</th>
            <th class="text-center">Title</th>
            <th class="text-center">Category</th>
            <th class="text-center">Body</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
            @foreach( $posts as $post)
                <tr>
                    <td class="text-center">{{$post->id}}</td>
                    <td class="text-center"><img src="/images/posts/{{$post->image}}" alt="image" width="80px"></td>
                    <td class="text-center">{{$post->title}}</td>
                    <td class="text-center">{{$post->category->name}}</td>
                    <td class="text-center">{{$post->body}}</td>
                    <td >
                        <div class="d-flex justify-content-evenly">
                        <a href="/post/{{$post->id}}/edit" class="btn btn-success">edit</a>

                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection