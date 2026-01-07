<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\types\TypeTag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class LoadConfigs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-configs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    //add parameter replace



    /**
     * Execute the console command.
     */
    public function handle()
    {
        //


        $value = Storage::json('savedConfigs.json');

        $typesTags = $value['type_tags'];
        $tags = $value['tags'];
        dump($typesTags);


        if($replace = true){

        }

        foreach($typesTags as $t ){
            $typeTag= $t;
            TypeTag::updateOrCreate(['code'=> $typeTag['code']], ['name'=> $typeTag['name'], 'bs_class'=> $typeTag['bs_class']]);
        }

        foreach($tags as $tag){
            Tag::updateOrCreate(['nom' => $tag['nom']], ['type_tag_code' => $tag['type_tag_code']]);
        }







    }
}
