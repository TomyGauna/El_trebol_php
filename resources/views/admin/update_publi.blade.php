@extends('adminlte::page')

@section('title', 'Update Publi')

@section('content_header')
    <h1 class="d-flex justify-content-center">Update Publi</h1>
@stop

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <!-- Formulario para actualizar notas -->
            <form method="post" action="{{ route('admin.update_publi', ['publi_id' => $publi->id]) }}" enctype="multipart/form-data">
                @csrf
                <!-- Agrega campos del formulario para la información de la nota -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $publi->title }}" required>
                </div>

                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" name="link" value="{{ $publi->title }}" require>
                </div>

                <div class="form-group">
                    <label for="image">Image 1:</label>
                    <img src="{{ asset('storage/' . $publi['image']) }}" alt="">
                    <input type="file" name="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="is_field">Is Field:</label>
                    <select class="form-control" name="is_field">
                        <option value="none" @if ($publi->is_field == 'none') selected @endif>None</option>
                        <option value="1" @if ($publi->is_field == '1') selected @endif>Field 1</option>
                        <option value="2" @if ($publi->is_field == '2') selected @endif>Field 2</option>
                        <option value="3" @if ($publi->is_field == '3') selected @endif>Field 3</option>
                        <option value="4" @if ($publi->is_field == '4') selected @endif>Field 4</option>
                        <option value="5" @if ($publi->is_field == '5') selected @endif>Field 5</option>
                        <option value="6" @if ($publi->is_field == '6') selected @endif>Field 6</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Note</button>
            </form>
        </div>
    </div>

@stop
