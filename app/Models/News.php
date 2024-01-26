<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $table = 'news'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'title', 'segundo_title', 'subtitle', 'image', 'content', 'content_1', 'image_1',
        'video_1', 'content_2', 'image_2', 'video_2', 'content_3', 'image_3', 'video_3',
        'content_4', 'image_4', 'video_4', 'content_5', 'is_field', 'region', 'segment',
        'priority_region', 'priority_segment', 'dia_creacion',
    ];

    const IS_FIELD_VALUES = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', 'none',
    ];

    const REGION_VALUES = [
        'san_martin', 'tres_de_febrero', 'malvinas_argentinas', 'san_isidro', 'vicente_lopez', 'none'
    ];

    const REGION_PRIORITY = [
        'primary', 'secondary', 'none'
    ];

    const SEGMENT_VALUES = [
        'politica', 'sociedad', 'cultura', 'deportes', 'unsam', 'none',
    ];

    const SEGMENT_PRIORITY = [
        'primary', 'secondary', 'none'
    ];


    public static function isFieldValidationRules()
    {
        return [
            'is_field' => 'required|in:' . implode(',', self::IS_FIELD_VALUES),
        ];
    }

    public static function regionValidationRules()
    {
        return [
            'region' => 'required|in:' . implode(',', self::REGION_VALUES),
            'priority_region' => 'required|in:' . implode(',', self::REGION_PRIORITY),
        ];
    }

    public static function segmentValidationRules()
    {
        return [
            'segment' => 'required|in:' . implode(',', self::SEGMENT_VALUES),
            'priority_segment' => 'required|in:' . implode(',', self::SEGMENT_PRIORITY),
        ];
    }


    // Aquí puedes definir relaciones y métodos adicionales si es necesario

    public function deleteUnusedImages()
    {
        // Implementa la lógica para eliminar imágenes no utilizadas
    }
}