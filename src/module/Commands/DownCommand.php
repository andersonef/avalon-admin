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

class DownCommand extends Command
{
    protected $signature = 'avalon:down';

    protected $description = 'Uninstall the mini-CMS Avalon Admin on your laravel 5.2 project. It will remove all database tables and there is no way to go back!';

    public function __construct()
    {
        $this->description = trans('AvalonAdmin::Module.commands.down.description');
        parent::__construct();
    }

    public function handle()
    {
        try{
            $this->warn(trans('AvalonAdmin::Module.commands.down.warning'));
            if(!$this->confirm(trans('AvalonAdmin::Module.commands.down.confirm'))) return;

            $this->uninstallDatabase();
            $this->removeAssetFiles();

        } catch (\Exception $e) {
            $this->error($e->getMessage().' ---- '.$e->getTraceAsString());
        }
    }

    protected function uninstallDatabase()
    {
        $this->info(trans('AvalonAdmin::Module.commands.down.preparingDatabase'));
        app(AvalonMigrations::class)->down();
        $this->info(trans('AvalonAdmin::Module.commands.down.databaseOk'));
    }

    protected function removeAssetFiles()
    {
        $existe = file_exists(public_path(ParameterService::ASSET_PATH));
        $this->info(trans('AvalonAdmin::Module.commands.down.preparingFiles'));

        if($existe) {
            $this->removeDirectory(public_path(ParameterService::ASSET_PATH));
        }

        $this->info(trans('AvalonAdmin::Module.commands.down.filesOk'));
    }

    protected function removeDirectory($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    $this->removeDirectory($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }

}