<?php

namespace App\Jobs;

use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class QueryMNBRatesJob
 * @package App\Jobs
 */
class QueryMNBRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     * @return boolean
     */
    public function handle()
    {
        // MNB arfolyam lekerdezes
        // https://www.mnb.hu/letoltes/soap-service-fogyasztasa-php.pdf

        $client = new \SoapClient("http://www.mnb.hu/arfolyamok.asmx?wsdl");
        $currencyRatesStr = $client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult . "\n";
        if ($currencyRatesStr === ''){
            throw new \Exception('Az MNB arfolyam lekerdezes nem sikerult.');
        }
        $currencyRates = simplexml_load_string($currencyRatesStr);
        if ($currencyRates === false){
            throw new \Exception('Hiba az MNB arfolyam lekerdezes soran.');
        }

        $day = $currencyRates->Day['date'];
        $currencies = array();
        foreach ($currencyRates->Day->Rate as $rate){
            $currencies[] = new Currency([ 'iso_code' => $rate['curr']->__toString(), 'rate' => str_replace(',', '.', $rate->__toString()) ]);
        }
        // az adatbazisban letezo deviza rekordok update-je
        foreach ($currencies as $item){
            $records = Currency::where('iso_code', '=', $item->iso_code)->get();
            foreach ($records as $rec) {
                $rec->rate = $item->rate;
                $rec->save();
            }
        }
        return true;
    }
}
