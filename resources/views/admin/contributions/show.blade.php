@extends('layouts.admin')
@section('title', 'Contribuição ' . $contribution->id)

@section('content')
    <div class="mb-auto container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <h2 class="card-header">Mostrando Contribuição: {{ $contribution->id }}</h2>
                    <div class="card-body d-flex">
                        <a href="{{ route('admin.contributions.edit', $contribution->id) }}" type="button"
                            class="btn btn-warning me-1"><i class="bi bi-pencil-fill"></i> Editar</a>
                        <form action="{{ route('admin.contributions.destroy', $contribution->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="deleteExtraButton btn btn-danger"><i class="bi bi-trash-fill"></i>
                                Excluir
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <h5 class="card-header">Id</h5>
                            <div class="card-body">
                                <p class="card-text">{{ $contribution->id }}</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Criado em</h5>
                            <div class="card-body">
                                <p class="ms-2">{{ date('d-m-Y H:i:s', strtotime($contribution->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Atualizado em</h5>
                            <div class="card-body">
                                <p class="ms-2">{{ date('d-m-Y H:i:s', strtotime($contribution->updated_at)) }}</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Validado</h5>
                            <div class="card-body">
                                <p class="card-text">
                                    @if ($contribution->validation == 1)
                                        Sim
                                    @else
                                        Não
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <h5 class="card-header">Proprietário</h5>
                            <div class="card-body">
                                <strong>Id: </strong>
                                <p class="ms-3">{{ $contribution->proprietary->id }}</p>
                                <strong>Nome completo: </strong>
                                <p class="ms-3">{{ $contribution->proprietary->full_name }}</p>
                                <strong>Contato: </strong>
                                <p class="ms-3">{{ $contribution->proprietary->contact }}</p>
                                <strong>Bloqueado: </strong>
                                <p class="ms-3">
                                    @if ($contribution->proprietary->blocked == 1)
                                        Sim
                                    @else
                                        Não
                                    @endif
                                </p>
                                <strong>Criado em: </strong>
                                <p class="ms-3">
                                    {{ date('d-m-Y H:i:s', strtotime($contribution->proprietary->created_at)) }}</p>
                                <strong>Atualizado em: </strong>
                                <p class="ms-3">
                                    {{ date('d-m-Y H:i:s', strtotime($contribution->proprietary->updated_at)) }}</p>
                                <div class="d-flex">
                                    <a href="{{ route('admin.proprietaries.show', $contribution->proprietary->id) }}"
                                        type="button" class="btn btn-primary me-1"><i class="bi bi-eye-fill"></i>
                                        Visualizar</a>
                                    <a href="{{ route('admin.proprietaries.edit', $contribution->proprietary->id) }}"
                                        type="button" class="btn btn-warning me-1"><i class="bi bi-pencil-fill"></i>
                                        Editar</a>
                                    <form
                                        action="{{ route('admin.proprietaries.destroy', $contribution->proprietary->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="deleteProprietaryButton btn btn-danger" type="submit"><i
                                                class="bi bi-trash-fill"></i> Excluir
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <h5 class="card-header">Conteúdo</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $contribution->content }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <h5 class="card-header">Item</h5>
                    <div class="card-body">
                        <strong>Id: </strong>
                        <p class="ms-3">{{ $contribution->item->id }}</p>
                        <strong>Nome: </strong>
                        <p class="card-text">{{ $contribution->item->name }}</p>
                        <img src="{{ url("storage/{$contribution->item->image}") }}" class="img-thumbnail clickable-image"
                            alt="Imagem do item"
                            style="aspect-ratio: 1 / 1; width: 100%; max-height: 100%; object-fit: cover">
                        <strong>Descrição: </strong>
                        <p class="ms-3">{{ $contribution->item->description }}</p>
                        <strong>História: </strong>
                        <p class="card-text">{{ $contribution->item->history }}</p>
                        <strong>Detalhe: </strong>
                        <p class="ms-3">{{ $contribution->item->detail }}</p>
                        <strong>Data: </strong>
                        <p class="card-text">{{ date('d-m-Y', strtotime($contribution->item->date)) }}</p>
                        <strong>Código de Identificação: </strong>
                        <p class="ms-3">{{ $contribution->item->identification_code }}</p>
                        <strong>Validado: </strong>
                        <p class="ms-3">
                            @if ($contribution->item->validation == 1)
                                Sim
                            @else
                                Não
                            @endif
                        </p>
                        <strong>Seção: </strong>
                        <p class="card-text">{{ $contribution->item->section->name }}</p>
                        <strong>Proprietário: </strong>
                        <p class="card-text">{{ $contribution->item->proprietary->name }}</p>
                        <strong>Criado em: </strong>
                        <p class="ms-2">{{ date('d-m-Y H:i:s', strtotime($contribution->item->created_at)) }}</p>
                        <strong>Atualizado em: </strong>
                        <p class="ms-2">{{ date('d-m-Y H:i:s', strtotime($contribution->item->updated_at)) }}</p>
                        <div class="d-flex">
                            <a href="{{ route('admin.items.show', $contribution->item->id) }}" type="button"
                                class="btn btn-primary me-1"><i class="bi bi-eye-fill"></i> Visualizar</a>
                            <a href="{{ route('admin.items.edit', $contribution->item->id) }}" type="button"
                                class="btn btn-warning me-1"><i class="bi bi-pencil-fill"></i> Editar</a>
                            <form action="{{ route('admin.items.destroy', $contribution->item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="deleteItemButton btn btn-danger" type="submit"><i
                                        class="bi bi-trash-fill"></i> Excluir
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('image-modal.img-modal')
    <script src="{{ asset('script/img-modal.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/img-modal.css') }}">

    <script src="{{ asset('script/deleteContributionWarning.js') }}"></script>
    <script src="{{ asset('script/deleteProprietaryWarning.js') }}"></script>
    <script src="{{ asset('script/deleteItemWarning.js') }}"></script>
@endsection
