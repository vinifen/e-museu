@extends('layouts.app')

@section('content')
<div class="container mb-auto mt-3">
    <h2>Entrar como administrador</h2>

    <div class="row">
        <div class="col-6">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nome de usuário de administrador</label>
                  <input class="form-control" id="username" type="text"  name="username" required autofocus>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Senha</label>
                  <input class="form-control" id="password" type="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>

@endsection
