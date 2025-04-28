<div>
    <p>{{ __('text.logged_in_as', ['name' => $user->name]) }} @if ($user->isAdmin()) (Admin) @endif</p>

    <div class="p-2 border mb-3 rounded border-primary-dark dark:border-primary-light">
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
    <div class="p-2 border mb-3 rounded border-primary-dark dark:border-primary-light">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 mb-3">
                        <button class="btn mb-3 md:mb-0 btn-secondary" id="{{ $key }}" wire:click="requestAccess($event.target.id)">{{ __('text.request_access') }}</button>
                        <button class="btn m-0 md:mx-2 mb-2 md:mb-0 btn-delete" id="{{ $user->id }}" wire:click="deleteUser($event.target.id)" wire:confirm="Are you sure?">{{ __('text.delete') }}</button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @if ($user->isAdmin())
        <h2>{{ __('text.users') }}</h2>
        <div class="p-2 border mb-3 rounded border-primary-dark dark:border-primary-light">
            @foreach ($users as $user)
                <div class="grid grid-cols-3 mb-3">
                    <p>{{ $user->name }}</p>
                    <p>{{ $user->email }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <button class="btn m-0 md:mx-2 mb-2 md:mb-0 btn-delete" id="{{ $user->id }}" wire:click="deleteUser($event.target.id)" wire:confirm="Are you sure?">{{ __('text.delete') }}</button>
                        <button class="btn m-0 md:mx-2" id="{{ $user->id }}" wire:click="loginUser($event.target.id)">{{ __('text.login') }}</button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-3 mb-3">
        @if (session()->has('status'))
            <div wire:transition.fade>
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif
    </div>
    <button class="btn" wire:click="logout">{{ __('text.logout') }}</button>
</div>
