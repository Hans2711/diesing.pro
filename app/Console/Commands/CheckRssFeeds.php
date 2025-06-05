<?php

namespace App\Console\Commands;

use App\Models\RssFeed;
use App\Mail\RssFeedNotification;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Console\Command;
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
                        SendEmail::dispatch(
                            $user->email,
                            new RssFeedNotification(
                                $feed->url,
                                $latest,
                                (string)($item->description ?? ''),
                                (string)($item->link ?? ''),
                                (string)($item->pubDate ?? ''),
                                app()->getLocale(),
                            )
                        );
                    }
                }
            } catch (\Exception $e) {
                Log::error('RSS feed check failed: ' . $e->getMessage());
            }
        });
    }
}
