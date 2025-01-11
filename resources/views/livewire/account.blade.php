<div>
    <p>{{ __('text.logged_in_as', ['name' => $user->name]) }}</p>

    <div class="p-2 border mb-3 rounded border-gray-700">
        <div class="grid grid-cols-2">
            <p><strong>{{ __('text.email') }}</strong></p>
            <p>{{ $user->email }}</p>
        </div>
        <div class="grid grid-cols-2">
            <p><strong>{{ __('text.username') }}</strong></p>
            <p>{{ $user->username }}</p>
        </div>
    </div>

    <h2>{{ __('text.permissions') }}</h2>
    <div class="p-2 border mb-3 rounded border-gray-700">
        <div class="grid grid-cols-3">
            <p><strong>{{ __('text.permission_name') }}</strong></p>
            <p><strong>{{ __('text.status') }}</strong></p>
            <p><strong>{{ __('text.action') }}</strong></p>
        </div>
        @foreach ($permissions as $key => $permission)
            @if (!empty($user->getPermissions()) &&
                is_array($user->getPermissions()) &&
                $user->getPermission($key))
                <div class="grid grid-cols-3 mb-3">
                    <p>{{ $permission }}</p>
                    <p>{{ __('text.access_granted') }}</p>
                </div>
            @else
                <div class="grid grid-cols-3 mb-3">
                    <p>{{ $permission }}</p>
                    <p>{{ __('text.no_access') }}</p>
                    <button class="btn" id="{{ $key }}" wire:click="requestAccess($event.target.id)">{{ __('text.request_access') }}</button>
                </div>
            @endif
        @endforeach
    </div>

    <div class="mt-3 mb-3">
        @if (session()->has('status'))
            <div wire:transition.fade>
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif
    </div>
    <button class="btn" wire:click="logout">{{ __('text.logout') }}</button>
</div>
