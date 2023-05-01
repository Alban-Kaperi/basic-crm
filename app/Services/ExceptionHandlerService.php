<?php
namespace App\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExceptionHandlerService
{
    public function handleException(\Exception $ex)
    {
        // Log the error
        Log::error($ex->getMessage());
        // Check if its Database error
        if ($ex instanceof QueryException) {
            return response()->json(['errors' => 'Database error'], 500);
        }
        // Check if its validation error
        elseif ($ex instanceof ValidationException) {
            $errors = $ex->validator->errors()->toArray();
            return response()->json(['errors' => $errors], 422);
        }
        // Return Server error if its another type of error
        else {
            return response()->json(['errors' => 'Server error'], 500);
        }
    }
}
