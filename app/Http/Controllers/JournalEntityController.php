<?php

namespace App\Http\Controllers;

use App\Models\JournalEntity;
use App\Http\Requests\StoreJournalEntityRequest;
use App\Http\Requests\UpdateJournalEntityRequest;
use App\Models\Shipment;

class JournalEntityController extends Controller
{
   
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJournalEntityRequest $request)
    {
        try {
            JournalEntity::create($request->validated());
            return redirect()->back()->with('success', 'Journal Entity created successfully.');
        } catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Failed to create Journal Entity.');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(JournalEntity $journalEntity)
    {
        try {
            return view('journalEntities.show', compact('journalEntity'))->render();
        } catch (\Exception $e) {   
            return response()->json(['error' => 'Failed to fetch Journal Entity.'], 500);
        }
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JournalEntity $journalEntity)
    {
        return view('journalEntities.edit', compact('journalEntity'))->render();
    }
    
   
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalEntityRequest $request, JournalEntity $journalEntity)
    {
        try {
            $journalEntity->update($request->validated());
            return redirect()->back()->with('success', 'Journal Entity updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update Journal Entity.']);
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JournalEntity $journalEntity)
    {
        try {
            $journalEntity->delete();
            return redirect()->back()->with('success', 'Journal Entity deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Journal Entity.');
        }
    }
    
}
