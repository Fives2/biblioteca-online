@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>✏️ Editar Categoria: {{ $category->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nome da Categoria <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Atualizar Categoria</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection