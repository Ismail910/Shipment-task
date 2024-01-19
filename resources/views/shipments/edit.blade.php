@extends('layouts.app')

@section('content')

<div id="app">


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
                        <div class="card-header bg-primary text-white">Edit a Shipment</div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{  route('shipments.update', $shipment->id)}}"
                                enctype="multipart/form-data">
                                @csrf
                              
                                @method('PUT')
                              
                                <div class="mb-3">
                                    <label for="shipper" class="form-label">Shipper</label>
                                    <input type="text" class="form-control" id="shipper" name="shipper"
                                        value="{{ old('shipper', $shipment->shipper ?? '') }}"
                                        placeholder="Enter shipper's name" required>

                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight (kg)</label>
                                    <input type="number" class="form-control" id="weight" name="weight"
                                        value="{{ old('weight', $shipment->weight ?? '') }}" placeholder="Enter weight"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Describe the shipment">{{ old('description', $shipment->description ?? '') }}</textarea>
                                </div>


                                <button type="submit" class="btn btn-success">Create Shipment</button>
                            </form>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </main>
</div>
</body>

@endsection

