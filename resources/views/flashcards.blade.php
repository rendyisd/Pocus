@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center main-text-big mb-4 fs-1">
        Flashcards
    </h1>
    <div class="row mb-3 card-click-animation" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addCardSet">
        <div class="col d-flex flex-column justify-content-center text-center text-white card-set" id="createSet">
            <h4 class="fw-bold m-0 mb-2">+</h4>
            <h5 class="fw-bold m-0">Create Set</h5>
        </div>
    </div>

    {{-- CREATE SET MODAL --}}
    <div class="modal fade" id="addCardSet" tabindex="-1" aria-labelledby="addCardSetLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addCardSetLabel">Create new card set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <label for="setName" class="form-label fw-bold">Name</label>
                        <input type="text" id="setName" class="form-control" aria-describedby="setNameHelp" maxlength="16">
                        <div id="setNameHelp" class="form-text">
                            Must not exceed 16 characters and must not contain special characters or emoji.
                        </div>
                        <br>
                        <label for="setDesc" class="form-label fw-bold">Description</label>
                        <input type="text" id="setDesc" class="form-control" aria-describedby="setDescHelp" maxlength="50">
                        <div id="setDescHelp" class="form-text">
                            Must not exceed 50 characters.
                        </div>
                        <br>
                        <label for="setCat" class="form-label fw-bold">Category</label>
                        <button type="button" class="btn btn-light w-100" id="selectCat" style="box-shadow: 0 0 2px black; border-left: 15px solid limegreen;">
                            <div class="d-inline-block">Language</div>
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="createSetBtn">Create Set</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CREATE SET MODAL --}}

    <div class="row mb-3 card-click-animation" style="cursor: pointer;">
        <div class="col d-flex flex-column justify-content-center bg-light card-set flashcard-set">
            <div class="row">
                <div class="col-9">
                    <h4 class="fw-bold m-0">English</h4>
                    <p class="m-0 flashcard-set-desc mb-1">This is a description of this set</p>
                    <div class="d-inline-block rounded-pill px-3 flashcard-set-tag">Language</div>
                </div>
                <div class="col-3 m-auto d-flex justify-content-end">
                    <h4 class="fw-bold m-0">45</h4>
                    <img src="{{ asset('images/home-images/card-black.svg') }}" style="height: 30px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @vite([
        'resources/css/coloris.min.css',
        'resources/js/coloris.min.js',
        'resources/js/flashcards.js'
    ])
@endsection