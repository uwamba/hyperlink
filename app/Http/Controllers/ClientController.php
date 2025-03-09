<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:15',
            'company_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        $client = Client::create($request->all());

        return new ClientResource($client);
    }

    public function show($id)
    {
        return new ClientResource(Client::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'company_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return new ClientResource($client);
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
