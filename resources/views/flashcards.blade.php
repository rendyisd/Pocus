@extends('layouts.app')

@section('scripts')
    @vite([
        'resources/css/coloris.min.css',
        'resources/js/coloris.min.js',
        'resources/js/flashcards.js'
    ])
@endsection

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
        {{-- Success alerts --}}
        <div class="alert alert-success d-flex align-items-center position-absolute abs-center fade" id="addCatSuccess" role="alert" style="width: 330px">
            <i class="fa-solid fa-square-check fs-3 me-2"></i>
            <div>
                Category has been created successfully
            </div>
        </div>
        

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="">
            <div class="modal-content">
                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="fc-create-set modal-title fw-bold" id="addCardSetLabel">Create new card set</h5>
                    <h5 class="fc-select-cat modal-title fw-bold d-none" id="addCardSetLabel">Select category</h5>
                    <h5 class="fc-create-cat modal-title fw-bold d-none" id="addCardSetLabel">Create category</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- BODY --}}
                <div class="fc-create-set modal-body">

                    <form action="" method="post">
                        @csrf
                        <label for="setName" class="form-label fw-bold">Name</label>
                        <input type="text" id="setName" class="form-control" aria-describedby="setNameHelp" maxlength="16" autocomplete="off">
                        <div id="setNameHelp" class="form-text">
                            Must not exceed 16 characters and must not contain special characters or emoji.
                        </div>
                        <br>
                        <label for="setDesc" class="form-label fw-bold">Description</label>
                        <input type="text" id="setDesc" class="form-control" aria-describedby="setDescHelp" maxlength="50" autocomplete="off">
                        <div id="setDescHelp" class="form-text">
                            Must not exceed 50 characters.
                        </div>
                        <br>
                        <label for="setCat" class="form-label fw-bold">Category</label>
                        <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" id="selectCat" style="border-left: 13px solid limegreen;">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-inline-block fw-bold flex-grow-1">Lorem</div>
                                <i class="fa-solid fa-angle-right my-auto"></i>
                            </div>
                        </button>
                    </form>

                </div>

                <div class="fc-select-cat modal-body d-none">

                    <button type="button" class="btn text-white w-100 mb-3 card-create-cat card-click-animation" id="addCat">
                        <h6 class="fw-bold m-0">+</h6>
                        <h6 class="fw-bold m-0">Create Category</h6>
                    </button>

                    @foreach ($fcCategory as $category)
                        <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" style="border-left: 13px solid {{ $category->color }};">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-inline-block fw-bold flex-grow-1">{{ $category->category }}</div>
                                <i class="fa-solid fa-angle-right my-auto"></i>
                            </div>
                        </button>
                    @endforeach

                </div>

                <div class="fc-create-cat coloris-parent modal-body d-none">
                    <form action="{{ route('createCategorySubmit') }}" method="post" id="addCategoryForm">
                        @csrf
                        <label for="setCategoryName" class="form-label fw-bold">Category</label>
                        <input type="text" id="setCategoryName" class="form-control" maxlength="16" autocomplete="off" name="categoryName">
                        <br>
                        <label for="setCategoryColor" class="form-label fw-bold">Color</label><br>
                        <input type="text" id="setCategoryColor" data-coloris autocomplete="off" name="categoryColor">
                    </form>
                </div>

                {{-- FOOTER --}}
                <div class="fc-create-set modal-footer">
                    <button type="button" class="btn btn-success" id="createSetBtn">Create</button>
                </div>

                <div class="fc-select-cat modal-footer d-none">
                    <button type="button" class="btn btn-danger me-auto backBtn">Back</button>
                </div>

                <div class="fc-create-cat modal-footer d-none">
                    <button type="button" class="btn btn-danger me-auto backBtn">Back</button>
                    <button type="submit" form="addCategoryForm" class="btn btn-success" id="createCategoryBtn">Create</button>
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

