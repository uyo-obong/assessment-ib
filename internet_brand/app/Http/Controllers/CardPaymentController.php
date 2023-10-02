<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateCardPaymentRequest;

class CardPaymentController extends Controller
{
    public function validateCreditCard(ValidateCardPaymentRequest $request) {
        try {
            $card_name = $request->card_name;
            $card_number = $request->card_number;
            $card_cvv = $request->card_cvv;
            $card_expiry_month = $request->card_expiry_month;
            $card_expiry_year = $request->card_expiry_year;

            if (str_starts_with($card_number, '34') || str_starts_with($card_number, '37')) {
                // American Express card, CVV should be 4 digits
                if (strlen($card_cvv) !== 4) {
                    return $this->errorHandler('card_cvv', 'CVV must be 4 digits for American Express cards');
                }
            } else {
                // Other cards, CVV should be 3 digits
                if (strlen($card_cvv) !== 3) {
                    return $this->errorHandler('card_cvv', 'CVV must be 3 digits');
                }
            }

            // Implement Luhn's algorithm to validate the card number
            if (!$this->luhnCheck($card_number)) {
                return $this->errorHandler('card_number', 'Invalid card number');
            }

            // Get the current year
            $current_year = date('Y');

            // Check if the card has expired
            if ($card_expiry_year < $current_year || ($card_expiry_year == $current_year && $card_expiry_month < date('n'))) {
                return $this->errorHandler('card_number', 'Card has expired');
            }

            return response()->json(['message' => 'Card validation successful'], 200);
        } catch (\Throwable $exception) {
            dd($exception->getMessage());
        }
    }

    /**
     * The luhn algorithm is used to validate the card number by adding all the number
     * and check if it is divisible by 10
     * @param $number
     * @return bool
     */
    private function luhnCheck($number): bool
    {
        $sum = 0;
        $num_digits = strlen($number);
        $check = $num_digits % 2;

        for ($i = 0; $i < $num_digits; $i++) {
            $digit = $number[$i];

            if ($i % 2 == $check) {

                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return $sum % 10 == 0;
    }

    private function errorHandler($type, $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => [$type => [$message]],
        ], 400);
    }
}
