<?php

use App\Jobs\QueryMNBRatesJob;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  TODO: refaktor: route groups + middleware VAGY resource controllers bevezetése
//      ("resource routing assigns the typical "CRUD" routes to a controller with a single line of code")

Route::get('/email/verify/{id}/{hash}', static function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Auth::routes(['verify' => true]);

// nyilvanos route-ok -----------------------------------------------------------

// nyelv valtas az oldal feluletein
Route::get('lang/{locale}', 'LanguageController@changeLanguage')->name('language');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/kereses', 'HomeController@searchView')->name('search');
// ideiglenes URL-ek validacioja
Route::get('/validaterealestaterouteurl/{uniqueId}', 'RealEstateRouteController@validateUrl')->middleware('signed')->name('validaterealestaterouteurl');
Route::get('/validaterealestateofferurl/{uniqueId}', 'RealEstateOfferController@validateUrl')->middleware('signed')->name('validaterealestateofferurl');
// email validacio
Route::get('/mustvalidateemail', 'HomeController@mustValidateEmail')->name('mustvalidateemail');
Route::get('/rolunk', 'HomeController@rolunk')->name('rolunk');
Route::get('/kapcsolat', 'HomeController@kapcsolat')->name('kapcsolat');
Route::post('/kapcsolatfelveteli-keres', 'HomeController@kapcsolatfelveteliKeres')->name('kapcsolatfelveteliKeres');
Route::get('/feltetelek', 'HomeController@feltetelek')->name('feltetelek');
Route::get('/adatkezelesi-szabalyok', 'HomeController@adatkezelesiSzabalyok')->name('adatkezelesiSzabalyok');

Route::group(['middleware' => 'ajanlo-oldalak'], static function () {
    Route::get('/ingatlanok', 'HomeController@realEstateList')->name('realEstatePublicList');
});

Route::prefix('ingatlanok')->group(function () {
    Route::get('/elado', 'HomeController@realEstateSalesList')->name('eladoIngatlanok');
    Route::get('/kiado', 'HomeController@realEstateRentalList')->name('kiadoIngatlanok');
    Route::get('/{realEstate}', 'HomeController@realEstatePublicDatapage')->name('realEstatePublicDatapage');
    Route::post('/kedvencnekjeloles', 'HomeController@realEstatePublicMarkasfavorite')->name('realEstatePublicMarkasfavorite');
});

Route::prefix('blog')->group(function () {
    Route::get('/', 'HomeController@PostList')->name('blog');
    Route::get('/{post}', 'HomeController@postPublicDatapage')->name('blogPost');
});

// regisztralt latogatoknak szolo route-ok
Route::group(['middleware' => 'verified'], static function () {
    Route::get('/profilom/{client}', 'HomeController@clientProfile')->name('clientProfile');
    Route::post('/profilom/{id}', 'HomeController@updateClientProfile')->name('updateClientProfile');
    Route::get('/elkepzeleseim', 'HomeController@myRequirements')->name('myRequirements');
    Route::put('/elkepzeleseim', 'HomeController@updateMyRequirements')->name('updateMyRequirements');
    Route::get('/thanksregister', 'HomeController@thanksRegister')->name('thanksregister');
    Route::get('/kedvencek', 'HomeController@kedvencek')->name('kedvencek');
});

// partner selector api
Route::get('/partner-selector-api', 'PartnerSelectorController@partnerQueryAjax')->name('partnerQueryAjax');

// location selector api
Route::get('/location-areas', 'LocationSelectorController@locationAreasQueryAjax')->name('locationAreasQueryAjax');
Route::get('/location-town-districts', 'LocationSelectorController@locationTownDistrictsQueryAjax')->name('locationTownDistrictsQueryAjax');
Route::get('/location-neighborhood', 'LocationSelectorController@locationTownNeighborhoodQueryAjax')->name('locationTownNeighborhoodQueryAjax');

// vedett oldalak az /admin route alatt
Route::group(['prefix' => 'admin',  'middleware' => 'admin', 'auth'], static function () {

    // admin kezdolap
    Route::get('/', static function () {
        return view('layouts.admin.defaultpage');
    })->name('admin');

    // szerkesztett nyelv valtas az adminban
    Route::get('editedlang/{locale}', 'LanguageController@changeEditedLanguage')->name('editedLanguage');

    Route::put('/specialOfferPages/up/{specialOfferPage}', 'SpecialOfferPageController@up')->name('specialOfferPageUp');
    Route::put('/specialOfferPages/down/{specialOfferPage}', 'SpecialOfferPageController@down')->name('specialOfferPageDown');

    /**
     * Az itt felsorolt route-ok CRUD routok.
     * https://laravel.com/docs/5.7/controllers#resource-controllers
     */
    Route::resources([
        'advertisingPartners' => 'AdvertisingPartnerController',
        'siteParameters' => 'SiteParameterController',
        'currencies' => 'CurrencyController',
        'realEstateTypes' => 'RealEstateTypeController',
        'locationAreas' => 'LocationAreaController',
        'locationTownDistricts' => 'LocationTownDistrictController',
        'locationNeighborhoods' => 'LocationNeighborhoodController',
        'modalEditPrototypes' => 'ModalEditController',
        'textContentPages' => 'TextContentPagesController',
        'posts' => 'PostController',
        'specialOfferPages' => 'SpecialOfferPageController',
    ]);

    Route::post('/posts/uploadimage', 'PostController@uploadImage')->name('posts.uploadimage');
    Route::post('/posts/eraseimage', 'PostController@eraseImage')->name('posts.eraseimage');

    Route::get('/clientsview/{client}', 'ClientViewController')->name('clients.view');

    Route::prefix('clients')->group(function () {
        Route::get('/', 'ClientController@index')->name('clients.index');
        Route::post('/', 'ClientController@store')->name('clients.store');
        Route::post('/tabledata', 'ClientController@tableDataLoader')->name('clients.tabledata');
        Route::get('/create', 'ClientController@create')->name('clients.create');
        Route::put('/{client}', 'ClientController@update')->name('clients.update');
        Route::post('/delete', 'ClientController@destroy')->name('clients.destroy');
        Route::get('/{client}/edit', 'ClientController@edit')->name('clients.edit');
        Route::get('/clearfilters', 'ClientController@clearFilters')->name('clients.clearFilters');
    });

    Route::prefix('clientRequirements')->group(function () {
        Route::get('/', 'ClientRequirementController@index')->name('clientRequirements.index');
        Route::post('/', 'ClientRequirementController@store')->name('clientRequirements.store');
        Route::get('/create', 'ClientRequirementController@create')->name('clientRequirements.create');
        Route::put('/{clientRequirement}', 'ClientRequirementController@update')->name('clientRequirements.update');
        Route::post('/delete', 'ClientRequirementController@destroy')->name('clientRequirements.destroy');
        Route::get('/{clientRequirement}/edit', 'ClientRequirementController@edit')->name('clientRequirements.edit');
    });

    Route::prefix('clientRole')->group(function () {
        Route::get('/', 'ClientRoleController@index')->name('clientRole.index');
        Route::post('/', 'ClientRoleController@store')->name('clientRole.store');
        Route::get('/create', 'ClientRoleController@create')->name('clientRole.create');
        Route::put('', 'ClientRoleController@update')->name('clientRole.update');
        Route::post('/delete', 'ClientRoleController@destroy')->name('clientRole.destroy');
        Route::get('/{clientRole}/edit', 'ClientRoleController@edit')->name('clientRole.edit');
    });

    Route::prefix('partners')->group(function () {
        Route::get('/', 'PartnerController@index')->name('partners.index');
        Route::post('/', 'PartnerController@store')->name('partners.store');
        Route::get('/create', 'PartnerController@create')->name('partners.create');
        Route::put('/{partner}', 'PartnerController@update')->name('partners.update');
        Route::post('/{partner}/delete', 'PartnerController@destroy')->name('partners.destroy');
        Route::get('/{partner}/edit', 'PartnerController@edit')->name('partners.edit');
        Route::get('/partnerRelationshipForm', 'PartnerController@clientRelationshipForm')->name('partners.relationship.form');
        Route::post('/partnerRelationshipAdd', 'PartnerController@clientRelationshipAdd')->name('partners.relationship.add');
        Route::get('/partnerRelationshipDelete/{clientId}', 'PartnerController@clientRelationshipDelete')->name('partners.relationship.delete');
    });
    Route::get('/partner-selector/{client_id}', 'PartnerSelectorController@partnerSelectorView')->name('partnerSelector');

    Route::prefix('realEstateOffers')->group(function () {
        Route::get('/', 'RealEstateOfferController@index')->name('realEstateOffers.index');
        Route::post('/', 'RealEstateOfferController@store')->name('realEstateOffers.store');
        Route::post('/tabledata', 'RealEstateOfferController@tableDataLoader')->name('realEstateOffers.tabledata');
        Route::post('/withClient', 'RealEstateOfferController@storeWithClient')->name('realEstateOffers.new.store');
        Route::get('/create', 'RealEstateOfferController@create')->name('realEstateOffers.create');
        Route::put('/{realEstateOffer}', 'RealEstateOfferController@update')->name('realEstateOffers.update');
        Route::post('/delete', 'RealEstateOfferController@destroy')->name('realEstateOffers.destroy');
        Route::get('/{realEstateOffer}/edit', 'RealEstateOfferController@edit')->name('realEstateOffers.edit');
        Route::post('/offerItemlist', 'RealEstateOfferController@offerItemList')->name('realEstateOffers.offerItemList');
        Route::post('/{realEstateOffer}/deleteitems', 'RealEstateOfferController@deleteItems')->name('realEstateOffers.deleteItems');
        Route::post('/{realEstateOffer}/additem', 'RealEstateOfferController@addItem')->name('realEstateOffers.addItem');
        Route::post('/createwithitems', 'RealEstateOfferController@createWithItems')->name('realEstateOffers.createWithItems');
        Route::get('/{realEstateOffer}/clone', 'RealEstateOfferController@clone')->name('realEstateOffers.clone');
        Route::get('/{realEstateOffer}/toroute', 'RealEstateOfferController@createRouteFromOffer')->name('realEstateOffers.createRouteFromOffer');
        Route::get('/{realEstateOffer}/{pdf}/printabledatapage', 'RealEstateOfferController@printableDatapage')->name('realEstateOffers.printableDatapage');
        // Route::get('/{realEstateOffer}/{pdf}/printabledatapageforpdfconversion', 'RealEstateOfferController@printableDatapageForPdfConversion')->name('realEstateOffers.printableDatapageForPdfConversion');
        Route::get('/{realEstateOffer}/{pdf}/temporaryurl', 'RealEstateOfferController@generateTemporaryUrl')->name('realEstateOffers.temporaryurl');
        Route::get('/{realEstateOffer}/sendmailpage', 'RealEstateOfferController@sendmailPage')->name('realEstateOffers.sendmailPage');
        Route::post('/{realEstateOffer}/sendmail', 'RealEstateOfferController@sendmail')->name('realEstateOffers.sendmail');
        Route::get('/clearfilters', 'RealEstateOfferController@clearFilters')->name('realEstateOffers.clearFilters');
        Route::post('/add/client', 'RealEstateOfferController@addClientToOffer')->name('realEstateOffers.addClient.toOffer');
    });

    Route::prefix('realEstates')->group(function () {
        Route::get('/', 'RealEstateController@index')->name('realEstates.index');
        Route::post('/', 'RealEstateController@store')->name('realEstates.store');
        Route::post('/tabledata', 'RealEstateController@tableDataLoader')->name('realEstates.tabledata');
        Route::get('/create', 'RealEstateController@create')->name('realEstates.create');
        Route::put('/{realEstate}', 'RealEstateController@update')->name('realEstates.update');
        Route::post('/delete', 'RealEstateController@destroy')->name('realEstates.destroy');
        Route::get('/{realEstate}/edit', 'RealEstateController@edit')->name('realEstates.edit');
        Route::get('/clone', 'RealEstateController@clone')->name('realEstates.clone');
        Route::get('/clearfilters', 'RealEstateController@clearFilters')->name('realEstates.clearFilters');
    });

    Route::prefix('realEstateRoutes')->group(function () {
        Route::post('/tabledata', 'RealEstateRouteController@tableDataLoader')->name('realEstateRoutes.tabledata');
        Route::get('/', 'RealEstateRouteController@index')->name('realEstateRoutes.index');
        Route::post('/delete', 'RealEstateRouteController@destroy')->name('realEstatesRoutes.destroy');
        Route::put('/{route}', 'RealEstateRouteController@update')->name('realEstateRoutes.update');
        Route::get('/{route}/edit', 'RealEstateRouteController@edit')->name('realEstateRoutes.edit');
        Route::get('/{route}/routeitemlist', 'RealEstateRouteController@routeItemList')->name('realEstateRoutes.routeItemList');
        Route::post('/{route}/deleteitems', 'RealEstateRouteController@deleteItems')->name('realEstateRoutes.deleteItems');
        Route::post('/{route}/additem', 'RealEstateRouteController@addItem')->name('realEstateRoutes.addItem');
        Route::post('/dragreorderitems', 'RealEstateRouteController@dragReorderItems')->name('realEstateRoutes.dragReorderItems');
        Route::post('/{route}/reindexitems', 'RealEstateRouteController@reindexItems')->name('realEstateRoutes.reindexItems');
        Route::get('/{route}/printabledatapage', 'RealEstateRouteController@printableDatapage')->name('realEstateRoutes.printableDatapage');
        // TODO: sztem ez már nem létezik:
        // Route::get('/{route}/printabledatapagerealestate', 'RealEstateRouteController@printableDatapageRealEstate')->name('realEstateRoutes.printableDatapageRealEstate');
        Route::get('/clearfilters', 'RealEstateRouteController@clearFilters')->name('realEstateRoutes.clearFilters');
        Route::get('/{route}/{pdf}/temporaryurl', 'RealEstateRouteController@generateTemporaryUrl')->name('realEstateRoutes.temporaryurl');
        Route::get('/{route}/sendmailpage', 'RealEstateRouteController@sendmailPage')->name('realEstateRoutes.sendmailPage');
        Route::post('/{route}/sendmail', 'RealEstateRouteController@sendmail')->name('realEstateRoutes.sendmail');
    });

    Route::get('/mnb', 'CurrencyController@mnbCurrencyQueryAjax')->name('mnbCurrencyQuery');

    Route::get('/mnb-queue', static function(){
        QueryMNBRatesJob::dispatch();
        return "MNB rate query job dispatched.";
    });

    Route::prefix('filemanager')->group(function () {
        Route::get('/', 'FileManagerController@index')->name('filemanagerIndex');
        Route::get('/loaditems', 'FileManagerController@loadItems')->name('filemanagerItems');
        Route::post('/upload', 'FileManagerController@upload')->name('filemanagerUpload');
        Route::post('/delete', 'FileManagerController@delete')->name('filemanagerDelete');
        Route::post('/setfeatured', 'FileManagerController@setFeatured')->name('filemanagerSetFeatured');
        Route::post('/dragreorder', 'FileManagerController@dragReorder')->name('filemanagerDragReorder');
        Route::post('/reorder', 'FileManagerController@reorder')->name('filemanagerReorder');
        Route::post('/changeView', 'FileManagerController@changeView')->name('filemanagerChangeView');
        Route::get('/download', 'FileManagerController@download')->name('filemanagerDownload')->middleware('role:administrators|sales-sr|sales-jr');
        Route::get('/selectcontract', 'RealEstateController@selectContract')->name('realEstates.selectContract');
        Route::post('/clearcontract', 'RealEstateController@clearContract')->name('realEstates.clearContract');
    });

    // A profile route kulonleges: alapbol nyilvanos, de mindenki csak a sajatjat lathatja.
    Route::group(['middleware' => 'userprofile'], static function () {
        Route::get('profile/{user}', 'AdminUserController@userProfile')->name('userProfile');
        Route::put('profile/{user}', 'AdminUserController@update')->name('updateUserProfile');
    });
    Route::get('/changePassword','AdminUserController@showChangePasswordForm');
    Route::post('/changePassword','AdminUserController@changePassword')->name('changePassword');

    Route::group(['middleware' => ['role:developers']], static function () {
        Route::resources([
            'roles' => 'RoleController',
        ]);
    });

    Route::group(['middleware' => ['role:developers|administrators']], static function () {
        Route::resources([
            'adminusers' => 'AdminUserController',
            'clientusers' => 'ClientUserController',
        ]);
    });

});
