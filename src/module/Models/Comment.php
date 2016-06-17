<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:26
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'avalonadmin_comments';
    protected $fillable = ['contentId','commentName', 'commentEmail', 'commentDate', 'commentContent'];

    public function Content()
    {
        return $this->belongsTo(Content::class, 'contentId');
    }
}