<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\News;
use App\Models\Publi;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function showAllNotes()
    {
        $notes = News::all();
        return view('admin.notes', compact('notes'));
    }

    public function createNoteForm()
    {
        return view('admin.create_note');
    }

    public function storeNote(Request $request)
    {
         // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'content_2' => 'string',
            'content_3' => 'string',
            'content_4' => 'string',
            'is_field' => News::isFieldValidationRules()['is_field'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
            'segment' => News::segmentValidationRules()['segment'],
            'priority_segment' => News::segmentValidationRules()['priority_segment'],
            'dia_creacion' => 'string',
            // Agrega más reglas de validación según tus necesidades
        ]);

        // Crear una nueva instancia del modelo New y asignar los valores
        $newNote = new News(); // Cambia 'New' por el nombre correcto de tu modelo
        $newNote->title = $request->input('title');
        $newNote->content = $request->input('content');
        $newNote->content_2 = $request->input('content_2');
        $newNote->content_3 = $request->input('content_3');
        $newNote->content_4 = $request->input('content_4');
        $newNote->content_4 = $request->input('content_4');        
        $newNote->dia_creacion = $request->input('dia_creacion');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            // Guarda la ruta de la imagen en la base de datos
            $newNote->image = $imagePath;
        }
        if ($request->hasFile('image_2')) {
            $imagePath2 = $request->file('image_2')->store('news_images', 'public');
            $newNote->image_2 = $imagePath2;
        }

        if ($request->hasFile('image_3')) {
            $imagePath3 = $request->file('image_3')->store('news_images', 'public');
            $newNote->image_3 = $imagePath3;
        }

        $newNote->segment = $request->input('segment');
        $newNote->priority_segment = $request->input('priority_segment');
        // Asigna otros campos según sea necesario

        // Guardar la nueva nota en la base de datos
        $newNote->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Note created successfully');

    }

    public function editNoteForm($nota_id)
    {
        $note = News::find($nota_id);
        return view('admin.update_note', compact('note'));
    }

    public function updateNoteForm($nota_id)
    {
        // Obtener la nota existente
        $note = News::find($nota_id);

        // Mostrar la vista del formulario de actualización
        return view('admin.update_note', compact('note'));
    }

    public function updateNote(Request $request, $nota_id)
    {

        // Obtener la nota existente
        $newNote = News::find($nota_id);

        // Actualizar los campos con los nuevos valores
        $newNote->title = $request->input('title');
        $newNote->content = $request->input('content');
        $newNote->content_2 = $request->input('content_2');
        $newNote->content_3 = $request->input('content_3');
        $newNote->content_4 = $request->input('content_4');
        $newNote->dia_creacion = $request->input('dia_creacion');
        $newNote->is_field = $request->input('is_field');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            // Guarda la ruta de la imagen en la base de datos
            $newNote->image = $imagePath;
        }
        if ($request->hasFile('image_2')) {
            $imagePath2 = $request->file('image_2')->store('news_images', 'public');
            $newNote->image_2 = $imagePath2;
        }

        if ($request->hasFile('image_3')) {
            $imagePath3 = $request->file('image_3')->store('news_images', 'public');
            $newNote->image_3 = $imagePath3;
        }

        $newNote->segment = $request->input('segment');
        $newNote->priority_segment = $request->input('priority_segment');
        // Actualiza otros campos según sea necesario

        // Guardar la nota actualizada en la base de datos
        $newNote->save();

        return redirect()->route('admin.dashboard')->with('success', 'Note updated successfully');
    }

    public function deleteNote($nota_id)
    {
        $note = News::find($nota_id);
        $note->delete();

        return redirect()->route('admin.show_notes')->with('success', 'Note deleted successfully');
    }

    public function showAllPublis()
    {
        $publis = Publi::all();
        return view('admin.publi', compact('publis'));
    }

    public function createPubliForm()
    {
        return view('admin.create_publi');
    }

    public function storePubli(Request $request)
    {
         // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:200',
            'link' => 'required|string|max:20000',
            'is_field' => Publi::isFieldValidationRules()['is_field'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        // Crear una nueva instancia del modelo New y asignar los valores
        $newPubli = new Publi(); 
        $newPubli->title = $request->input('title');
        $newPubli->link = $request->input('link');
        $newPubli->is_field = $request->input('is_field');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('publi_images', 'public');
            // Guarda la ruta de la imagen en la base de datos
            $newPubli->image = $imagePath;
        }
        $newPubli->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Publi created successfully');

    }

    public function editPubliForm($publi_id)
    {
        $publi = Publi::find($publi_id);
        return view('admin.update_publi', compact('publi'));
    }

    public function updatePubliForm($publi_id)
    {
        // Obtener la nota existente
        $publi = Publi::find($publi_id);

        // Mostrar la vista del formulario de actualización
        return view('admin.update_publi', compact('publi'));
    }

    public function updatePubli(Request $request, $publi_id)
    {

        // Obtener la nota existente
        $newPubli = Publi::find($publi_id);

        // Actualizar los campos con los nuevos valores
        $newPubli->title = $request->input('title');
        $newPubli->link = $request->input('link');
        $newPubli->is_field = $request->input('is_field');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('publi_images', 'public');
            // Guarda la ruta de la imagen en la base de datos
            $newPubli->image = $imagePath;
        }
        // Actualiza otros campos según sea necesario

        // Guardar la nota actualizada en la base de datos
        $newPubli->save();

        return redirect()->route('admin.dashboard')->with('success', 'Publi updated successfully');
    }

    public function deletePubli($publi_id)
    {
        $publi = Publi::find($publi_id);
        $publi->delete();

        return redirect()->route('admin.show_publis')->with('success', 'Publi deleted successfully');
    }
}
