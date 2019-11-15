<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class InstitutionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        //CREA EL USUARIOS
        App\Institutional::create([
            'estado'=> 'ACTIVO',
            'mision'=> 'Misión.',
            'vision'=> 'Visión.',
            'direccion'=> 'Tarija Bolivia',
            'telefono'=> '00000',
            'web'=> 'www.terminal.com',
            'email'=> 'terminal@terminal.com',
            'contacto'=> 'terminal',
            'user_id' => '1'          
        ]);


    }
}
