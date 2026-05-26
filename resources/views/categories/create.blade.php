@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>🏷️ Nova Categoria</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome da Categoria <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Salvar Categoria</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection