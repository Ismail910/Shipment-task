<!-- Add custom classes for styling -->
<div class="modal-dialog">
    <div class="modal-content journal-entity-modal">
        <div class="modal-header journal-entity-modal-header">
            <h5 class="modal-title">Journal Entity Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body journal-entity-modal-body">
            <p class="journal-entity-detail"><strong>Amount:</strong> ${{ number_format($journalEntity->amount, 2) }}</p>
            <p class="journal-entity-detail"><strong>Type:</strong> {{ $journalEntity->type }}</p>
            <!-- Add more fields if needed -->
        </div>
    </div>
</div>


<style>
   

    .journal-entity-modal-header {
        background-color: #0056b3; 
        color: white;
    }

    .journal-entity-modal-body {
        padding: 20px;
    }

    .journal-entity-detail {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .journal-entity-modal-body {
            padding: 10px;
        }
    }
</style>
