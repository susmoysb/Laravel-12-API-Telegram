<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelegramController extends Controller
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TelegramService $telegramService) {}

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        return $this->telegramService->sendMessage($request->message);
    }
}
