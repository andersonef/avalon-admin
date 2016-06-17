<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:30
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'avalonadmin_galleries';
    protected $fillable = ['id', 'galleryName', 'galleryThumb', 'galleryDescription'];
    public $incrementing = false;

    public function Content()
    {
        return $this->belongsTo(Content::class, 'id');
    }

}