@extends('layout.master')


@section('content')


    <form method ="POST" action="{{ route('upload.post') }}" enctype="multipart/form-data">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="mb-3">
            <label for="label" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="label" autocomplete="off" placeholder="Titulo" name="label"
                value="{{ old('label') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="file">Subir Archivo</label>
            <input class="form-control" type="file" id="file" name="file">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" rows="5" name="description"> {{ old('description') }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Subir archivo</button>


    </form>
@endsection









@extends('layout.master')


@section('content')


    <form method ="POST" action="{{ route('uploadOneDrive.post') }}" enctype="multipart/form-data">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf


        <div class="mb-3">
            <label class="form-label" for="file">Subir Archivo</label>
            <input class="form-control" type="file" id="file" name="file">
        </div>


        <button class="btn btn-primary" type="submit">Subir archivo</button>


    </form>
@endsection
