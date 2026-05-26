@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Cadastrar Novo Livro</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Título do Livro <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" name="isbn" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Autor <span class="text-danger">*</span></label>
                            <select name="author_id" class="form-select" required>
                                <option value="">Selecione um autor...</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Categoria <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Selecione uma categoria...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Número de Páginas</label>
                            <input type="number" name="pages" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Data de Publicação</label>
                            <input type="date" name="published_at" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-save"></i> Salvar Livro
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
@endsection