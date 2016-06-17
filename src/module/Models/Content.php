<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:15
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'avalonadmin_contents';
    protected $fillable = ['userId','contentTypeId','categoryId','contentDate'];

    public function User()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function ContentType()
    {
        return $this->belongsTo(ContentType::class, 'contentTypeId');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}