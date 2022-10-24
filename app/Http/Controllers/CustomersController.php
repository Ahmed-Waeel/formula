<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($pagination = PAGINATION)
    {
        $customers = Customer::where('deleted_at', null)->paginate($pagination);
        return view('customers/show', compact('customers'));
    }

    public function add()
    {
        return view('customers/add');
    }

    public function store(CustomerRequest $request)
    {
        while (true) {
            $customer_id = rand(1000, 1000000);
            $customer = Customer::where('customer_id', $customer_id)->first();
            if (!$customer) {
                break;
            }
        }
        Customer::create([
            'customer_id' => $customer_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'hotels' => $request->hotels,
        ]);
        return redirect(route('customer.showAll'))->with('success', __('view.customerCreated', ['id' => $customer_id]));
    }

    public function edit($customerId)
    {
        $customer = Customer::where('deleted_at', null)->where('customer_id', $customerId)->first();
        if (!$customer) {
            return redirect()->back()->with('error', __('view.wrong'));
        }

        return view('customers/edit', compact('customer'));
    }

    public function update(CustomerRequest $request)
    {
        $customer = Customer::where('deleted_at', null)->where('customer_id', $request->customer_id);
        if (!$customer->first()) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $customer->update([
            'name' => $request->name ?? $customer->first()->name,
            'phone' => $request->phone ?? $customer->first()->phone,
            'email' => $request->email ?? $customer->first()->email,
        ]);
        return redirect()->back()->with('success', __('view.customerUpdated'));
    }

    public function delete($customerId)
    {
        $customer = Customer::where('customer_id', $customerId);
        if (!$customer) {
            return redirect()->back()->with('error', __('view.wrong'));
        }
        $customer->update(['deleted_at' => now()]);
        return redirect(route('customer.showAll'))->with('success', __('view.customerDeleted'));
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $customers = Customer::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;

            $customers = Customer::where('customer_id', $request->data)
                ->orWhere('name', 'like', '%' . $request->data . '%')
                ->orWhere('phone', 'like', '%' . $request->data . '%')
                ->orWhere('email', 'like', '%' . $request->data . '%')
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('customers/show', compact('customers', 'data', 'pagination'));
    }
}
