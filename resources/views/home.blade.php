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
            <div class="row d-flex justify-content-center align-content-center flex-column flex-sm-row">
                <div class="card col-lg-4 text-center mx-3 mb-4 p-0" id="card-tools-1">
                    <a href="#" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/clock.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card col-lg-4 text-center mx-3 mb-4 p-0" id="card-tools-2">
                    <a href="#" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/cards.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card col-lg-4 text-center mx-3 p-0" id="card-tools-3">
                    <a href="#" class="link-overlay position-absolute d-block top-0 left-0 w-100 h-100"></a>
                    <div class="d-flex justify-content-center align-items-center w-100 h-75">
                        <img class="card-img-top" src="{{ asset('images/home-images/books.png') }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
