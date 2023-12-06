<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Currency::all();
        return view('Currency.currency-list', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity = new Currency();
        return view('Currency.currency-create', ['record' => $entity]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->iso_code == 'HUF') return abort(403, 'Unauthorized action.');
        $request->validate(Currency::validationRules());

        $entity = new Currency();
        $entity->iso_code = $request->iso_code;
        $entity->rate = $request->rate;
        $entity->save();
        return redirect(route('currencies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        if ($currency->id == Currency::$HUF) return abort(403, 'Unauthorized action.');
        return view('Currency.currency-edit', ['record' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        if ($currency->id == Currency::$HUF) return abort(403, 'Unauthorized action.');
        $request->validate(Currency::validationRules());

        $currency->iso_code = $request->iso_code;
        $currency->rate = $request->rate;
        $currency->save();
        return redirect(route('currencies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect(route('currencies.index'));
    }

/*
    public function mnbCurrencyQuery(Request $request){

        // MNB arfolyam lekerdezes
        // https://www.mnb.hu/letoltes/soap-service-fogyasztasa-php.pdf

        $client = new \SoapClient("http://www.mnb.hu/arfolyamok.asmx?wsdl");
        $currencyRatesStr = $client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult . "\n";
        if ($currencyRatesStr == ''){
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

        return view('Currency.currency-mnb', ['day' => $day, 'records' => $currencies]);
    }
*/


    public function mnbCurrencyQueryAjax(Request $request){

        // MNB arfolyam lekerdezes
        // https://www.mnb.hu/letoltes/soap-service-fogyasztasa-php.pdf

        $client = new \SoapClient("http://www.mnb.hu/arfolyamok.asmx?wsdl");
        $currencyRatesStr = $client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult . "\n";
        if ($currencyRatesStr == ''){
            $message = 'Az MNB arfolyam lekerdezes nem sikerult.';
            //throw new \Exception($message);
            $result = response()->json(['code' => 1, 'message' => $message]);
            return $result;
        }
        $currencyRates = simplexml_load_string($currencyRatesStr);
        if ($currencyRates === false){
            $message = 'Hiba az MNB arfolyam lekerdezes soran.';
            //throw new \Exception($message);
            $result = response()->json(['code' => 1, 'message' => $message]);
            return $result;
        }

        $day = $currencyRates->Day['date'];
        $currencies = array();
        foreach ($currencyRates->Day->Rate as $rate){
            $currencies[] = new Currency([ 'iso_code' => $rate['curr']->__toString(), 'rate' => str_replace(',', '.', $rate->__toString()) ]);
        }

        if (count($currencies) == 0){
            $result = response()->json([
                'code' => 1,
                'message' => "$day napra nincsenek árfolyamok"
            ]);
            return $result;
        }

        // az adatbazisban letezo deviza rekordok update-je
        foreach ($currencies as $item){
            $records = Currency::where('iso_code', '=', $item->iso_code)->get();
            foreach ($records as $rec) {
                $rec->rate = $item->rate;
                $rec->save();
            }
        }

        $result = response()->json([
            'code' => 0,
            'message' => 'Sikeres lekérdezés.'
        ]);

        return $result;
    }
}
