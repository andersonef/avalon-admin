<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:28
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'avalonadmin_pages';
    protected $fillable = ['id', 'pageBanner','pageTitle', 'pageSummary', 'pageContent'];
    public $incrementing = false;

    public function Content()
    {
        return $this->belongsTo(Content::class, 'id');
    }
}