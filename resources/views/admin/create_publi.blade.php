@extends('adminlte::page')

@section('title', 'Create Publi')

@section('content_header')
    <h1>Create a New Publi</h1>
@stop

@section('content')

    <!-- Formulario para crear notas -->
    <form method="post" action="{{ route('admin.store_publi') }}" enctype="multipart/form-data">
        @csrf
        <!-- Agrega campos del formulario para la información de la nota -->
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="link">Link:</label>
        <input type="text" name="link" require>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*">

        <label for="is_field">Is Field:</label>
        <select name="is_field">
            <option value="none">None</option>
            <option value="1">Field 1</option>
            <option value="2">Field 2</option>
            <option value="3">Field 3</option>
            <option value="4">Field 4</option>
            <option value="5">Field 5</option>
            <option value="6">Field 6</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>
        
        <button type="reset">Reset Publi</button>
        <button type="submit">Save Publi</button>
    </form>


@stop
