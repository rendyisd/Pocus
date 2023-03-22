@extends('layouts.app')

@section('scripts')
    @vite([
        'resources/css/coloris.min.css',
        'resources/js/coloris.min.js',
        'resources/js/flashcards.js'
    ])
@endsection

@section('content')
<div class="container flashcards-sets-container">
    <h1 class="text-center main-text-big mb-4 fs-1">
        Flashcards
    </h1>
    <div class="row mb-3 card-click-animation" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addCardSet">
        <div class="col d-flex flex-column justify-content-center text-center text-white card-set" id="createSet">
            <h4 class="fw-bold m-0 mb-2">+</h4>
            <h5 class="fw-bold m-0">Create Set</h5>
        </div>
    </div>

    {{-- Success alerts --}}
    <div class="alert alert-success d-flex align-items-center position-absolute position-fixed top-0 fade abs-center" id="addCatSuccess" role="alert" style="z-index: 9999;">
        <i class="fa-solid fa-square-check fs-3 me-2"></i>
        <div id="successMessageText">
            Success!
        </div>
    </div>

    {{-- Error alerts --}}
    <div class="alert alert-danger d-flex align-items-center position-absolute position-fixed top-0 fade abs-center" id="addCatError" role="alert" style="z-index: 9998;">
        <i class="fa-solid fa-triangle-exclamation fs-3 me-2"></i>
        <div id="errorMessageText">
            Error!
        </div>
    </div>

    {{-- CREATE SET MODAL --}}
    <div class="modal fade coloris-parent" id="addCardSet" tabindex="-1" aria-labelledby="addCardSetLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="fc-create-set modal-title fw-bold fade-element" id="addCardSetLabel">Create new card set</h5>
                    <h5 class="fc-select-cat modal-title fw-bold d-none fade-element hidden-fade" id="addCardSetLabel">Select category</h5>
                    <h5 class="fc-create-cat modal-title fw-bold d-none fade-element hidden-fade" id="addCardSetLabel">Create category</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalBtn"></button>
                </div>

                {{-- BODY --}}
                <div class="fc-create-set modal-body fade-element">

                    <form action="{{ route('createSetSubmit') }}" method="post" id="addSetForm">
                        @csrf
                        <label for="setName" class="form-label fw-bold">Name</label>
                        <input type="text" id="setName" class="form-control" aria-describedby="setNameHelp" maxlength="16" autocomplete="off" name="setName">
                        <div id="setNameHelp" class="form-text">
                            Must not exceed 16 characters and must not contain special characters or emoji.
                        </div>

                        <br>
                        
                        <label for="setDesc" class="form-label fw-bold">Description</label>
                        <input type="text" id="setDesc" class="form-control" aria-describedby="setDescHelp" maxlength="50" autocomplete="off" name="setDesc">
                        <div id="setDescHelp" class="form-text">
                            This field is <span class="fw-bold">optional</span>. Must not exceed 50 characters.
                        </div>

                        <br>

                        <label for="setCat" class="form-label fw-bold">Category</label>
                        <input type="hidden" id="setCat" name="setCat">
                        <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" id="selectCat" style="border-left: 13px solid black;">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-inline-block fw-bold flex-grow-1">Select category</div>
                                <i class="fa-solid fa-angle-right my-auto"></i>
                            </div>
                        </button>
                    </form>

                </div>

                <div class="fc-select-cat modal-body d-none fade-element hidden-fade">

                    <button type="button" class="btn text-white w-100 mb-3 card-create-cat card-click-animation" id="addCat">
                        <h6 class="fw-bold m-0">+</h6>
                        <h6 class="fw-bold m-0">Create Category</h6>
                    </button>

                    @foreach ($fcCategory as $category)
                        <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" style="border-left: 13px solid {{ $category->color }};" data-categoryId="{{ $category->id }}">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-inline-block fw-bold flex-grow-1 category-name">{{ $category->category }}</div>
                                <i class="fa-solid fa-angle-right my-auto"></i>
                            </div>
                        </button>
                    @endforeach

                </div>

                <div class="fc-create-cat modal-body d-none fade-element hidden-fade">
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
                <div class="fc-create-set modal-footer fade-element">
                    <button type="submit" form="addSetForm" class="btn btn-success" id="createSetBtn">Create</button>
                </div>

                <div class="fc-select-cat modal-footer d-none fade-element hidden-fade">
                    <button type="button" class="btn btn-danger me-auto backBtn" id="oneOfBackBtn">Back</button>
                </div>

                <div class="fc-create-cat modal-footer d-none fade-element hidden-fade">
                    <button type="button" class="btn btn-danger me-auto backBtn">Back</button>
                    <button type="submit" form="addCategoryForm" class="btn btn-success" id="createCategoryBtn">Create</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CREATE SET MODAL --}}

    @foreach ($flashcards as $flashcard)
        <a href="{{ route('flashcards.show', ['flashcard' => $flashcard->id]) }}" class="flashcard-open-url">
            <div class="row mb-3 bg-light card-click-animation card-set" style="border-left: 13px solid {{ $flashcard->color }};">
                <div class="col-9 d-flex flex-column justify-content-center">
                    <h4 class="fw-bold m-0">{{ $flashcard->name }}</h4>
                    <p class="m-0 flashcard-set-desc mb-1">{{ $flashcard->description }}</p>
                    <div class="d-inline-block rounded-pill px-3 flashcard-set-tag">{{ $flashcard->category }}</div>
                </div>
                <div class="col-3 d-flex justify-content-end my-auto">
                    <h4 class="fw-bold m-0">
                        {{ $flashcard->flashcards_cards()->count() }}
                    </h4>
                    <img src="{{ asset('images/home-images/card-black.svg') }}" style="height: 30px;">
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection

<script>
    var cardSvgUrl = `{{ URL::asset('images/home-images/card-black.svg') }}`;
    var fcUrl = `{{ route('flashcards') }}`;
</script>

