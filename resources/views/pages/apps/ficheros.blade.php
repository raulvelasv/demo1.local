@extends('layout.master')

@section('content')
    <form method ="POST" action="{{route("upload.post")}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="formFile">File upload</label>
            <input class="form-control" type="file" id="file" name="file">
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
@endsection
