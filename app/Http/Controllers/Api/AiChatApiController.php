<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use App\Services\AiChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiChatApiController extends Controller
{
    public function send(Request $request, AiChatService $chat): JsonResponse
    {
        $validated = $request->validate(['message' => ['required', 'string', 'max:2000'], 'conversation_id' => ['nullable', 'integer', 'exists:chat_conversations,id']]);
        $conversation = isset($validated['conversation_id']) ? ChatConversation::where('user_id', $request->user()->id)->findOrFail($validated['conversation_id']) : null;
        $result = $chat->reply($request->user(), $conversation, $validated['message']);

        return response()->json(['success' => true, 'data' => ['conversation_id' => $result['conversation']->id, 'message' => ['id' => $result['assistant']->id, 'content' => $result['assistant']->content], 'provider_configured' => $result['providerConfigured']]]);
    }

    public function history(Request $request, ChatConversation $conversation): JsonResponse
    {
        abort_unless($conversation->user_id === $request->user()->id, 403);
        return response()->json(['success' => true, 'data' => $conversation->messages()->oldest()->get(['id', 'role', 'content', 'created_at'])]);
    }
}
