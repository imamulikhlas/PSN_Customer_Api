<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        // Get all customers sorted by name (alphabetically)
        $customers = Customer::orderBy('name')->get();
        return response()->json($customers);
    }

    public function show($id)
{
    // Get specific customer and its related addresses
    $customer = Customer::with('addresses')->find($id);

    if ($customer) {
        // Make With Json Template Form Test Page
        $response = [
            'id' => $customer->id,
            'title' => $customer->title,
            'name' => $customer->name,
            'gender' => $customer->gender,
            'phone_number' => $customer->phone_number,
            'image' => $customer->image,
            'email' => $customer->email,
            'addresses' => $customer->addresses,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at
        ];
        return response()->json($response);
    } else {
        return response()->json(['error' => 'Customer not found'], 404);
    }
}


    public function store(Request $request)
    {
        // Validate the request...

        $customer = new Customer;
        $customer->title = $request->title;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->phone_number = $request->phone_number;
        $customer->image = $request->image;
        $customer->email = $request->email;
        $customer->save();

        return response()->json(['message' => 'Customer created', 'customer' => $customer], 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request...

        $customer = Customer::find($id);
        if ($customer) {
            $customer->title = $request->title;
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->phone_number = $request->phone_number;
            $customer->image = $request->image;
            $customer->email = $request->email;
            $customer->save();

            return response()->json(['message' => 'Customer updated', 'customer' => $customer], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            // Delete the customer and related addresses
            Address::where('customer_id', $id)->delete();
            $customer->delete();

            return response()->json(['message' => 'Customer deleted'], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }
}
