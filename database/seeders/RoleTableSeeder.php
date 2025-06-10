<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => "Administrateur", 'slug' => Str::slug("Administrateur"), 'nbRsp' => '&nbtsd!?']);

        Role::create(['name' => "Publicateur d' articles", 'slug' => Str::slug("Publicateur d' articles"), 'nbRsp' => '&nbrsp?!']);

        Role::create(['name' => "Visiteur", 'slug' => Str::slug("Visiteur"), 'nbRsp' => '&nbdfpo@!']);
    }
}
