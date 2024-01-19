<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\ImageUploadService;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //
    public function index()
    {
        try {
            $shipments = Shipment::paginate(10);

            if ($shipments->isEmpty()) {

                return view('shipments.index', compact('shipments'))
                    ->with('error', 'No shipments found.');
            }

            return view('shipments.index', compact('shipments'));
        } catch (\Exception $e) {

            return view('shipments.index', ['shipments' => collect()])
                ->with('error', 'Failed to fetch shipments.');
        }
    }




    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreShipmentRequest $request, ImageUploadService $uploadService)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $uploadService->uploadImage($request->file('image'), 'shipments');
            }

            Shipment::create($data);

            return redirect()->route('shipments.index')->with('success', 'Shipment created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('shipments.index')->with('error', 'Failed to store shipment.');
        }
    }

    /**
     * Display the specified resource.
     */


    public function show(Shipment $shipment)
    {
        try {
            $shipment->load('journalEntities');

            return view('shipments.show', compact('shipment'));

        } catch (ModelNotFoundException $e) {
            return redirect()->route('shipments.index')->with('error', 'Shipment not found.');
        } catch (\Exception $e) {
            return redirect()->route('shipments.index')->with('error', 'Failed to retrieve shipment details.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }



    /**
     * Update the specified resource in storage.
     */


    public function update(UpdateShipmentRequest $request, Shipment $shipment, ImageUploadService $uploadService)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $uploadService->uploadImage($request->file('image'), 'shipments');
            }

            $shipment->fill($data);
            $shipment->setPriceBasedOnWeight();
            $shipment->save();

            return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('shipments.index')->with('error', 'Failed to update shipment.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        try {
            $shipment->delete();
            return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('shipments.index')->with('error', 'Error occurred while deleting the shipment.');
        }
    }

}
