@extends('layouts.app')

@section('content')
<div class="container">
    <h2>مرحبًا {{ auth()->user()->name }} 👋</h2>
{{-- <pre>{{ dd(auth()->user()) }}</pre> --}}

    @if(auth()->user()->role === 'admin')
        <div class="mt-4">
            {{-- <a href="{{ route('user.index') }}" class="btn btn-primary">إدارة الموظفين</a>
            <a href="{{ route('customers.index') }}" class="btn btn-success">إدارة العملاء</a>
            <a href="{{ route('assign.customers') }}" class="btn btn-warning">تعيين العملاء</a> --}}
        </div>
    @elseif(auth()->user()->role === 'employee')
        {{-- <div class="mt-4">
            <a href="{{ route('customers.index') }}" class="btn btn-success">عرض عملائي</a>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">إضافة عميل جديد</a> --}}
        </div>
    @endif
</div>
@endsection
