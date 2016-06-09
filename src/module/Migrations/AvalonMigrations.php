<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 09/06/2016
 * Time: 14:27
 */

namespace Andersonef\AvalonAdmin\Migrations\AvalonMigrations;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvalonMigrations extends Migration
{
    public function up()
    {
        Schema::create('avalonadmin_roles', function(Blueprint $table){
            $table->string('id');
            $table->primary('id');

            $table->string('roleName');
            $table->string('roleDescription');
        });
        Schema::create('avalonadmin_users', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('userName');
            $table->string('userEmail');
            $table->string('userPassword');
            $table->string('roleId');
            $table->foreign('roleId')->references('id')->on('avalonadmin_roles');
            $table->rememberToken();
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_galleries', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('galleryName');
            $table->string('galleryDescription');

            $table->unsignedBigInteger('idUserAuthor');
            $table->foreign('idUserAuthor')->references('id')->on('avalonadmin_users');

        });
    }


    public function down()
    {
        Schema::drop('avalonadmin_roles');
        Schema::drop('avalonadmin_users');
        Schema::drop('avalonadmin_galleries');
    }
}