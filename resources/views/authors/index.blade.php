@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👤 Autores Cadastrados</h2>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Autor
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Nacionalidade</th>
                        <th>Data de Nascimento</th>
                        <th>Quantidade de Livros</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                    <tr>
                        <td><strong>{{ $author->name }}</strong></td>
                        <td>{{ $author->nationality ?? '—' }}</td>
                        <td>
                            {{ $author->birth_date ? \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') : '—' }}
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $author->books()->count() }} livros</span>
                        </td>
                        <td>
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir este autor?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Nenhum autor cadastrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $authors->links() }}
@endsection