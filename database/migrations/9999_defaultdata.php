<?php

use App\Models\Profile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (DB::table('evenements')->count() == 0 && config('app.env') == "local"){


        }elseif (config('app.env') == "production" && DB::table('users')->count() == 0 ){
            $admin = Profile::create([
                'name' => "admin",
                'email' => "admin@som.fr",
                'password' => Hash::make(config('app.admin_password')),
            ]);
            $admin->assignRole('admin');

            DB::table('triggerwarnings')->insert(
                array(
                    'nom' => 'mort',
                )
            );

            DB::table('tags')->insert(
                array(
                    'nom' => 'horreur',
                )
            );
            DB::table('tags')->insert(
                array(
                    'nom' => 'magie',
                )
            );
        }





        //

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
