<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $actions = Action::with('customer', 'user')->get();
        } else {
            $actions = Action::with('customer')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('dashboard.actions.index', compact('actions'));
    }

    public function create()
    {
        $user = Auth::user();
        $customers = Customer::all();

        return view('dashboard.actions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type'        => 'required|in:call,visit,follow-up',
            'result'      => 'nullable|string',
        ]);

        if ($user->role !== 'admin') {
            $customer = Customer::findOrFail($validated['customer_id']);
            if ($customer->assigned_to !== $user->id) {
                return redirect()->back()->withErrors(['customer_id' => 'غير مصرح لك بإضافة إجراء لهذا العميل.'])->withInput();
            }
        }

        Action::create([
            'id'          => Str::uuid()->toString(),
            'customer_id' => $validated['customer_id'],
            'user_id'     => $user->id,
            'type'        => $validated['type'],
            'result'      => $validated['result'] ?? null,
        ]);

        return redirect()->route('actions.index')->with('success', 'تم إضافة الإجراء بنجاح');
    }

    public function indexForCustomer($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        $user = Auth::user();
        if ($user->role === 'admin') {
            $actions = Action::with('user')->where('customer_id', $customer->id)->get();
        } else {
            $actions = Action::with('user')
                ->where('customer_id', $customer->id)
                ->where('user_id', $user->id)
                ->get();
        }

        return view('dashboard.actions.index', compact('actions', 'customer'));
    }

}
