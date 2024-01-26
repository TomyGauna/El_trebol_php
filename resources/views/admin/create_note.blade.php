@extends('adminlte::page')

@section('title', 'Create Note')

@section('content_header')
    <h1>Create a New Note</h1>
@stop

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 mb-4">
            <!-- Formulario para crear notas -->
            <form method="post" action="{{ route('admin.store_note') }}" enctype="multipart/form-data">
                @csrf
                <!-- Agrega campos del formulario para la información de la nota -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content"></textarea>
                </div>

                <div class="form-group">
                    <label for="content_2">Content 2:</label>
                    <textarea class="form-control" name="content_2"></textarea>
                </div>

                <div class="form-group">
                    <label for="content_3">Content 3:</label>
                    <textarea class="form-control" name="content_3"></textarea>
                </div>

                <div class="form-group">
                    <label for="content_4">Content 4:</label>
                    <textarea class="form-control" name="content_4"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="image_2">Image 2:</label>
                    <input type="file" class="form-control-file" name="image_2" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="image_3">Image 3:</label>
                    <input type="file" class="form-control-file" name="image_3" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="is_field">Is Field:</label>
                    <select class="form-control" name="is_field">
                        <option value="none">None</option>
                        <option value="1">Field 1</option>
                        <option value="2">Field 2</option>
                        <option value="3">Field 3</option>
                        <option value="4">Field 4</option>
                        <option value="5">Field 5</option>
                        <option value="6">Field 6</option>
                        <option value="7">Field 7</option>
                        <option value="8">Field 8</option>
                        <option value="9">Field 9</option>
                        <option value="10">Field 10</option>
                        <option value="11">Field 11</option>
                        <option value="12">Field 12</option>
                        <option value="13">Field 13</option>
                        <option value="14">Field 14</option>
                        <option value="15">Field 15</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>

                <label for="segment">Segment:</label>
                <select class="form-control" name="segment">
                    @foreach(\App\Models\News::SEGMENT_VALUES as $value)
                        <option value="{{ $value }}" {{ old('segment', $note->segment ?? 'none') == $value ? 'selected' : '' }}>
                            {{ ucfirst($value) }}
                        </option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="priority_segment">Priority Segment:</label>
                    <select class="form-control" name="priority_segment">
                        @foreach(\App\Models\News::SEGMENT_PRIORITY as $value)
                            <option value="{{ $value }}" {{ old('priority_segment', $note->priority_segment ?? 'none') == $value ? 'selected' : '' }}>
                                {{ ucfirst($value) }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="dia_creacion">Fecha:</label>
                    <input type="text" class="form-control" name="dia_creacion"></input> 
                </div>

                <button type="reset" class="btn btn-primary">Reset Note</button>
                <button type="submit" class="btn btn-primary">Save Note</button>
            </form>
        </div>
    </div>


    <!-- Asegúrate de incluir el script de tu aplicación después de cargar CKEditor -->
    <!-- <script src="{{ asset('CKeditor/ckeditor5-build-classic/ckeditor.js') }}"></script> -->

@stop
