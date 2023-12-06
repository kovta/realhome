<?php

use Illuminate\Database\Seeder;

class TextContentSeeder extends Seeder
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
                'inner_name' => 'login',
                'locales' => array(
                    'en' => array(
                        'title' => 'Login',
                        'content' => 'Login page\'s content',
                    ),
                    'hu' => array(
                        'title' => 'Bejelentkezés',
                        'content' => 'Bejelentkező oldal tartalma',
                    ),
                )
            ),

            array(
                'inner_name' => 'register',
                'locales' => array(
                    'en' => array(
                        'title' => 'Welcome',
                        'content' => 'Register page\'s content',
                    ),
                    'hu' => array(
                        'title' => 'Üdvözöljük',
                        'content' => 'Regisztráció oldal tartalma',
                    ),
                )
            ),

            array(
                'inner_name' => 'rolunk',
                'locales' => array(
                    'en' => array(
                        'title' => 'About Us',
                        'content' => 'About us text',
                    ),
                    'hu' => array(
                        'title' => 'Rólunk',
                        'content' => 'Rólunk tartalma',
                    ),
                )
            ),

            array(
                'inner_name' => 'kapcsolat',
                'locales' => array(
                    'en' => array(
                        'title' => 'Contact Us',
                        'content' => 'Contact text',
                    ),
                    'hu' => array(
                        'title' => 'Kapcsolat',
                        'content' => 'Kapcsolat tartalma',
                    ),
                )
            ),

            array(
                'inner_name' => 'feltetelek',
                'locales' => array(
                    'en' => array(
                        'title' => 'Terms and conditions',
                        'content' => 'Terms and conditions text',
                    ),
                    'hu' => array(
                        'title' => 'Felhasználási feltételek',
                        'content' => 'Felhasználási feltételek tartalma',
                    ),
                )
            ),

            array(
                'inner_name' => 'adatkezelesi-szabalyok',
                'locales' => array(
                    'en' => array(
                        'title' => 'Privacy policy',
                        'content' => 'Privacy policy text',
                    ),
                    'hu' => array(
                        'title' => 'Adatkezelési szabályok',
                        'content' => 'Adatkezelési szabályok tartalma',
                    ),
                )
            ),

        );


        // =============================================================================================================

        foreach ($recordDescriptor as $item) {
            $fields = $item;
            unset($fields['locales']);
            $idWas = \Illuminate\Support\Facades\DB::table('text_content_pages')->insertGetId($fields);
            foreach ($item['locales'] as $locale => $data) {
                DB::table('text_content_page_translations')->insert([
                    'text_content_page_id' => $idWas,
                    'locale' => $locale,
                    'title' => $data['title'],
                    'content' => $data['content'],
                ]);
            }
        }

    }
}
