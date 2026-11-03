<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YoutubeService
{
    /**
     * Fetch the latest videos from the configured YouTube channel.
     * Results are cached for a few hours to avoid burning API quota.
     *
     * Returns an empty collection (never throws) if the API key/channel id
     * are not configured, or if the request fails for any reason.
     */
    public function latestVideos(int $count = 2): array
    {
        $apiKey = config('services.youtube.key');
        $channelId = config('services.youtube.channel_id');
    
        if (empty($apiKey) || empty($channelId)) {
            return [];
        }

        return Cache::remember("youtube.latest_videos.{$channelId}.{$count}", now()->addHours(6), function () use ($apiKey, $channelId, $count) {
            try {
                $response = Http::timeout(8)->get('https://www.googleapis.com/youtube/v3/search', [
                    'key' => $apiKey,
                    'channelId' => $channelId,
                    'part' => 'snippet',
                    'order' => 'date',
                    'maxResults' => $count,
                    'type' => 'video',
                ]);

                if (! $response->successful()) {
                    Log::warning('YouTube API request failed', ['status' => $response->status()]);

                    return [];
                }

                $items = $response->json('items', []);

                return collect($items)->map(function ($item) {
                    return [
                        'video_id' => $item['id']['videoId'] ?? null,
                        'title' => $item['snippet']['title'] ?? '',
                        'description' => $item['snippet']['description'] ?? '',
                        'thumbnail' => $item['snippet']['thumbnails']['high']['url']
                            ?? $item['snippet']['thumbnails']['default']['url']
                            ?? null,
                        'published_at' => $item['snippet']['publishedAt'] ?? null,
                        'url' => isset($item['id']['videoId'])
                            ? 'https://www.youtube.com/watch?v='.$item['id']['videoId']
                            : null,
                    ];
                })->filter(fn ($video) => $video['video_id'])->values()->all();
            } catch (\Throwable $e) {
                Log::warning('YouTube API request threw an exception', ['message' => $e->getMessage()]);

                return [];
            }
        });
    }
}
