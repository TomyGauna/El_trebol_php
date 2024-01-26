<?php

// app/Http/Controllers/NewsController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Publi;

class NewsController extends Controller
{
    // Método para mostrar una nota específica
    public function show($nota_id)
    {
        // Obtener todas las últimas noticias
        // $ultimas_noticias = UltimaNoticia::all();

        try {
            // Intentar obtener la nota por ID
            $note = News::findOrFail($nota_id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Manejar el caso en que la nota no se encuentre
            $note = null;
        }

        // Renderizar la vista con las últimas noticias y la nota específica
        return view('nota', ['note' => $note]);
    }

    // Método para mostrar la página de inicio
    public function index()
    {
        // Obtener todas las últimas noticias y publicidades
        //$ultimas_noticias = UltimaNoticia::all();
        $publi = Publi::all();

        // Crear un diccionario para almacenar las noticias
        $notes_dict = [];

        // Iterar sobre los campos is_1, is_2, ..., is_15
        for ($i = 1; $i <= 15; $i++) {
            // Obtener la nota correspondiente
            $note = News::where('is_field', strval($i))->orderBy('created_at', 'desc')->first();
            // Solo agregar al diccionario si la nota no es null
                if ($note) {
                    $notes_dict["{$i}_note"] = $note;
                }
        }

        // Crear una lista de IDs de notas a excluir
        $exclude_ids = array_map(function ($note) {
            return $note->id;
        }, array_filter($notes_dict));

        // Obtener la lista de noticias excluyendo las notas encontradas
        $news_list = News::whereNotIn('id', $exclude_ids)->get();

        $newsMain = News::where('segment', 'politica')
                        ->where('priority_segment', 'primary')
                        ->orderBy('created_at', 'desc') // Puedes cambiar el criterio de ordenación
                        ->first();

        $newsSec = News::where('segment', 'politica')
                    ->where('priority_segment', 'secondary')
                    ->orderBy('created_at', 'desc') // Puedes cambiar el criterio de ordenación
                    ->take(2) // Puedes ajustar la cantidad de noticias secundarias que deseas mostrar
                    ->get();

        $otherNews = News::where('segment', 'politica')
                    ->where('priority_segment', 'none')
                    ->orderBy('created_at', 'desc')
                    ->take(2) // Puedes ajustar la cantidad de noticias secundarias que deseas mostrar
                    ->get();
        // ... Lógica para obtener noticias en la región y segmento de política

        // Pasar el diccionario y la lista de noticias al contexto
        $context = [
            //'ultimas_noticias' => $ultimas_noticias,
            'news_list' => $news_list,
            'notes' => $notes_dict,
            'publis' => $publi,
            'newsMain' => $newsMain,
            'newsSec' => $newsSec,
            'otherNews' => $otherNews,
            // ... Otras variables de contexto
        ];
        
        // Renderizar la vista de la página de inicio
        return view('index', $context);
    }

    // Otros métodos para diferentes acciones
    // ...

    // Método para crear una nueva nota
    public function createNew(Request $request)
    {
        if ($request->isMethod('post')) {
            // Lógica para procesar el formulario de creación de nota
            // ...

            // Redireccionar a la vista de notas después de la creación
            return redirect()->route('view_notes');
        }

        // Renderizar la vista de creación de nota
        return view('admin.create_new');
    }

    // Método para actualizar una nota existente
    public function updateNew(Request $request, $nota_id)
    {
        // Obtener la nota existente por ID
        $new_note = News::find($nota_id);

        if ($request->isMethod('post')) {
            // Lógica para procesar el formulario de actualización de nota
            // ...

            // Redireccionar a la vista de notas después de la actualización
            return redirect()->route('view_notes');
        }

        // Renderizar la vista de actualización de nota
        return view('admin.update_new', ['new_note' => $new_note]);
    }

    public function showInSegment($segment)
    {
        // Lógica para obtener la noticia principal
        $newsMain = News::where('segment', $segment)
                        ->where('priority_segment', 'primary')
                        ->orderBy('created_at', 'desc') // Puedes cambiar el criterio de ordenación
                        ->first();
        // Lógica para obtener noticias secundarias
        $newsSec = News::where('segment', $segment)
                    ->where('priority_segment', 'secondary')
                    ->orderBy('created_at', 'desc') // Puedes cambiar el criterio de ordenación
                    ->take(2) // Puedes ajustar la cantidad de noticias secundarias que deseas mostrar
                    ->get();

        $otherNews = News::where('segment', $segment)
                    ->where('priority_segment', 'none')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('segment', compact('segment', 'newsMain', 'newsSec', 'otherNews'));
    }

}
