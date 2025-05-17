@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-4 font-bold">Add Action</h2>

    <form method="POST" action="{{ route('customers.actions.store') }}">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Select Customer</label>
            <select id="customer_id" name="customer_id" class="form-select" required>
                <option value="">Choose a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Action Type</label>
            <select id="type" name="type" class="form-select" required>
                <option value="">Select action type</option>
                <option value="call">Call</option>
                <option value="visit">Visit</option>
                <option value="follow-up">Follow Up</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="result" class="form-label">Result</label>
            <textarea id="result" name="result" class="form-control" rows="3" ></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Action</button>
    </form>
</div>
@endsection
