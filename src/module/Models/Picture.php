<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 12:27
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'avalonadmin_pictures';
    protected $fillable = ['galleryId', 'picturePath', 'pictureThumb', 'pictureTitle', 'pictureDescription'];

    public function Gallery()
    {
        return $this->belongsTo(Gallery::class, 'galleryId');
    }
}