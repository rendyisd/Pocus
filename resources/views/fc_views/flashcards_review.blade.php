@extends('layouts.app')

@section('scripts')
    @vite([
        'resources/js/flashcards_review.js'
    ])
@endsection

@section('content')
<div class="container review-container py-2">
    <div class="row h-50">
        <div class="col d-flex justify-content-center align-items-center">
            <div class="container-md text-center fs-4 question-container fw-bold">
                Question
            </div>
        </div>
    </div>
    <div class="row h-50">
        <div class="col">
            <div class="row h-100">
                <div class="col-md-6 order-1 order-md-1 p-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="w-100 h-100 choice-container card-click-animation">
                        Choice 1
                    </button>
                </div>
                <div class="col-md-6 order-2 order-md-2 p-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="w-100 h-100 choice-container card-click-animation">
                        Choice 2
                    </button>
                </div>
                <div class="col-md-6 order-3 order-md-3 p-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="w-100 h-100 choice-container card-click-animation">
                        Choice 3
                    </button>
                </div>
                <div class="col-md-6 order-4 order-md-4 p-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="w-100 h-100 choice-container card-click-animation">
                        Choice 4
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <button type="button" class="btn btn-primary d-none" id="openFinishModal" data-bs-toggle="modal" data-bs-target="#finishModal">
        BOOTSTRAP JS WONT WORK FFS
    </button>

    <div class="modal" tabindex="-1" id="finishModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold mx-auto">Review Result</h5>
                </div>
                <div class="modal-body">
                    <h2 class="text-center fw-bold m-0">
                        <span style="color: limegreen;" id="numOfCorrect">NA</span> / <span class="text-primary">{{ count($eachCards) }}</span>
                    </h2>
                </div>
                <div class="modal-footer">
                    <h6 class="mx-auto">Click anywhere to go back.</h6>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
    var cards = {!! $eachCards !!};
    var backUrl = "{{ route('flashcards.show', ['flashcard' => $eachCards[0]->set_id]) }}";
</script>