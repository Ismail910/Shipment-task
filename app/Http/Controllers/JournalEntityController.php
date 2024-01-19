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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJournalEntityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JournalEntity $journalEntity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JournalEntity $journalEntity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalEntityRequest $request, JournalEntity $journalEntity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JournalEntity $journalEntity)
    {
        //
    }
}
