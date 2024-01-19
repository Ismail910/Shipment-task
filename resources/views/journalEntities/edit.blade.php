<div class="modal-dialog">
    <div class="modal-content">


        <form action="{{ route('journal-entities.update', $journalEntity->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Journal Entity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="shipment_id" name="shipment_id" value="{{ $journalEntity->shipment_id }}">

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount"
                        value="{{ old('amount', $journalEntity->amount) }}" min="1" required>
                    @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="Debit Cash" {{ $journalEntity->type == 'Debit Cash' ? 'selected' : '' }}>Debit
                            Cash</option>
                        <option value="Credit Revenue" {{ $journalEntity->type == 'Credit Revenue' ? 'selected' : ''
                            }}>Credit Revenue</option>
                        <option value="Credit Payable" {{ $journalEntity->type == 'Credit Payable' ? 'selected' : ''
                            }}>Credit Payable</option>
                    </select>
                    @error('type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>