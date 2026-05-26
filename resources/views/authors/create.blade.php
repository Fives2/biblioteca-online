@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Cadastrar Novo Autor</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('authors.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nome Completo <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nacionalidade</label>
                            <input type="text" name="nationality" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" name="birth_date" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Biografia</label>
                    <textarea name="bio" class="form-control" rows="5"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Salvar Autor</button>
                    <a href="{{ route('authors.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
@endsection