<?php

namespace App\Http\Controllers\API;

use App\Contracts\TelegramServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelegramController extends Controller
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TelegramServiceInterface $telegramService) {}

    public function sendMessage(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        return $this->telegramService->sendMessage($request->message);
    }

    public function sendPhoto(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'photo'   => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'caption' => ['sometimes', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        return $this->telegramService->sendPhoto($request->photo, $request->caption ?? '');
    }
}
