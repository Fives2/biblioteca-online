@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>📖 Detalhes do Livro</h4>
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-8">
                    <h3>{{ $book->title }}</h3>
                    <p class="text-muted">
                        <strong>ISBN:</strong> {{ $book->isbn }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    @if($book->available)
                        <span class="badge bg-success fs-5 px-3 py-2">✅ Disponível</span>
                    @else
                        <span class="badge bg-danger fs-5 px-3 py-2">❌ Emprestado</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="140">Autor:</th>
                            <td><strong>{{ $book->author->name ?? 'Não informado' }}</strong></td>
                        </tr>
                        <tr>
                            <th>Categoria:</th>
                            <td>{{ $book->category->name ?? 'Não informado' }}</td>
                        </tr>
                        <tr>
                            <th>Páginas:</th>
                            <td>{{ $book->pages ? $book->pages . ' páginas' : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Publicado em:</th>
                            <td>{{ $book->published_at ? \Carbon\Carbon::parse($book->published_at)->format('d/m/Y') : '—' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($book->description)
            <div class="mt-4">
                <h5>Descrição:</h5>
                <div class="bg-light p-3 rounded">
                    {{ $book->description }}
                </div>
            </div>
            @endif

            <!-- Ações -->
            <div class="mt-5">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Editar Livro
                </a>
                
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar para Lista
                </a>

                @if($book->available)
                    <form action="{{ route('books.loan', $book) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success" 
                                onclick="return confirm('Realizar empréstimo deste livro?')">
                            <i class="bi bi-arrow-right-circle"></i> Realizar Empréstimo
                        </button>
                    </form>
                @endif

                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                        <i class="bi bi-trash"></i> Excluir
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection