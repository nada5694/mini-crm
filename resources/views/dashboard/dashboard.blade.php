@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-4 fs-6 fw-bold">
        <h2>مرحبًا {{ auth()->user()->name }} 👋</h2>
    </div>

</div>
@endsection
