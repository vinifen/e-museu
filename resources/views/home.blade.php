@extends('layouts.app')

@section('content')
    <div class="container-fluid headline">
        <img class="img-headline" src="/img/placeholder.png" alt="">
        <div class="container headline-content">
            <div class="row">
                <div class="col-md-6">
                    <p class="h1 fw-bold">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    <h6>
                        Pellentesque semper dapibus nisi. Aliquam eu felis in sem fringilla
                        ultrices. Pellentesque fringilla neque a ultricies mollis.
                        Cras malesuada aliquam suscipit.
                    </h6>
                    <a class="nav-link p-3 fw-bold explore-button col-md-6" href="{{ route('items.index') }}">EXPLORAR O MUSEU VIRTUAL</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-container mb-auto">
        <h1>Lorem ipsum</h1>
        <div class="row">
            <div class="col-md-6">
                <p class="p-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin. Orci varius natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque nunc risus, lobortis a augue et,
                    sagittis pretium nulla.
                    <br>
                    Integer malesuada luctus ex ut porttitor. Morbi sed orci semper, elementum est eu, congue metus. Curabitur mauris
                    nisl, interdum vitae dapibus vitae, molestie eget ligula.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin. Orci varius natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque nunc risus, lobortis a augue et,
                    sagittis pretium nulla.
                </p>
            </div>
            <div class="col-md-6 ">
                <img src="/img/placeholder.png" class="p-4 clickable-image" style="aspect-ratio: 3 / 2; width: 100%; max-height: 100%; object-fit: cover" alt="">
            </div>
        </div>
        <h3>Lorem ipsum</h3>
        <div class="row">
            <div class="col-md-6 ">
                <img src="/img/placeholder.png" class="p-4 clickable-image" style="aspect-ratio: 3 / 2; width: 100%; max-height: 100%; object-fit: cover" alt="">
            </div>
            <div class="col-md-6">
                <p class="p-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin. Orci varius natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque nunc risus, lobortis a augue et,
                    sagittis pretium nulla.
                    <br>
                    Integer malesuada luctus ex ut porttitor. Morbi sed orci semper, elementum est eu, congue metus. Curabitur mauris
                    nisl, interdum vitae dapibus vitae, molestie eget ligula.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin. Orci varius natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque nunc risus, lobortis a augue et,
                    sagittis pretium nulla.
                </p>
            </div>
        </div>
        <h3>Lorem ipsum</h3>
        <div class="row p-4">
            <div class="col-md-4 ">
                <div class="col-md pb-5 d-flex justify-content-center">
                    <a href="{{ route('items.index') }}" class="card d-flex card-anim">
                        <img class="p-1" src="/img/placeholder.png" style="height: 12rem; object-fit: cover;" alt="...">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">Lorem ipsum dolor</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin.</p>
                            <h6 class="me-4 d-flex justify-content-end card-more-details">VER MAIS ></h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="col-md pb-5 d-flex justify-content-center">
                    <a href="{{ route('contribute') }}" class="card d-flex card-anim">
                        <img class="p-1" src="/img/placeholder.png" style="height: 12rem; object-fit: cover;" alt="...">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">Lorem ipsum dolor</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin.</p>
                            <h6 class="me-4 d-flex justify-content-end card-more-details">VER MAIS ></h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="col pb-5 d-flex justify-content-center">
                    <a href="{{ route('about') }}" class="card d-flex card-anim">
                        <img class="p-1" src="/img/placeholder.png" style="height: 12rem; object-fit: cover;" alt="...">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">Lorem ipsum dolor</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dignissim tempus solli citudin.</p>
                            <h6 class="me-4 d-flex justify-content-end card-more-details">VER MAIS ></h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('image-modal.img-modal')
    <script src="{{ asset('script/img-modal.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/img-modal.css') }}">
@endsection
