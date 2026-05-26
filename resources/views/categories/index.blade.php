@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🏷️ Categorias</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova Categoria
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade de Livros</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ $category->description ?? '—' }}</td>
                        <td>
                            <span class="badge bg-info">{{ $category->books_count }} livros</span>
                        </td>
                        <td>
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Excluir esta categoria?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-4">Nenhuma categoria cadastrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $categories->links() }}
@endsection