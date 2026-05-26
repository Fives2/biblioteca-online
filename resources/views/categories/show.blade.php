@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Detalhes da Categoria</h4>
        </div>
        <div class="card-body">
            <h3>{{ $category->name }}</h3>
            @if($category->description)
                <p class="mt-3">{{ $category->description }}</p>
            @endif

            <h5 class="mt-4">Livros nesta categoria ({{ $category->books()->count() }})</h5>
            
            @if($category->books->count() > 0)
                <ul class="list-group">
                    @foreach($category->books as $book)
                        <li class="list-group-item">
                            {{ $book->title }} - <strong>{{ $book->author->name ?? '' }}</strong>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Nenhum livro cadastrado nesta categoria.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection