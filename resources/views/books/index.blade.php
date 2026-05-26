@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Livros</h2>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Livro
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>ISBN</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td><strong>{{ $book->title }}</strong></td>
                        <td>{{ $book->author->name ?? '—' }}</td>
                        <td>{{ $book->category->name ?? '—' }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>
                            @if($book->available)
                                <span class="badge bg-success">Disponível</span>
                            @else
                                <span class="badge bg-danger">Emprestado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Nenhum livro cadastrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $books->links() }}
@endsection