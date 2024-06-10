@extends('layouts.admin')

@section('content')
    <div class="mb-auto container-fluid">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        <form action="{{ route('admin.proprietaries.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <h2 class="card-header">Adicionar Proprietário</h2>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}">
                        @error('full_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Email</label>
                        <input type="email" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact') }}">
                        @error('contact') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="blocked" class="form-label">Bloqueado</label>
                        <select class="form-select @error('blocked') is-invalid @enderror" id="blocked" name="blocked">
                            <option value="0" {{ old('blocked') == 0 ? 'selected' : '' }}>Não</option>
                            <option value="1" {{ old('blocked') == 1 ? 'selected' : '' }}>Sim</option>
                        </select>
                        @error('validation') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Adicionar Proprietário</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
