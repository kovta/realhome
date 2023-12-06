<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(TextContentSeeder::class);

        $this->call(AdvertisingPartnerSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(SiteParameterSeeder::class);
        $this->call(RealEstateTypeSeeder::class);
        $this->call(LocationAreaSeeder::class);
        $this->call(LocationTownDistrictSeeder::class);
        $this->call(LocationNeighborhoodSeeder::class);

        $this->call(RealEstateSeeder::class);
        $this->call(RealEstateOfferSeeder::class);
        $this->call(ClientRequirementSeeder::class);
    }
}
