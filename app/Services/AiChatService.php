<?php

namespace App\Services;

use App\Models\ChatConversation;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiChatService
{
    public function reply(User $user, ?ChatConversation $conversation, string $message): array
    {
        $conversation ??= ChatConversation::create([
            'user_id' => $user->id,
            'title' => Str::limit($message, 80),
        ]);

        $conversation->messages()->create(['role' => 'user', 'content' => $message]);
        $history = $conversation->messages()->latest()->take(12)->get()->reverse()->values();

        $answer = $this->askProvider($user, $history->map(fn ($item) => [
            'role' => $item->role,
            'content' => $item->content,
        ])->all());

        $assistant = $conversation->messages()->create([
            'role' => 'assistant',
            'content' => $answer['content'],
            'meta' => ['provider_configured' => $answer['configured']],
        ]);

        return compact('conversation', 'assistant') + ['providerConfigured' => $answer['configured']];
    }

    private function askProvider(User $user, array $history): array
    {
        $key = config('services.ai.key');
        if (blank($key)) {
            return [
                'configured' => false,
                'content' => 'AI support is being configured. Please use the Contact page for urgent help, or ask about courses after the administrator adds an AI provider key.',
            ];
        }

        $system = "You are SarkariCourse's helpful study assistant. Give concise, accurate preparation guidance. Never invent course availability, exam dates, scores, or policies. Do not request passwords, OTPs, or sensitive information.";

        try {
            $response = Http::timeout(20)
                ->acceptJson()
                ->withToken($key)
                ->post(config('services.ai.endpoint'), [
                    'model' => config('services.ai.model'),
                    'messages' => array_merge([['role' => 'system', 'content' => $system]], $history),
                    'temperature' => 0.4,
                    'max_tokens' => 500,
                    'user' => (string) $user->id,
                ]);

            $content = $response->successful() ? data_get($response->json(), 'choices.0.message.content') : null;

            if (is_string($content) && filled($content)) {
                return ['configured' => true, 'content' => trim($content)];
            }
        } catch (\Throwable) {
            // A friendly fallback keeps the support UI useful during provider outages.
        }

        return [
            'configured' => true,
            'content' => 'I could not reach the AI service right now. Please try again shortly or contact our support team.',
        ];
    }
}
