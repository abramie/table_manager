<?php

namespace App\Console\Commands;

use App\Models\Description;
use App\Models\Settings;
use App\Models\StatusTable;
use App\Models\Tag;
use App\Models\types\TypeInscription;
use App\Models\types\TypeTag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SaveConfigs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-configs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sauvegarde les settings, tags, types, etc.
    Ne sauvegarde pas les données utilisateurs et les tables/creneaux/events. ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $configs  =collect([
            'type_tags' => TypeTag::select(['name','code', 'bs_class', 'id', 'order'])->get(),
            'tags' => Tag::select(['nom','type_tag_code', 'order'])->get(),
            'settings' => Settings::select(['name','value', 'description'])->get(),
            'descriptions' => Description::select(['name', 'description'])->get(),
            'type_inscriptions' => TypeInscription::select(['name','code', 'bs_class', 'prend_une_place'])->get(),
            'status_tables' => StatusTable::select(['name','code', 'bs_class', 'indicateur_nom', 'afficher_public', 'inscription_possible'])->get(),
        ]);

        $fileContent = $configs->toJson(JSON_PRETTY_PRINT);
        $this->info($fileContent);

        Storage::put('savedConfigs.json', $fileContent);


        return $fileContent;

    }
}
