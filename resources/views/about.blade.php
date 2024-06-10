@extends('layouts.app')

@section('content')
<div class="container main-container mb-auto">
    <h1>Cadastrar um item</h1>
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
    <div class="row">
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
        <div class="col-md-4">
            <img class="p-4 clickable-image" src="/img/placeholder.png" style="aspect-ratio: 1/1; width: 100%; max-height: 100%; object-fit: cover" alt="Imagem da galeria">
        </div>
    </div>
</div>

@include('image-modal.img-modal')
<script src="{{ asset('script/img-modal.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/img-modal.css') }}">
@endsection
