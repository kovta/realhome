<?php

use Illuminate\Database\Seeder;
use \App\Models\Enum\ClientStatusEnum;
use \App\Models\Enum\ClientPreferredContactEnum;
use \App\Models\Enum\UserTypeEnum;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $recordDescriptor = array(
            // ---------------------------------------

            // Kliens Kata
            array(
                'user_id' => 6,
                'status_enum' => ClientStatusEnum::aktualis,
                'phone_1' => '111',
                'phone_2' => '222',
                'preferred_contact_enum' => ClientPreferredContactEnum::email,
                'partner_id' => null,
                'source_enum' => null,
                'broker_id' => null,
                'last_contacted' => null,
                'nationality' => null,
                'number_tenants' => null,
                'number_children' => null,
                'children_age' => null,
                'required_school_enum' => null,
                'pet' => null,
                'moveindate' => null,
                'comment' => null,
                'name' => 'Kliens Kata',
                'email' => 'kliens.kata@domain.hu',
            ),

            // Érdeklődő Éva
            array(
                'user_id' => 7,
                'status_enum' => ClientStatusEnum::aktualis,
                'phone_1' => '111',
                'phone_2' => '222',
                'preferred_contact_enum' => ClientPreferredContactEnum::email,
                'partner_id' => null,
                'source_enum' => null,
                'broker_id' => null,
                'last_contacted' => null,
                'nationality' => null,
                'number_tenants' => null,
                'number_children' => null,
                'children_age' => null,
                'required_school_enum' => null,
                'pet' => null,
                'moveindate' => null,
                'comment' => null,
                'name' => 'Érdeklődő Éva',
                'email' => 'erdeklodo.eva@domain.hu',
            ),

        );

        foreach ($recordDescriptor as $client) {
            DB::table('clients')->insert($client);
        }
    }
}
