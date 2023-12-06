<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
use \App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $recordDescriptor = array(

            array('nev' => 'Fejlesztő Frankó',
                'email' => 'dev@gbl.hu',
                'jelszo' => 'x',
                'roles' => ['developers'],
                'type_enum' => '1',
            ),
            array('nev' => 'Admin Aladár',
                'email' => 'admin@gbl.hu',
                'jelszo' => 'Barlanglako1',
                'roles' => ['administrators'],
                'type_enum' => '1',
            ),
            array('nev' => 'Szigeti Judit',
                'email' => 'office@realhome.hu',
                'jelszo' => '1234',
                'roles' => ['administrators'],
                'type_enum' => '1',
            ),
            array('nev' => 'Sales Sándor',
                  'email' => 'sales.sandor@gbl.hu',
                  'jelszo' => 'x',
                  'roles' => ['sales-sr'],
                  'type_enum' => '1',
            ),
            array('nev' => 'Kovacs Roland',
                'email' => 'kovacs.roland@gbl.hu',
                'jelszo' => 'Barlanglako1',
                'roles' => ['developers'],
                'type_enum' => '1',
            ),
            array('nev' => 'Balazs Csaba',
                'email' => 'balazs.csaba@gbl.hu',
                'jelszo' => 'Barlanglako1',
                'roles' => ['developers'],
                'type_enum' => '1',
            ),

            // -----------------------------------

            array('nev' => 'Kliens Kata',
                'email' => 'kliens.kata@domain.hu',
                'jelszo' => 'x',
                'roles' => ['clients'],
                'type_enum' => '2',
            ),
            array('nev' => 'Érdeklődő Éva',
                'email' => 'erdeklodo.eva@domain.hu',
                'jelszo' => 'x',
                'roles' => ['clients'],
                'type_enum' => '2',
            ),

        );


        // =============================================================================================================

        foreach ($recordDescriptor as $user) {
            $idWas = DB::table('users')->insertGetId([
                'name' => $user['nev'],
                'email' => $user['email'],
                'password' => Hash::make($user['jelszo']),
                'type_enum' => $user['type_enum'],
            ]);
            if (count($user['roles'])){
                $userFromDB = User::find($idWas);
                $userFromDB->assignRole($user['roles']);
            }
        }

    }
}
