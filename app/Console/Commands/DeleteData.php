<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DeleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:expired-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $voices  = DB::table('voices')->where('created_at','<=', now()->subse(1))->get();
       foreach ($voices as $voice){
        $image_path = public_path('voices/' . $voice->voice_name);
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        Db::table('voices')->where('id','=', $voice->id)->delete();
       }
       
    }
}
