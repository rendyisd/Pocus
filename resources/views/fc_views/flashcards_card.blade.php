@extends('layouts.app')

@section('scripts')
    @vite([
        'resources/css/coloris.min.css',
        'resources/js/coloris.min.js',
        'resources/js/flashcards.js'
    ])
@endsection

@section('content')
<a href="{{ route('flashcards.review', ['fc' => $flashcard->id]) }}" class="btn preview-btn btn-primary btn-lg position-fixed bottom-0 end-0 mb-4 me-4 px-4
    @if($flashcard->flashcards_cards()->count() < 5) disabled @endif
">
    <i class="fa-solid fa-graduation-cap"></i>
    <span class="fw-bold">Review</span>
</a>
<div class="container fc-card-container">
    <h1 class="text-center main-text-big mb-4 fs-1">
        {{ $flashcard->name }}
    </h1>
    {{-- Success alert --}}
    <div class="alert alert-success d-flex align-items-center position-absolute position-fixed top-0 fade abs-center" id="addCardSuccess" role="alert" style="z-index: 9999;">
        <i class="fa-solid fa-square-check fs-3 me-2"></i>
        <div id="successMessageText">
            Success!
        </div>
    </div>

    {{-- Error alerts --}}
    <div class="alert alert-danger d-flex align-items-center position-absolute position-fixed top-0 fade abs-center" id="addCardError" role="alert" style="z-index: 9998;">
        <i class="fa-solid fa-triangle-exclamation fs-3 me-2"></i>
        <div id="errorMessageText">
            Error!
        </div>
    </div>

    <div class="row mb-3 card-click-animation" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addCards">
        <div class="col d-flex flex-column justify-content-center text-center text-white card-set" id="createSet">
            <h4 class="fw-bold m-0 mb-2">+</h4>
            <h5 class="fw-bold m-0">Add Cards</h5>
        </div>
    </div>

    <div class="modal fade" id="addCards" tabindex="-1" aria-labelledby="addCardsLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title fw-bold fade-element" id="addCardsLabel">
                        Add a new card
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalBtn"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body fade-element">

                    <form action="{{ route('createCardSubmit') }}" method="post" id="addCardForm">
                        @csrf
                        <label for="setTerm" class="form-label fw-bold">Term - Front Side</label>
                        <textarea id="setTerm" class="form-control add-card-textarea" aria-describedby="setTermHelp" maxlength="255" autocomplete="off" name="setTerm"></textarea>
                        <div id="setTermHelp" class="form-text">
                            Max. 255 characters
                        </div>

                        <br>
                        
                        <label for="setDefinition" class="form-label fw-bold">Definition - Back Side</label>
                        <textarea id="setDefinition" class="form-control add-card-textarea" aria-describedby="setDefinitionHelp" maxlength="255" autocomplete="off" name="setDefinition"></textarea>
                        <div id="setDefinitionHelp" class="form-text">
                            Max. 255 characters
                        </div>

                        <input type="hidden" id="setSetId" name="setSetId" value="{{ $flashcard->id }}">
                        <input type="hidden" id="setCardColor" name="setCardColor" value="{{ $category->color }}">
                    </form>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer fade-element">
                    <button type="submit" form="addCardForm" class="btn btn-success" id="addCardBtn">Add</button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($cards as $card)

        <div class="row mb-3 bg-light card-click-animation flashcards-card" style="border-left: 13px solid {{ $category->color }};">
            <div class="col d-grid gap-2 py-2">
                <p class="fw-bold m-0">
                    {{ $card->term }}
                </p>
                <p class="m-0 flashcard-set-desc">
                    {{ $card->definition }}
                </p>
            </div>
        </div>

    @endforeach
</div>
@endsection