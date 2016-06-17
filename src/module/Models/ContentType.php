<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:12
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $table = 'avalonadmin_content_types';
    protected $fillable = ['id', 'contentTypeName','contentTypeDescription'];
    public $incrementing = false;

    public function getContentTypeNameAttribute($value)
    {
        return trans($value);
    }

    public function getContentTypeDescriptionAttribute($value)
    {
        return trans($value);
    }
}