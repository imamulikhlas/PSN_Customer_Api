<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request...
            $validated = $request->validate([
                'customer_id' => 'required|integer|exists:customers,id',
                'address' => 'required|max:255',
                'district' => 'required|max:255',
                'city' => 'required|max:255',
                'province' => 'required|max:255',
                'postal_code' => 'required|integer',
            ]);

            $address = new Address;
            $address->customer_id = $request->customer_id;
            $address->address = $request->address;
            $address->district = $request->district;
            $address->city = $request->city;
            $address->province = $request->province;
            $address->postal_code = $request->postal_code;
            $address->save();

            return response()->json(['message' => 'Address created', 'address' => $address], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request...
            $validated = $request->validate([
                'address' => 'required|max:255',
                'district' => 'required|max:255',
                'city' => 'required|max:255',
                'province' => 'required|max:255',
                'postal_code' => 'required|integer',
            ]);

            $address = Address::find($id);
            if ($address) {
                $address->address = $request->address;
                $address->district = $request->district;
                $address->city = $request->city;
                $address->province = $request->province;
                $address->postal_code = $request->postal_code;
                $address->save();

                return response()->json(['message' => 'Address updated', 'address' => $address], 200);
            } else {
                return response()->json(['error' => 'Address not found'], 404);
            }
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
    }

    public function updateCustomerId(Request $request, $addressId)
    {
        // Find the address
        $address = Address::find($addressId);

        // If the address does not exist, return an error
        if (!$address) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        // Update the customer_id
        $address->customer_id = $request->customer_id;
        $address->save();

        return response()->json(['message' => 'customer_id updated', 'address' => $address], 200);
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        if ($address) {
            $address->delete();

            return response()->json(['message' => 'Address deleted'], 200);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
}
