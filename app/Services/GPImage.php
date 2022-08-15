<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class GPImage
{
    public static function get(string $appId): string
    {
        $url = env('GOOGLE_PLAY_APP_HOST', 'https://play.google.com/store/apps/details?id=');
        $request = Http::get($url . $appId);
        if ($request->status() == '404') {
            return 'false';
        }
        $dom = new \DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body());
        $images = $dom->getElementsByTagName('img');
        $newImages = [];
        foreach ($images as $image) {
            if ($image->getAttribute('itemprop') == 'image' && $image->getAttribute('alt') == 'Icon image') {
                $newImages[] = $image->getAttribute('src');
            }
        }

        return $newImages[0];
    }
}