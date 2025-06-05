<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $fields
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListModel> $lists
 * @property-read int|null $lists_count
 * @method static \Database\Factories\CvFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereUpdatedAt($value)
 */
	class Cv extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $key
 * @property string $html
 * @property-read mixed $created_clean_at
 * @method static \Database\Factories\DiffstoreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Diffstore whereUpdatedAt($value)
 */
	class Diffstore extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $path
 * @property string $model
 * @property string $foreign_id
 * @method static \Database\Factories\FileReferenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference whereForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileReference whereUpdatedAt($value)
 */
	class FileReference extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $content
 * @property \App\Models\Cv|null $cv
 * @property int $sort_order
 * @property int $column
 * @property int $pagebreak
 * @method static \Database\Factories\ListModelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereCv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel wherePagebreak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListModel whereUpdatedAt($value)
 */
	class ListModel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $content
 * @property int|null $share
 * @property string $slug
 * @property int $enable_password
 * @property string $password
 * @property string|null $user
 * @method static \Database\Factories\NoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereEnablePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUser($value)
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string|null $user
 * @property-read mixed $media
 * @method static \Database\Factories\PortfolioFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereUser($value)
 */
	class Portfolio extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property string $target
 * @property string $code
 * @property string|null $user
 * @property-read mixed $url
 * @method static \Database\Factories\RedirectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Redirect whereUser($value)
 */
	class Redirect extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $ip
 * @property string $geo
 * @property string $agent
 * @property string|null $redirect
 * @method static \Database\Factories\RedirectHitFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereGeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RedirectHit whereUpdatedAt($value)
 */
	class RedirectHit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user
 * @property string $url
 * @property string|null $last_title
 * @property string|null $last_checked_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereLastCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereLastTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RssFeed whereUser($value)
 */
	class RssFeed extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $html
 * @property string $headers
 * @property string $testrun_id
 * @property-read mixed $created_at_clean
 * @property-read \App\Models\Testrun $testrun
 * @method static \Database\Factories\TestinstanceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereTestrunId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testinstance whereUpdatedAt($value)
 */
	class Testinstance extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $url
 * @property int $delete_after
 * @property string|null $user
 * @property array<array-key, mixed>|null $sitemaps
 * @property-read mixed $created_at_clean
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Testrun> $testruns
 * @property-read int|null $testruns_count
 * @method static \Database\Factories\TestobjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereDeleteAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereSitemaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testobject whereUser($value)
 */
	class Testobject extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $testobject_id
 * @property string|null $name
 * @property string|null $url
 * @property-read mixed $created_at_clean
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Testinstance> $testinstances
 * @property-read int|null $testinstances_count
 * @property-read \App\Models\Testobject $testobject
 * @method static \Database\Factories\TestrunFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereTestobjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testrun whereUrl($value)
 */
	class Testrun extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $times
 * @property string|null $user
 * @method static \Database\Factories\TimetrackFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timetrack whereUser($value)
 */
	class Timetrack extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $username
 * @property string|null $permissions
 * @property string|null $permissions_token
 * @property \App\Models\Cv|null $cv
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Portfolio> $portfolios
 * @property-read int|null $portfolios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Redirect> $redirects
 * @property-read int|null $redirects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RssFeed> $rssFeeds
 * @property-read int|null $rss_feeds_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Testobject> $testobjects
 * @property-read int|null $testobjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Timetrack> $timetracks
 * @property-read int|null $timetracks_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePermissionsToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

