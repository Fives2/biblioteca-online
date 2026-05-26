@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>🔄 Novo Empréstimo</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('loans.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Usuário</label>
                    <select name="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Livro</label>
                    <select name="book_id" class="form-select" required>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->author->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Devolução Prevista</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Realizar Empréstimo</button>
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection