<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Enum\ClientPreferredContactEnum;
use App\Models\Partner;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PartnerController
 * @package App\Http\Controllers
 */
class PartnerController extends Controller
{
    /**
     * List partners
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $partners = Partner::all();
        return view('Partner.view', [
            'partners' => $partners,
        ]);
    }

    /**
     * Partner create view
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $partner = new Partner();

        return view('Partner.datapage.create', [
            'partner' => $partner,
            'preferredContacts' => ClientPreferredContactEnum::toSelectValueSet([ old('preferred_contact_enum', $partner->preferred_contact_enum) ]),
        ]);
    }

    /**
     * Create a new partner
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $partner = new Partner();
        $partner->partner_name = $request->partner_name;
        $partner->preferred_contact_enum = $request->preferred_contact_enum;
        $partner->contact_name = $request->contact_name;
        $partner->contact_email = $request->contact_email;
        $partner->contact_phone_1 = $request->contact_phone_1;
        $partner->contact_phone_2 = $request->contact_phone_2;
        $partner->save();

        return redirect(route('partners.edit', [$partner->id]));
    }

    /**
     * Edit partner data
     *
     * @param Partner $partner
     * @return Application|Factory|View
     */
    public function edit(Request $request, Partner $partner)
    {
        return view('Partner.datapage.edit', [
            'partner' => $partner,
            'currentRoute' => $request->currentRoute,
            'client_id' => $request->client_id,
            'preferredContacts' => ClientPreferredContactEnum::toSelectValueSet([ old('preferred_contact_enum', $partner->preferred_contact_enum) ]),
        ]);
    }

    /**
     * Update partner data
     *
     * @param Request $request
     * @param Partner $partner
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Partner $partner)
    {
        $partner->partner_name = $request->partner_name;
        $partner->preferred_contact_enum = $request->preferred_contact_enum;
        $partner->contact_name = $request->contact_name;
        $partner->contact_email = $request->contact_email;
        $partner->contact_phone_1 = $request->contact_phone_1;
        $partner->contact_phone_2 = $request->contact_phone_2;
        $partner->push();

        if($request->currentRoute == "clients.view"){
            return redirect(route($request->currentRoute, ['id' => $request->client_id]));
        }
        return redirect(route('partners.index'));
    }

    /**
     * Delete partner
     *
     * @param Partner $partner
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect(route('partners.index'));
    }

    /**
     *  Setting selected partner to the client
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function clientRelationshipAdd (Request $request): RedirectResponse
    {
        $partner = Partner:: find($request->partner_id);
        $client = Client::findOrFail($request->client_id);

        $client->partner_id = $partner->id;
        $client->save();

        return redirect()->route('clients.view', [$client->id]);
    }

    /**
     * Delete client partner relationship
     *
     * @param integer $clientId The id of client where we want delete partner relationship
     * @return RedirectResponse
     */
    public function clientRelationshipDelete (int $clientId): RedirectResponse
    {
        $client = Client::find($clientId);
        $client->partner_id = null;
        $client->save();
        return redirect()->back();
    }
}
