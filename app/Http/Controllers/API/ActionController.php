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

        return response()->json($actions);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:call,visit,follow-up',
            'result' => 'nullable|string',
        ]);
        $type = strtolower($request->input('type'));

        $allowedTypes = ['call', 'visit', 'follow-up'];

        if (!in_array($type, $allowedTypes)) {
            throw new \Exception('نوع الإجراء غير صالح');
        }
        \Log::info('Action type:', ['type' => $validated['type']]);

        if ($user->role !== 'admin') {
            $customer = Customer::findOrFail($validated['customer_id']);

            if ($customer->assigned_to !== $user->id) {
                return response()->json([
                    'message' => 'You are not assigned to this customer.'
                ], 403);
            }
        }

        $action = Action::create([
            'id' => Str::uuid()->toString(),
            'customer_id' => $validated['customer_id'],
            'user_id' => $user->id,
            'type' => $validated['type'],
            'result' => $validated['result'] ?? null,
        ]);

        return response()->json($action, 201);
    }

}
