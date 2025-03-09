<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return InvoiceResource::collection(Invoice::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $invoice = Invoice::create($request->all());

        return new InvoiceResource($invoice);
    }

    public function show($id)
    {
        return new InvoiceResource(Invoice::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return new InvoiceResource($invoice);
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
