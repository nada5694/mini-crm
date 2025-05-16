@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->role === 'admin')
    <h2 class="m-4 font-bold">Users Management</h2>
    @else
    <h2 class="m-4 font-bold">Employees Management</h2>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add New Employee</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @if(auth()->user()->role === 'admin')
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        {{-- <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td> --}}
                    </tr>
                @endforeach
            @elseif(auth()->user()->role === 'employee')
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->role }}</td>
                        {{-- <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td> --}}
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
@endsection
