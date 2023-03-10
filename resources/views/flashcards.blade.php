@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3 card-click-animation" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addCardSet">
        <div class="col d-flex flex-column justify-content-center text-center text-white card-set" id="createSet">
            <h4 class="fw-bold m-0 mb-2">+</h4>
            <h5 class="fw-bold m-0">Create Set</h5>
        </div>
    </div>

    {{-- MODALS --}}
    <div class="modal fade" id="addCardSet" tabindex="-1" aria-labelledby="addCardSetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addCardSetLabel">Create new card set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODALS --}}

    <div class="row mb-3 card-click-animation" style="cursor: pointer;">
        <div class="col d-flex flex-column justify-content-center bg-light card-set flashcard-set">
            <div class="row">
                <div class="col-9">
                    <h4 class="fw-bold m-0">English</h4>
                    <p class="m-0 flashcard-set-desc mb-1">This is a description of this set</p>
                    <div class="d-inline-block rounded-pill px-3 flashcard-set-tag">Language</div>
                </div>
                <div class="col-3 m-auto d-flex justify-content-end">
                    <h4 class="fw-bold m-0">45/45</h4>
                    <img src="{{ asset('images/home-images/card-black.svg') }}" style="height: 30px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection