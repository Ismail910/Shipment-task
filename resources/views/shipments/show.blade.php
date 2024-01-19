@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Shipment Data -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Shipment Details
        </div>
        <div class="card-body">
            @if($shipment->image)
                <div class="text-center mb-3">
                    <img src="{{ Storage::url($shipment->image) }}" alt="Shipment Image" class="img-fluid rounded shipment-image w-25">
                </div>
            @endif
            <h5 class="card-title">Code: {{ $shipment->code }}</h5>
            <p class="card-text">Shipper: {{ $shipment->shipper }}</p>
            <p class="card-text">Weight: {{ $shipment->weight }} kg</p>
            <p class="card-text">Description: {{ $shipment->description }}</p>
            <p class="card-text">Status: {{ $shipment->status }}</p>
            <p class="card-text">Price: ${{ $shipment->price }}</p>
          
        </div>
    </div>

    <!-- JournalEntity Data -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Journal Entities
        </div>
        <ul class="list-group list-group-flush">
            @forelse($shipment->journalEntities as $journalEntity)
                <li class="list-group-item">
                    Amount: {{ $journalEntity->amount }} - Type: {{ $journalEntity->type }}
                </li>
            @empty
                <li class="list-group-item">No journal entities found for this shipment.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@push('style')
<style>
    .card-header {
        font-size: 1.25rem;
    }

    .card-title {
        font-weight: bold;
    }

    .list-group-item {
        background-color: #f8f9fa; /* Light gray background for list items */
    }

    .shipment-image {
        max-width: 100%;
        height: auto;
        border-radius: 0.25rem; /* Optional: for rounded corners */
    }
</style>
@endpush

@push('script')
<!-- Any additional scripts can be added here -->
@endpush
