@extends('adminlte::page')

@section('title', 'Update Note')

@section('content_header')
    <h1 class="d-flex justify-content-center">Update Note</h1>
@stop

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 mb-4">
            <!-- Formulario para actualizar notas -->
            <form method="post" action="{{ route('admin.update_note', ['nota_id' => $note->id]) }}" enctype="multipart/form-data">
                @csrf
                <!-- Agrega campos del formulario para la información de la nota -->
                <div class="form-group d-flex justify-content-between ">
                    <div class="w-50 mr-2">    
                        <label for="title">Titulo verde:</label>
                        <input type="text" class="form-control" name="title" value="{{ $note->title }}" required>
                    </div>
                    <div class="w-50 ml-2">
                        <label for="content">Titulo blanco:</label>
                        <input type="text" class="form-control" name="content" id="pepito" value="{{ $note->content }}"></input>
                    </div>
                </div>
                
                <div class="form-group d-flex flex-column align-items-center">
                    <label class="w-100" for="image">Image 1:</label>
                        <img class="w-75 mb-2" src="{{ asset('storage/' . $note['image']) }}" alt="">
                    <input type="file" name="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="content_2">Content 2:</label>
                    <textarea class="form-control" name="content_2" id="pepito">{{ $note->content_2 }}</textarea>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <label class="w-100" for="image_2">Image 2:</label>
                        <img class="w-75 mb-2" src="{{ asset('storage/' . $note['image_2']) }}" alt="">
                    <input type="file" name="image_2" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="content_3">Content 3:</label>
                    <textarea class="form-control" name="content_3" id="pepito">{{ $note->content_3 }}</textarea>
                </div>

                <div class="form-group d-flex flex-column align-items-center">
                    <label class="w-100" for="image_3">Image 3:</label>
                        <img class="w-75 mb-2" src="{{ asset('storage/' . $note['image_3']) }}" alt="">
                    <input type="file" name="image_3" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="content_4">Content 4:</label>
                    <textarea class="form-control" name="content_4" id="pepito">{{ $note->content_4 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="is_field">Is Field:</label>
                    <select class="form-control" name="is_field">
                        <option value="none" @if ($note->is_field == 'none') selected @endif>None</option>
                        <option value="1" @if ($note->is_field == '1') selected @endif>Field 1</option>
                        <option value="2" @if ($note->is_field == '2') selected @endif>Field 2</option>
                        <option value="3" @if ($note->is_field == '3') selected @endif>Field 3</option>
                        <option value="4" @if ($note->is_field == '4') selected @endif>Field 4</option>
                        <option value="5" @if ($note->is_field == '5') selected @endif>Field 5</option>
                        <option value="6" @if ($note->is_field == '6') selected @endif>Field 6</option>
                        <option value="7" @if ($note->is_field == '7') selected @endif>Field 7</option>
                        <option value="8" @if ($note->is_field == '8') selected @endif>Field 8</option>
                        <option value="9" @if ($note->is_field == '9') selected @endif>Field 9</option>
                        <option value="10" @if ($note->is_field == '10') selected @endif>Field 10</option>
                        <option value="11" @if ($note->is_field == '11') selected @endif>Field 11</option>
                        <option value="12" @if ($note->is_field == '12') selected @endif>Field 12</option>
                        <option value="13" @if ($note->is_field == '13') selected @endif>Field 13</option>
                        <option value="14" @if ($note->is_field == '14') selected @endif>Field 14</option>
                        <option value="15" @if ($note->is_field == '15') selected @endif>Field 15</option>
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

                <label for="priority_segment">Priority Segment:</label>
                <select class="form-control" name="priority_segment">
                    @foreach(\App\Models\News::SEGMENT_PRIORITY as $value)
                        <option value="{{ $value }}" {{ old('priority_segment', $note->priority_segment ?? 'none') == $value ? 'selected' : '' }}>
                            {{ ucfirst($value) }}
                        </option>
                    @endforeach
                </select>


                <div class="form-group">
                    <label for="dia_creacion">Fecha:</label>
                    <input class="form-control" name="dia_creacion" id="pepito" value="{{ $note->dia_creacion }}"></input>
                </div>

                <button type="submit" class="btn btn-primary">Update Note</button>
            </form>
        </div>
    </div>
    <!-- <script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#pepito'))
            .then(editor => {
                console.log('CKEditor Loaded');
            })
            .catch(error => {
                console.error(error);
            });
    </script> -->

@stop
