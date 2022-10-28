@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-start">
                <h3>CRUD a Post</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success mb-2" href="{{ route('posts.index') }}"> Go to Posts</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Images</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td><img src="{{ asset($post->file) }}" alt=" " width="100px"></td>
                @if ($post->user_id == auth()->user()->id)
                    <td>

                        <a class="btn btn-primary btn-sm" href="{{ route('posts.restore', $post->id) }}">Restore</a>
                        <a class="btn btn-danger btn-sm" href="{{ route('posts.forceDelete', $post->id) }}">Delete</a>
                    @else
                    <td> </td>
                @endif
                </td>
            </tr>
        @endforeach
    </table>
   



    {{-- {!! $posts->links() !!} --}}
@endsection
