<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 09/06/2016
 * Time: 14:15
 */

namespace Andersonef\AvalonAdmin\Commands;


use Andersonef\AvalonAdmin\Migrations\AvalonMigrations;
use Andersonef\AvalonAdmin\Services\Core\ParameterService;
use Illuminate\Console\Command;

class UpCommand extends Command
{
    protected $signature = 'avalon:up';

    protected $description = 'Install the mini-CMS Avalon Admin on your laravel 5.2 project. After install you will be able to access yourdomain.com/avalon-admin and put some content on your site. For more information access http://github.com/andersonef/avalon-admin';

    public function __construct()
    {
        $this->description = trans('AvalonAdmin::Module.commands.up.description');
        parent::__construct();
    }


    public function handle()
    {
        try{
            $adminInfo = [];
            $adminInfo['userName'] = $this->ask(trans('AvalonAdmin::Module.commands.up.askUserName'), 'Avalon Super Administrator');
            $adminInfo['userEmail'] = $this->ask(trans('AvalonAdmin::Module.commands.up.askUserEmail'), 'admin@mywebsite.com');
            $adminInfo['userPassword'] = $this->ask(trans('AvalonAdmin::Module.commands.up.askUserPassword'), 'secret');

            $this->installDatabase($adminInfo);
            $this->copyAssetFiles();
        } catch (\Exception $e) {
            $this->error($e->getMessage().' ---- '.$e->getTraceAsString());
        }
    }


    protected function installDatabase(array $adminInfo = [])
    {
        $this->info(trans('AvalonAdmin::Module.commands.up.preparingDatabase'));
        app(AvalonMigrations::class)->up($adminInfo);
        $this->info(trans('AvalonAdmin::Module.commands.up.databaseOk'));
    }

    protected function copyAssetFiles()
    {
        $this->info(trans('AvalonAdmin::Module.commands.up.preparingFiles'));
        $this->recursiveCopy(__DIR__.'/../../assets', public_path(ParameterService::ASSET_PATH));
        $this->info(trans('AvalonAdmin::Module.commands.up.filesOk', ['path' => public_path(ParameterService::ASSET_PATH)]));
    }

    protected function recursiveCopy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recursiveCopy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}