<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ExceptionHandlerService;
use Illuminate\Http\Request;

class ContactController extends Controller
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
            return Contact::all();
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
            return Contact::where('first_name', 'like', '%' . $request->input('search') . '%')
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
                'first_name' => 'required|string|max:60',
                'last_name' => 'required|string|max:60',
                'customer_id' => 'required|exists:customers,id',
                // the telephone can accept + character, - character, . character,  numbers, white spaces, or parenthesis
                'telephone' => ['required', 'regex:/^[\+\-0-9\s\(\)\.]+$/'],
                'email' => 'required|unique:customers,email|email',
            ]);

            $contact = Contact::create($validatedData);
            return response()->json($contact, 201);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        try {
            return $contact->with('customer')->findOrFail($contact->id);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:60',
                'last_name' => 'required|string|max:60',
                'customer_id' => 'required|exists:customers,id',
                // the telephone can accept + character, - character, . character,  numbers, white spaces, or parenthesis
                'telephone' => ['required', 'regex:/^[\+\-0-9\s\(\)\.]+$/'],
                'email' => 'required|email',
            ]);

            $updatedContact=$contact->update($validatedData);
            return response()->json($updatedContact, 200);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            return response()->json( 204);
        }
        catch (\Exception $ex) {
            return $this->customException->handleException($ex);
        }
    }
}
