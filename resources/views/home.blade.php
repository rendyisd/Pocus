@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-content-center main-text-container mb-5">
        <div class="col">
            <h1 class="text-center mb-4 main-text-big">
                Join thousands of others
                <br>
                boosting their productivity
            </h1>
            <p class="text-center main-text-sub">Pocus gives you the tools you need to increase your productivity and keep your focus while doing your tasks.</p>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col">
            <h1 class="text-center main-text-big mb-4">
                Tools
            </h1>
            <div class="row tools-section d-flex justify-content-center align-content-center flex-column flex-sm-row">
                <div class="card col-lg-4 text-center mx-3 mb-5 p-0" id="card-tools-1">
                    <a href="{{ route('pomodoro') }}" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/clock.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Pomodoro</h3>
                        <p class="card-text">
                            Pomodoro is an effective way to boost productivity and focus through timed intervals and breaks.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card col-lg-4 text-center mx-3 mb-5 p-0" id="card-tools-2">
                    <a href="{{ route('flashcards') }}" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/cards.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Flashcards</h3>
                        <p class="card-text">
                            Flashcards is a method for memorization and retention of information through active recall.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card col-lg-4 text-center mx-3 p-0" id="card-tools-3">
                    <a href="#" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/books.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Schedule</h3>
                        <p class="card-text">
                            Using a schedule can help you stay organized, prioritize your tasks, reduce stress and procrastination.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
