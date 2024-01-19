@extends('layouts.app')

@section('content')
<div class="container mt-4">

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
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Shipment Details
        </div>
        <div class="card-body">
            @if($shipment->image)
            <div class="text-center mb-3">
                <img src="{{ Storage::url($shipment->image) }}" alt="Shipment Image"
                    class="img-fluid rounded shipment-image w-25">
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



    <div class="card mt-4">
    <div class="card-header bg-secondary text-white">
            Journal Entities
            <button type="button" class="btn btn-success mt-2 mx-2=" data-bs-toggle="modal"
            data-bs-target="#addJournalEntityModal">
            Add Journal Entity
        </button>
        </div>

        <ul class="list-group list-group-flush">
            @forelse($shipment->journalEntities as $journalEntity)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    Amount: {{ $journalEntity->amount }} - Type: {{ $journalEntity->type }}
                </span>
                <span>


                    <button type="button" class="btn btn-info btn-sm"
                        onclick="showJournalEntity({{ $journalEntity->id }})">Show</button>


                    <button type="button" class="btn btn-primary btn-sm"
                        onclick="editJournalEntity({{ $journalEntity->id }})">Edit</button>

                    <form action="{{ route('journal-entities.destroy', $journalEntity->id) }}" method="POST"
                        onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </span>
            </li>
            @empty
            <li class="list-group-item">No journal entities found for this shipment.</li>
            @endforelse
        </ul>
    </div>
</div>





<!-- Add Journal Entity Modal -->
<div class="modal fade" id="addJournalEntityModal" tabindex="-1" aria-labelledby="addJournalEntityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJournalEntityModalLabel">Add Journal Entity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('journal-entities.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">
                    <!-- Other form fields for JournalEntity -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="Debit Cash">Debit Cash</option>
                            <option value="Credit Revenue">Credit Revenue</option>
                            <option value="Credit Payable">Credit Payable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Journal Entity</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editJournalEntityModal" tabindex="-1" aria-labelledby="editJournalEntityModalLabel"
    aria-hidden="true">


</div>

<div class="modal fade" id="showJournalEntityModal" tabindex="-1" aria-labelledby="showJournalEntityModalLabel"
    aria-hidden="true">
   
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
        background-color: #f8f9fa;
        /* Light gray background for list items */
    }

    .shipment-image {
        max-width: 100%;
        height: auto;
        border-radius: 0.25rem;
        /* Optional: for rounded corners */
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* Add any additional styling */
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .card-header button {
            margin-top: 10px; /* Adjust as needed */
        }
    }
</style>
@endpush

@push('script')
<script>
    function editJournalEntity(id) {
        fetch(`/journal-entities/${id}/edit`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('editJournalEntityModal').innerHTML = html;
                let editModal = new bootstrap.Modal(document.getElementById('editJournalEntityModal'));
                editModal.show();

                let form = document.getElementById('editJournalEntityModal').querySelector('form');
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    let formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html',
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(text);
                                });
                            }
                            return response.text();
                        })
                        .then(html => {
                            editModal.hide();
                            location.reload();
                        })
                        .catch(error => {
                            document.getElementById('editJournalEntityModal').innerHTML = error.message;
                            editModal.show();
                        });
                });
            });
    }

    function showJournalEntity(id) {
        fetch(`/journal-entities/${id}/show`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('showJournalEntityModal').innerHTML = html;
                new bootstrap.Modal(document.getElementById('showJournalEntityModal')).show();
            })
            .catch(error => console.error('Error:', error));
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this journal entity?');
    }


</script>

@endpush