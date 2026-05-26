@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Detalhes do Autor</h4>
        </div>
        <div class="card-body">

            <h3>{{ $author->name }}</h3>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Nacionalidade:</strong> {{ $author->nationality ?? 'Não informada' }}</p>
                    <p><strong>Data de Nascimento:</strong> 
                        {{ $author->birth_date ? \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') : 'Não informada' }}
                    </p>
                </div>
            </div>

            @if($author->bio)
            <div class="mt-4">
                <h5>Biografia:</h5>
                <div class="bg-light p-4 rounded">
                    {{ $author->bio }}
                </div>
            </div>
            @endif

            <h5 class="mt-5">Livros deste autor ({{ $author->books()->count() }})</h5>
            
            @if($author->books()->count() > 0)
                <ul class="list-group">
                    @foreach($author->books as $book)
                        <li class="list-group-item">
                            {{ $book->title }} 
                            <span class="badge bg-secondary float-end">{{ $book->category->name ?? '' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Este autor ainda não possui livros cadastrados.</p>
            @endif

            <div class="mt-5">
                <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Voltar</a>
            </div>

        </div>
    </div>
@endsection