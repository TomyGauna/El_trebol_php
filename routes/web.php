<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HolaMundoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta para mostrar una nota específica
Route::get('/nota/{nota_id}', [NewsController::class, 'show'])->name('show_note');

Route::get('/show_publi/{publi_id}', [NewsController::class, 'show'])->name('show_publi');

// Ruta para mostrar la página de inicio
Route::get('/', [NewsController::class, 'index'])->name('home');

Route::get('/news/{segment}', [NewsController::class, 'showInSegment'])->name('news_in_segment');

// Otras rutas para diferentes acciones
// ...

// Ruta para crear una nueva nota
Route::get('/create', [NewsController::class, 'createNew'])->name('create_note');

// Ruta para actualizar una nota existente
Route::get('/update/{nota_id}', [NewsController::class, 'updateNew'])->name('update_note');

// Ruta para la página "Hola Mundo"
Route::get('/hola-mundo', [HolaMundoController::class, 'index']);

// Ruta para la página de bienvenida
Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Otras rutas para la administración de notas, como editar, crear, eliminar, etc.

    #region Rutas para la administración de notas
    // Ruta para mostrar todas las notas
    Route::get('/admin/notes', [AdminController::class, 'showAllNotes'])->name('admin.show_notes');
    // Ruta para mostrar el formulario de creación de notas
    Route::get('/admin/create-note', [AdminController::class, 'createNoteForm'])->name('admin.create_note');
    // Ruta para procesar el formulario y crear la nota
    Route::post('/admin/store-note', [AdminController::class, 'storeNote'])->name('admin.store_note');
    // Ruta para mostrar el formulario de edición de una nota
    Route::get('/admin/edit-note/{nota_id}', [AdminController::class, 'editNoteForm'])->name('admin.edit_note_form');
    // Ruta para procesar el formulario y actualizar la nota
    Route::post('/admin/update-note/{nota_id}', [AdminController::class, 'updateNote'])->name('admin.update_note');
    // Ruta para eliminar una nota
    Route::delete('/admin/delete-note/{nota_id}', [AdminController::class, 'deleteNote'])->name('admin.delete_note');
    #endregion

    #region Rutas para la administración de publis
    Route::get('/admin/publi', [AdminController::class, 'showAllPublis'])->name('admin.show_publis');
    Route::get('/admin/create-publi', [AdminController::class, 'createPubliForm'])->name('admin.create_publi');
    Route::post('/admin/store-publi', [AdminController::class, 'storePubli'])->name('admin.store_publi');
    Route::get('/admin/edit-publi/{publi_id}', [AdminController::class, 'editPubliForm'])->name('admin.edit_publi_form');
    Route::post('/admin/update-publi/{publi_id}', [AdminController::class, 'updatePubli'])->name('admin.update_publi');
    Route::delete('/admin/delete-publi/{publi_id}', [AdminController::class, 'deletePubli'])->name('admin.delete_publi');
    #endregion
});

// Ruta para el dashboard de usuarios autenticados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Ruta para editar el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Ruta para actualizar el perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Ruta para eliminar el perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';
