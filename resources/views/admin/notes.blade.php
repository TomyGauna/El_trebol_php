@extends('adminlte::page')

@section('title', 'Admin Dashboard - Notes')

@section('content_header')
    <h1>Notes Management</h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->id }}</td>
                    <td>{{ $note->title }}</td>
                    <td>
                        <a href="{{ route('admin.edit_note_form', ['nota_id' => $note->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.delete_note', ['nota_id' => $note->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <!-- Agrega más acciones según sea necesario -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop