<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\ExceptionHandlerService;

class CustomerController extends Controller
{
    private ExceptionHandlerService $customException;

    // Inject my own Exception Handler Service
    public function __construct(ExceptionHandlerService $exceptionHandler)
    {
        $this->customException = $exceptionHandler;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return Customer::all();
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Filter through the resource.
     */
    public function search(Request $request)
    {
        try {
            return Customer::where('name', 'like', '%' . $request->input('search') . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:60',
                'address' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'place' => 'required|string|max:255',
                // the telephone can accept + character, - character, . character,  numbers, white spaces, or parenthesis
                'telephone' => ['required', 'regex:/^[\+\-0-9\s\(\)\.]+$/'],
                'email' => 'required|unique:customers,email|email',
            ]);

            $customer = Customer::create($validatedData);
            return response()->json($customer, 201);
        } catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        try {
            return $customer->load('contacts');
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:60',
                'address' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'place' => 'required|string|max:255',
                // the telephone can accept + character, - character, . character,  numbers, white spaces, or parenthesis
                'telephone' => ['required', 'regex:/^[\+\-0-9\s\(\)\.]+$/'],
                'email' => 'required|email',
            ]);

            $updatedCustomer=$customer->update($validatedData);
            return response()->json($updatedCustomer, 200);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return response()->json( 204);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

}
