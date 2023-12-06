<?php

use Illuminate\Database\Seeder;
use App\Models\SiteParameter;

class SiteParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(
            array(
                'code_name' => 'EmailSimpleContactRequest',
                'description' => 'Egyszerűsített kapcsolatkérés esetén erre a címre kell emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'EmailFullContactRequest',
                'description' => 'A Kapcsolatfelvétel kérés oldalon kezdeményezett kérés esetén erre a címre kell emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'EmailShareSearchResult',
                'description' => 'Ingatlan keresés eredménylista megosztása esetén erre a címre kell emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'EmailRegisterRequirement',
                'description' => 'Új vételi/bérlési igény regisztrálása esetén erre a címre kell emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'EmailSeriousInterest',
                'description' => 'Határozott vételi/bérlési igényhez kapcsolódó kapcsolatfelvételi kérés esetén erre a címre kell emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'EmailNearMoveInTime',
                'description' => 'A 2 hónapon belüli beköltözhetőségről erre a címre kell emlékeztető emailt küldeni',
                'value' => 'Admin@Realhome.hu',
            ),
            array(
                'code_name' => 'OwnerContactNotificationPeriod',
                'description' => 'Ennyi naponként emlékeztető emailt kap az eladó ingatlant rögzítő kolléga, hogy lépjen kapcsolatba a tulajdonossal.',
                'value' => '30',
            ),
            array(
                'code_name' => 'DisplayEstateNumOfferPage',
                'description' => 'A ajánló oldalakon (Eladó ingatlanok, Bérbeadó ingatlanok ill. Speciális ajánló oldalak) az eredménylistán egyszerre megjelenítendő ingatlanok száma',
                'value' => '12',
            ),
            array(
                'code_name' => 'DisplayEstateNumMain1',
                'description' => 'A főoldali Főajánló panelen egyszerre megjelenítendő ingatlanok száma',
                'value' => '6',
            ),
            array(
                'code_name' => 'DisplayEstateNumMain2',
                'description' => 'A főoldali eladó/kiadó ajánló paneleken egyszerre megjelenítendő ingatlanok száma',
                'value' => '3',
            ),
            array(
                'code_name' => 'DisplayEstateNumDefault',
                'description' => 'Az Ingatlan eredménylista panelen egyszerre megjelenítendő ingatlanok számának default értéke',
                'value' => '10',
            ),
            array(
                'code_name' => 'MinScoreMainPageAppearence',
                'description' => 'A minimális pontszám érték amivel egy ingatlannak rendelkeznie kell, hogy megjelenhessen a főoldali ajánlókon.',
                'value' => '4',
            ),
            array(
                'code_name' => 'SimpleSearchAreaLimit',
                'description' => 'Az egyszerű keresés panelen az alapterület szűrés beállítására szolgáló csúszka felső végpontjának értéke, m2',
                'value' => '50000',
            ),
            array(
                'code_name' => 'SimpleSearchPriceLimit',
                'description' => 'Az egyszerű keresés panelen az ár szűrés beállítására szolgáló csúszka felső végpontjának értéke, M HUF',
                'value' => '1000',
            ),
            array(
                'code_name' => 'SimpleSearchRentLimit',
                'description' => 'Az egyszerű keresés panelen a bérleti díj szűrés beállítására szolgáló csúszka felső végpontjának értéke, Huf/hó',
                'value' => '1000000',
            ),
            array(
                'code_name' => 'TagContractTypePlacement',
                'description' => 'Az ingatlan képen megjelenő Szerződéstípus („Eladó/kiadó”) tag elhelyezkedése',
                'value' => 'Bal felső',
            ),
            array(
                'code_name' => 'TagContractTypeBackgroundColor',
                'description' => 'Az ingatlan képen megjelenő Szerződéstípus („Eladó/kiadó”) tag háttérszíne',
                'value' => '#0d1432',
            ),
            array(
                'code_name' => 'TagContractTypeForegroundColor',
                'description' => 'Az ingatlan képen megjelenő Szerződéstípus („Eladó/kiadó”) tag karaktereinek színe',
                'value' => '#ffffff',
            ),
            array(
                'code_name' => 'TagPricePlacement',
                'description' => 'Az ingatlan képen megjelenő Ár tag elhelyezkedése',
                'value' => 'Alsó közép',
            ),
            array(
                'code_name' => 'TagPriceBackgroundColor',
                'description' => 'Az ingatlan képen megjelenő Ár tag háttérszíne',
                'value' => 'NULL',
            ),
            array(
                'code_name' => 'TagPriceForegroundColor',
                'description' => 'Az ingatlan képen megjelenő Ár tag karaktereinek színe',
                'value' => '#17c788',
            ),
            array(
                'code_name' => 'TagFeaturedPlacement',
                'description' => 'Az ingatlan képen megjelenő „Kiemelt” tag elhelyezkedése',
                'value' => 'felső közép',
            ),
            array(
                'code_name' => 'TagFeaturedBackgroundColor',
                'description' => 'Az ingatlan képen megjelenő „Kiemelt” tag háttérszíne',
                'value' => '#17c788',
            ),
            array(
                'code_name' => 'TagFeaturedForegroundColor',
                'description' => 'Az ingatlan képen megjelenő „Kiemelt” tag karaktereinek színe',
                'value' => '#ffffff',
            ),
            array(
                'code_name' => 'MaxShareableSearchResult',
                'description' => 'A megosztható keresési eredmény listák maximális mérete (db ingatlan)',
                'value' => '20',
            ),

            // GBL uj parameterek
            array(
                'code_name' => 'SiteOwnerAddress',
                'description' => 'Az oldal üzemeltetőjének címe',
                'value' => 'Hungary, 1234 Bp. Utca házszám',
            ),
            array(
                'code_name' => 'SiteOwnerPhone',
                'description' => 'Az oldal üzemeltetőjének telefonszáma',
                'value' => '06 20 1234567',
            ),
            array(
                'code_name' => 'SiteOwnerEmail',
                'description' => 'Az oldal üzemeltetőjének e-mail címe',
                'value' => 'info@realhome.hu',
            ),

        );


        // =============================================================================================================

        foreach ($recordDescriptor as $parameter) {
            $sp = new SiteParameter();
            $sp->code_name = $parameter['code_name'];
            $sp->description = $parameter['description'];
            $sp->setValue($parameter['value']);
            $sp->save();
        }

    }
}
