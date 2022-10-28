@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-start">
                <h3>CRUD a Post</h2>
            </div>
            @role('super-admin|writer')
                <div class="float-end">
                    <a class="btn btn-success mb-2" href="{{ route('posts.create') }}"> Create New post</a>
                </div>
                @endrole
                @role('super-admin')
                <div class="float-end">
                    <a class="btn btn-success mb-2" href="{{ route('trash') }}"> Go to Trash</a>
                </div>
            @endrole
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
            @role('super-admin|writer')
                <th width="250px">Action</th>
            @endrole
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td><img src="{{ asset($post->file) }}" alt=" " width="100px"></td>

                @role('super-admin|writer')
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        @endrole

                        @csrf
                        @method('DELETE')
                        @role('super-admin')
                            <button type="submit" class="btn btn-danger btn-sm">Move to Trash</button>
                        @endrole
                    </form>
                </td>
            </tr>
        @endforeach
    </table>



    {{ $posts->links() }}
@endsection
