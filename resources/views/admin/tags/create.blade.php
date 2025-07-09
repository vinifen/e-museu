@extends('layouts.admin')
@section('title', 'Criar etiqueta')

@section('content')
    <div class="mb-auto container-fluid">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <h2 class="card-header">Adicionar Etiqueta</h2>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validation" class="form-label">Validado</label>
                        <select class="form-select @error('validation') is-invalid @enderror" id="validation"
                            name="validation">
                            <option value="0" {{ old('validation') == 0 ? 'selected' : '' }}>Não</option>
                            <option value="1" {{ old('validation') == 1 ? 'selected' : '' }}>Sim</option>
                        </select>
                        @error('validation')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                            name="category_id">
                            <option selected="selected" value="">-</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Adicionar
                            Etiqueta</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
