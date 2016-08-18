<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/06/2016
 * Time: 11:10
 */

namespace Andersonef\AvalonAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'avalonadmin_parameters';
    protected $fillable = ['id', 'parameterDescription', 'userId', 'parameterValue'];
    public $incrementing = false;
    public $keyType = 'string';

    public function User()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function __toString()
    {
        return $this->parameterValue;
    }


}