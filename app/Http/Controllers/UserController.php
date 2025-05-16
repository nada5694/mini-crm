<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $employees = User::where('role', 'employee')->get();
        $admins = User::where('role', 'admin')->get();
        return view('dashboard.employees.index', compact('users','employees', 'admins'));
    }

    public function create()
    {
        return view('dashboard.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'employee'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'employee'])],
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}

// class CustomerController extends Controller
// {
//     public function index()
//     {
//         $customers = Customer::with('assignedEmployee')->get();
//         return view('dashboard.customers.index', compact('customers'));
//     }

//     public function create()
//     {
//         $employees = User::where('role', 'employee')->get();
//         return view('dashboard.customers.create', compact('employees'));
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'nullable|email',
//             'phone' => 'nullable|string',
//             'employee_id' => 'nullable|exists:users,id',
//         ]);

//         Customer::create($validated);

//         return redirect()->route('customers.index')->with('success', 'Customer created');
//     }

//     public function edit(Customer $customer)
//     {
//         $employees = User::where('role', 'employee')->get();
//         return view('dashboard.customers.edit', compact('customer', 'employees'));
//     }

//     public function update(Request $request, Customer $customer)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'nullable|email',
//             'phone' => 'nullable|string',
//             'employee_id' => 'nullable|exists:users,id',
//         ]);

//         $customer->update($validated);

//         return redirect()->route('customers.index')->with('success', 'Customer updated');
//     }

//     public function destroy(Customer $customer)
//     {
//         $customer->delete();
//         return redirect()->route('customers.index')->with('success', 'Customer deleted');
//     }
// }

// class ActionController extends Controller
// {
//     public function index() {
//         $employees = User::where('role', 'employee')->get();
//         return view('dashboard.employees.index', compact('employees'));
//     }

//     public function create() {
//         return view('dashboard.employees.create');
//     }

//     public function store(Request $request) {
//         $validated = $request->validate([
//             'name' => 'required|string',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|string|min:6',
//         ]);

//         User::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'role' => 'employee',
//             'password' => Hash::make($validated['password']),
//         ]);

//         return redirect()->route('employees.index');
//     }

//     public function destroy(Action $action)
//     {
//         $action->delete();
//         return redirect()->route('actions.index')->with('success', 'Action deleted');
//     }
// }
