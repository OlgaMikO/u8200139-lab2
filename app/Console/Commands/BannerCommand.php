<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BannerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banner:deactivate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate the banner';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $banner_id = $this->argument('id');
        if(DB::table('banners')->where('banner_id', $banner_id)->doesntExist()) {
            echo "Not Found\n";
        } else
        {
            $count = DB::table('banners')->where('banner_id', $banner_id)->update(['activity' => false]);
            if($count > 0) {
                echo "Обновление прошло успешно\n";
            }
        }
    }
}
