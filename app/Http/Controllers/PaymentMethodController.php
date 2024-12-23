<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodLock;
use App\Models\TelegramUser;

class PaymentMethodController extends Controller
{
    //
    public function index(Request $request)
    {
        // $user = $request->user();
       $paymentMethods = PaymentMethod::where('user_id', 3)->get();
      
        return response()->json($paymentMethods, 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:telegram_users,id',
            'method' => 'required|string',
            'account_holder_name' => 'required|string',
            'account_number' => 'required|string',
        ]);
    
        // Check if the method is Easypaisa or JaazCash and locked is false globally
        if (in_array($validated['method'], ['Easypaisa', 'JaazCash' , 'easypaisa' , 'jaazcash' , 'EasyPaisa' , 'Jaazcash'])) {
            $isLocked = PaymentMethodLock::where('locked', true) // Check for locked status
                ->exists();
    
            if (!$isLocked) { // If no locked record exists for this method, block addition
                return response()->json([
                    'message' => "The {$validated['method']} payment method is currently locked and cannot be added.",
                ], 403); // Forbidden
            }
        }
    
        // Check if the payment method already exists for the user
        $existingPaymentMethod = PaymentMethod::where('user_id', $validated['user_id'])
            ->where('method', $validated['method'])
            ->where('account_number', $validated['account_number'])
            ->first();
    
        if ($existingPaymentMethod) {
            return response()->json([
                'message' => 'This payment method already exists for this user.',
            ], 400); // Bad Request
        }
    
        // If no existing payment method, create a new one
        $paymentMethod = PaymentMethod::create([
            'user_id' => $validated['user_id'],
            'method' => $validated['method'],
            'account_holder_name' => $validated['account_holder_name'],
            'account_number' => $validated['account_number'],
        ]);
    
        $user = TelegramUser::find($validated['user_id']);
        if ($user) {
            $user->update(['payment_verified' => true]);
        }
    
        return response()->json([
            'paymentMethod' => $paymentMethod,
            'message' => 'Payment method added successfully.',
        ]);
    }
    
    
    
    



    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('update', $paymentMethod);

        if ($paymentMethod->locked) {
            return response()->json(['message' => 'This payment method is locked and cannot be updated.'], 403);
        }

        $validated = $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        $paymentMethod->update($validated);

        return response()->json(['paymentMethod' => $paymentMethod, 'message' => 'Payment method updated successfully.'], 200);
    }

    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('delete', $paymentMethod);

        if ($paymentMethod->locked) {
            return response()->json(['message' => 'This payment method is locked and cannot be deleted.'], 403);
        }

        $paymentMethod->delete();

        // Update payment_verified if all payment methods are removed
        $user = $request->user();
        if ($user->paymentMethods()->count() === 0) {
            $user->update(['payment_verified' => false]);
        }

        return response()->json(['message' => 'Payment method removed successfully.'], 200);
    }
}
