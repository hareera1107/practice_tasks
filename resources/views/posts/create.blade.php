@extends('posts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add New Post</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-info" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                </div>
            </div>
            <div>
                <input type="file" class="mt-2 col-xs-12 col-sm-12 col-md-12" name="image" id="file">
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </div>

    </form>
@endsection
