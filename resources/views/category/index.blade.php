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
    <a href="/post" style="float:left" class="btn btn-info mb-2">Posts</a>
    <a href="/category/create" style="float:right" class="btn btn-primary mb-2">Create New Category</a>
    
    <table class="table table-striped">
        <thead class="table-dark">
            <th class="text-center">#id</th>
            <th class="text-center">Image</th>
            <th class="text-center">Name</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
            @foreach( $categories as $categ)
                <tr>
                    <td class="text-center">{{$categ->id}}</td>
                    <td class="text-center"><img src="/images/categories/{{$categ->image}}" alt="image" width="80px"></td>
                    <td class="text-center">{{$categ->name}}</td>
                    <td >
                        <div class="d-flex justify-content-evenly">
                        <a href="/category/{{$categ->id}}/edit" class="btn btn-success">edit</a>

                        <form action="{{ route('category.destroy',$categ->id) }}" method="POST">
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