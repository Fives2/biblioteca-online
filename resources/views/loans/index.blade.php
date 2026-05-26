@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🔄 Empréstimos</h2>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Empréstimo
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Livro</th>
                        <th>Usuário</th>
                        <th>Data Empréstimo</th>
                        <th>Data Devolução</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                        <td>{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : '—' }}</td>
                        <td>
                            @if($loan->status == 'active')
                                <span class="badge bg-warning">Ativo</span>
                            @elseif($loan->status == 'returned')
                                <span class="badge bg-success">Devolvido</span>
                            @else
                                <span class="badge bg-danger">Atrasado</span>
                            @endif
                        </td>
                        <td>
                            @if($loan->status == 'active')
                                <form action="{{ route('loans.update', $loan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success"
                                            onclick="return confirm('Confirmar devolução?')">
                                        Devolver
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-info">Ver</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">Nenhum empréstimo registrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection