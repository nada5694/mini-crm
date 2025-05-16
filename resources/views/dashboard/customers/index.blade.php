@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold m-4">قائمة العملاء</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> إضافة عميل جديد
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    @if($customers->isEmpty())
        <div class="alert alert-info">لا يوجد عملاء حالياً.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-primary">
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>تم الإنشاء بواسطة</th>
                        <th>تاريخ الإنشاء</th>
                        {{-- <th class="text-center">إجراءات</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td class="fw-semibold">{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td>{{ $customer->creator->name ?? 'غير معروف' }}</td>
                        <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                        {{-- <td class="text-center">
                            {{-- <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning me-1" title="تعديل">
                                <i class="bi bi-pencil-square"></i>
                            </a> --}}
                            {{-- <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form> --}}
                        {{-- </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
