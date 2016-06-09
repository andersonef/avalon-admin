<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 09/06/2016
 * Time: 14:15
 */

namespace Andersonef\AvalonAdmin\Commands;


use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'avalon:install';

    protected $description = 'Install the mini-CMS Avalon Admin on your laravel 5.2 project. After install you will be able to access yourdomain.com/avalon-admin and put some content on your site. For more information access http://github.com/andersonef/avalon-admin';

    public function handle()
    {
        try{

        } catch (\Exception $e) {
            $this->error($e->getMessage().' ---- '.$e->getTraceAsString());
        }
    }
}