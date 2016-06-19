<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 09/06/2016
 * Time: 14:27
 */

namespace Andersonef\AvalonAdmin\Migrations;


use Andersonef\AvalonAdmin\Models\ContentType;
use Andersonef\AvalonAdmin\Models\Role;
use Andersonef\AvalonAdmin\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvalonMigrations extends Migration
{
    public function up(array $adminInfo = [])
    {
        Schema::create('avalonadmin_roles', function(Blueprint $table){
            $table->string('id');
            $table->primary('id');

            $table->string('roleName');
            $table->string('roleDescription');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_users', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('userName');
            $table->string('userEmail');
            $table->binary('userPicture')->nullable();
            $table->string('userPassword');
            $table->string('roleId');
            $table->foreign('roleId')->references('id')->on('avalonadmin_roles');
            $table->rememberToken();
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_parameters', function(Blueprint $table){
            $table->string('id');
            $table->primary('id');

            $table->string('parameterDescription')->nullable();
            $table->string('parameterValue');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_content_types', function(Blueprint $table){
            $table->string('id');
            $table->primary('id');
            $table->string('contentTypeName');
            $table->string('contentTypeDescription');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_categories', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoryName');
            $table->string('categoryDescription')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_contents', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('avalonadmin_users');

            $table->string('contentTypeId');
            $table->foreign('contentTypeId')->references('id')->on('avalonadmin_content_types');

            $table->unsignedBigInteger('categoryId');
            $table->foreign('categoryId')->references('id')->on('avalonadmin_categories');

            $table->date('contentDate');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_comments', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('contentId');
            $table->foreign('contentId')->references('id')->on('avalonadmin_contents');

            $table->string('commentName');
            $table->string('commentEmail');
            $table->text('commentContent');
            $table->date('commentDate');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_pages', function(Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('avalonadmin_contents');

            $table->string('pageBanner');
            $table->string('pageTitle');
            $table->text('pageSummary');
            $table->text('pageContent');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_galleries', function(Blueprint $table){
            $table->unsignedBigInteger('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('avalonadmin_contents');

            $table->string('galleryName');
            $table->string('galleryThumb');
            $table->string('galleryDescription');

            $table->unsignedBigInteger('idUserAuthor');
            $table->foreign('idUserAuthor')->references('id')->on('avalonadmin_users');
            $table->nullableTimestamps();
        });

        Schema::create('avalonadmin_pictures', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('galleryId');
            $table->foreign('galleryId')->references('id')->on('avalonadmin_galleries');

            $table->string('picturePath');
            $table->string('pictureThumb');
            $table->string('pictureTitle');
            $table->text('pictureDescription');
            $table->nullableTimestamps();
        });
        $this->seedDatabase($adminInfo);
    }


    public function down()
    {
        Schema::drop('avalonadmin_pictures');
        Schema::drop('avalonadmin_galleries');
        Schema::drop('avalonadmin_pages');
        Schema::drop('avalonadmin_comments');
        Schema::drop('avalonadmin_contents');
        Schema::drop('avalonadmin_categories');
        Schema::drop('avalonadmin_content_types');
        Schema::drop('avalonadmin_parameters');
        Schema::drop('avalonadmin_users');
        Schema::drop('avalonadmin_roles');
    }


    protected function seedDatabase(array $adminInfo = [])
    {
        //Roles
        Role::create(['id' => 'superadmin', 'roleName' => 'AvalonAdmin::Module/Models.Role.superadmin.name', 'roleDescription' => 'AvalonAdmin::Module/Models.Role.superadmin.description']);
        Role::create(['id' => 'admin', 'roleName' => 'AvalonAdmin::Module/Models.Role.admin.name', 'roleDescription' => 'AvalonAdmin::Module/Models.Role.admin.description']);
        Role::create(['id' => 'editor', 'roleName' => 'AvalonAdmin::Module/Models.Role.editor.name', 'roleDescription' => 'AvalonAdmin::Module/Models.Role.editor.description']);
        Role::create(['id' => 'author', 'roleName' => 'AvalonAdmin::Module/Models.Role.author.name', 'roleDescription' => 'AvalonAdmin::Module/Models.Role.author.description']);
        Role::create(['id' => 'readonly', 'roleName' => 'AvalonAdmin::Module/Models.Role.readonly.name', 'roleDescription' => 'AvalonAdmin::Module/Models.Role.readonly.description']);

        //Content types
        ContentType::create(['id' => 'page', 'contentTypeName' => 'AvalonAdmin::Module/Models.ContentType.page.name', 'contentTypeDescription' => 'AvalonAdmin::Module/Models.ContentType.page.description']);
        ContentType::create(['id' => 'gallery', 'contentTypeName' => 'AvalonAdmin::Module/Models.ContentType.gallery.name', 'contentTypeDescription' => 'AvalonAdmin::Module/Models.ContentType.gallery.description']);

        //Super Admin User:
        User::create(['userName' => $adminInfo['userName'], 'userEmail' => $adminInfo['userEmail'], 'userPassword' => bcrypt($adminInfo['userPassword']),'roleId' => 'superadmin']);
    }
}