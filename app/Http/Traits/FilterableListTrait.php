<?php

namespace App\Http\Traits;


use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

/**
 * Class FilterableListTrait
 *
 * Olyan listara jellemzo, ami szurheto a 'filter' GET parameter megadasaval. Ez az parameter egy tomb, ami tovabbi tetszoleges
 * szuro elemeket tartalmazhat kulcs=ertek parokban.
 * A szuro tulajdonsagokat a session tarolja az osben megadott kulcs alatt.
 * Ha van GET parameter, akkor felulirja a sessionben tarolt ertekeket. Ha nincs GET, akkor a sessionbol tolt be.
 * A sessiont ki is lehet torolni.
 *
 * @package App\Http\Traits
 */
trait FilterableListTrait
{

    public static $threeSwitchOn = 1;
    public static $threeSwitchOff = 2;
    public static $threeSwitchIndifferent = 0;

    /**
     * FilterableListTrait constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if (!property_exists(get_class($this), 'filterSavedToSession')){
            throw new Exception('FilterableListTrait: a lista $filterSavedToSession tulajdonsaga ures!');
        }
        if (!property_exists(get_class($this), 'filterSessionKey')){
            throw new Exception('FilterableListTrait: a lista $filterSessionKey tulajdonsaga ures!');
        }
        if ( (!property_exists(get_class($this), 'filterSessionKey')) || (!is_array($this->filterFields)) ) {
            throw new Exception('FilterableListTrait: a listanak nincs $filterFields tulajdonsaga!');
        }
        if (!property_exists(get_class($this), 'numberFilterFields')) {
            throw new Exception('FilterableListTrait: a listanak nincs $numberFilterFields tulajdonsaga!');
        }
    }

    /**
     * Vagy az URL-bol kapott GET, vagy az AJAX-bol kapott collectionbol allit elo egy szuro ertek halmazt.
     * A szuro halmazban minden szuro elem jelen van, max. NULL az erteke. Ez azert kell, hogy ne legyen gond, ha nem letezik az elem.
     * A szuro elemek halmazat vissza alakitja tombbe es collectionbe is. A tombot a template hasznalja, a collectiont az AJAX-os tabla tolto.
     *
     * Minden lista betolteskor 2x fut le: eloszor amikor az URL parametereket kell feldolgozni (oldal betoltes), masodszor amikor a tabla
     * AJAX-al tolti az elemeket. Igy akkor is lefut, amikor csak alkalmaznak egy uj filtert (tabla frissites).
     * Amikor a filter valtozik, azt elmenti a sessionbe. Ha a listat kesobb filter GET parameter nelkul hivjak meg,
     * akkor vissza allitja a sessionben tarolt szuroket.
     *
     * @param Collection $filterCollection
     * @param Request $request
     * @return array|mixed
     */
    public function processFilters(Collection &$filterCollection, Request $request){
        $filters = [];

        // ha vannak URL-bol kapott szurok, feldolgozzuk azokat es elmentjuk a sessionbe
        $filterText = $request->input('filter', null);
        if ($filterText != null && is_string($filterText)) {
            $items = explode('&', $filterText);
            foreach ($items as $item) {
                $temp = explode('=', $item);
                $filters[$temp[0]] = $temp[1];
            }
        }
        elseif ($filterCollection != null && $filterCollection->count() > 0) {
            $filters = $filterCollection->toArray();
        }

        // kiegeszitjuk a szurok tombot az esetleg ures szurokkel is, hogy legyen minden szuro kulcs a template-nek
        foreach ($this->filterFields as $field) {
            if (!array_key_exists($field, $filters)) {
                $filters[$field] = null;
            }
        }

        if ( ($filterText != null && is_string($filterText)) || ($filterCollection != null && $filterCollection->count() > 0) ) {
            if ($this->filterSavedToSession) {
                Session::remove($this->filterSessionKey);
                Session::put($this->filterSessionKey, $filters);
            }
        } else {
            if ($this->filterSavedToSession) {
                $filters = Session::get($this->filterSessionKey, []);
            }
            // kiegeszitjuk a szurok tombot az esetleg ures szurokkel is, hogy legyen minden szuro kulcs a template-nek
            foreach ($this->filterFields as $field) {
                if (!array_key_exists($field, $filters)) {
                    $filters[$field] = null;
                }
            }
        }

        // szamot tarolo szurok ertekeibol kivesszuk a formazast
        foreach ($this->numberFilterFields as $field) {
            if ($filters[$field] != null) {
                $filters[$field] = preg_replace('/([^0-9\.,])/i', '', $filters[$field]);
            }
        }

        $filterCollection = collect($filters);
        return $filters;
    }


    public function clearFiltersFromSession(){
        Session::remove($this->filterSessionKey);
    }

}
