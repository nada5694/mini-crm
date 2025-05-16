@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-4 font-bold">All Actions</h2>
        <a href="{{ route('actions.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> إضافة إجراء جديد
        </a>

    <table class="table table-bordered m-4">
        <thead class="table-dark">
            <tr>
                <th>Customer</th>
                <th>User</th>
                <th>Type</th>
                <th>Date</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actions as $action)
                <tr>
                    <td>{{ $action->customer->name ?? 'N/A' }}</td>
                    <td>{{ $action->user->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($action->type) }}</td>
                    <td>{{ $action->created_at->format('Y-m-d') }}</td>
                    <td>{{ $action->result ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
