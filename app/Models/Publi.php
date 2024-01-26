<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Publi extends Model
{
    protected $table = 'publi'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'title', 'image', 'link', 'is_field',
    ];

    const IS_FIELD_VALUES = [
        '1', '2', '3', '4', '5', '6', 'none',
    ];

    public static function isFieldValidationRules()
    {
        return [
            'is_field' => 'required|in:' . implode(',', self::IS_FIELD_VALUES),
        ];
    }

    // Aquí puedes definir relaciones y métodos adicionales si es necesario

    public function deleteUnusedImages()
    {
        // Implementa la lógica para eliminar imágenes no utilizadas
    }
}