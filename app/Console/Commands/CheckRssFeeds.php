<?php

namespace App\Console\Commands;

use App\Models\RssFeed;
use App\Mail\RssFeedNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckRssFeeds extends Command
{
    protected $signature = 'rss-feed:check';
    protected $description = 'Check RSS feeds for new items';

    public function handle()
    {
        RssFeed::all()->each(function ($feed) {
            try {
                $xml = @simplexml_load_file($feed->url);
                if (!$xml || !isset($xml->channel->item[0])) {
                    return;
                }
                $item = $xml->channel->item[0];
                $latest = (string)($item->title ?? '');
                if ($feed->last_title !== $latest) {
                    $feed->last_title = $latest;
                    $feed->last_checked_at = now();
                    $feed->save();

                    $user = User::find($feed->user);
                    if ($user) {
                        Mail::to($user->email)
                            ->locale(app()->getLocale())
                            ->queue(new RssFeedNotification([
                            'url' => $feed->url,
                            'title' => $latest,
                            'description' => (string)($item->description ?? ''),
                            'link' => (string)($item->link ?? ''),
                            'pubDate' => (string)($item->pubDate ?? ''),
                        ], app()->getLocale()));
                    }
                }
            } catch (\Exception $e) {
                Log::error('RSS feed check failed: ' . $e->getMessage());
            }
        });
    }
}
