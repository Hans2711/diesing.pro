<div>
    <p>{{ __('text.logged_in_as', ['name' => $user->name]) }} @if ($user->isAdmin()) (Admin) @endif</p>

    <div class="p-2 border mb-3 rounded border-primary-dark dark:border-primary-light">
        @if ($edit)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @include('global.partials.floating-label-input', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => __('text.name'),
                    'livewire' => true,
                    'wrapperClass' => 'w-full mb-3',
                ])
                @include('global.partials.floating-label-input', [
                    'id' => 'email',
                    'name' => 'email',
                    'label' => __('text.email'),
                    'livewire' => true,
                    'wrapperClass' => 'w-full mb-3',
                ])
                @include('global.partials.floating-label-input', [
                    'id' => 'password',
                    'name' => 'password',
                    'label' => __('text.password'),
                    'type' => 'password',
                    'livewire' => true,
                    'wrapperClass' => 'w-full mb-3',
                ])
                @include('global.partials.floating-label-input', [
                    'id' => 'passwordConfirm',
                    'name' => 'passwordConfirm',
                    'label' => __('text.confirm_password'),
                    'type' => 'password',
                    'livewire' => true,
                    'wrapperClass' => 'w-full mb-3',
                ])
            </div>
            <div class="mt-3 flex gap-4 items-center">
                <button class="btn" wire:click="saveAccount">{{ __('text.save') }}</button>
                <a wire:click="cancelEdit" class="flex items-center gap-2 py-auto hover:cursor-grab btn-back dark:invert dark:text-secondary-dark">
                    <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" alt="Back Icon" />
                    <span class="leading-none">{{ __('text.back') }}</span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-2">
                <p><strong>{{ __('text.email') }}</strong></p>
                <p>{{ $user->email }}</p>
            </div>
            <div class="grid grid-cols-2">
                <p><strong>{{ __('text.username') }}</strong></p>
                <p>{{ $user->username }}</p>
            </div>
            <button class="btn mt-2" wire:click="editAccount">{{ __('text.edit') }}</button>
        @endif
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
        @if (session()->has('error'))
            <div wire:transition.fade>
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif
    </div>
    <button class="btn" wire:click="logout">{{ __('text.logout') }}</button>
</div>
