@extends('layouts.app')

@section('content')

<div id="app">


    <!-- Flash Messages -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif




    <main class="py-4">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Create New Shipment</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('shipments.store') }}" enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label for="shipper" class="form-label">Shipper</label>
                                    <input type="text" class="form-control" id="shipper" name="shipper"
                                        placeholder="Enter shipper's name" required>
                                </div>


                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>


                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight (kg)</label>
                                    <input type="number" class="form-control" id="weight" name="weight"
                                        placeholder="Enter weight" required>
                                </div>

                                <!-- Description Textarea -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Describe the shipment"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Create Shipment</button>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="list-group">
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if($shipments->isEmpty())
                        <div class="alert alert-warning">No shipments found.</div>
                        @else
                        @foreach ($shipments as $shipment)
                        <div class="shipment-card"
                            style="{{ $shipment->image ? 'background-image: url('.Storage::url($shipment->image).'); background-size: cover; background-repeat: no-repeat;' : '' }}">

                            <div class="shipment-details">
                                <h5 class="mb-1">{{ $shipment->code }}</h5>
                                <small class="text-muted">Shipper: {{ $shipment->shipper }}</small><br>
                                <small class="text-muted">Price: {{ $shipment->price }}</small><br>
                                <small class="text-muted">Status: {{ $shipment->status }}</small>
                            </div>

                            <div class="shipment-actions">
                                <a href="{{ route('shipments.show', $shipment->id) }}" title="Show">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('shipments.edit', $shipment->id) }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="return confirmDelete({{ $shipment->id }});" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="delete-form-{{ $shipment->id }}"
                                    action="{{ route('shipments.destroy', $shipment->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                        @endforeach



                        @endif

                    </div>
                    <div class="col-md-12">
                        {{ $shipments->links() }} <!-- This will display pagination links -->
                    </div>

                </div>


            </div>
        </div>
    </main>
</div>
</body>

@endsection


@push('style')
<style>
    .shipment-card {
        position: relative;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        /* Space between cards */
        color: #333;
        /* Text color */
        transition: all 0.3s ease;
    }

    .shipment-details {
        background: rgba(255, 255, 255, 0.8);
        /* Semi-transparent background for legibility */
        border-radius: 5px;
        padding: 10px;
    }

    .shipment-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        display: none;
        /* Hide by default */
    }

    .shipment-card:hover .shipment-actions {
        display: block;
        /* Show on hover */
    }

    .shipment-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Optional: add shadow on hover for effect */
    }
</style>
@endpush

@push('script')
<script type="text/javascript">
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this shipment?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
        } else {
            return false;
        }
    }
</script>

@endpush