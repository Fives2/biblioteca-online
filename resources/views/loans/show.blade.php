@extends('app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Detalhes do Empréstimo</h4>
        </div>
        <div class="card-body">
            <h5>Livro: <strong>{{ $loan->book->title }}</strong></h5>
            <p><strong>Usuário:</strong> {{ $loan->user->name }}</p>
            <p><strong>Data do Empréstimo:</strong> {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</p>
            <p><strong>Data Prevista:</strong> {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</p>
            @if($loan->return_date)
                <p><strong>Data de Devolução:</strong> {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection