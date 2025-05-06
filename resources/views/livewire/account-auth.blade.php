<div>
    <form wire:submit.prevent="{{ $type === 'login' ? 'loginUser' : ($type === 'register' ? 'register' : 'begin') }}">
        <div class="mb-5">
            {!! __('text.account_text') !!}
        </div>

        @if($type === null || $type === 'login' || $type === 'begin')
            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="login"',
                    'id' => 'login',
                    'name' => 'login',
                    'label' => __('text.username_or_email'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 1
                ])
            </div>
        @endif

        @if($type === 'login')
            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="password"',
                    'id' => 'password',
                    'name' => 'password',
                    'label' => __('text.password'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 2,
                    'type' => 'password'
                ])
            </div>
        @endif

        @if($type === 'register')
            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="username"',
                    'id' => 'username',
                    'name' => 'username',
                    'label' => __('text.username'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 1
                ])
            </div>

            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="email"',
                    'id' => 'email',
                    'name' => 'email',
                    'label' => __('text.email'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 2
                ])
            </div>

            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="name"',
                    'id' => 'name',
                    'name' => 'name',
                    'label' => __('text.name'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 3
                ])
            </div>

            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="password"',
                    'id' => 'password',
                    'name' => 'password',
                    'label' => __('text.password'),
                    'type' => 'password',
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 4
                ])
            </div>

            <div wire:transition.fade>
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="passwordConfirm"',
                    'id' => 'password-confirm',
                    'name' => 'passwordConfirm',
                    'label' => __('text.confirm_password'),
                    'type' => 'password',
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 5
                ])
            </div>
        @endif


        <div class="flex items-center gap-4">
            <button class="btn" wire:loading.class="opacity-50" wire:loading.attr="disabled" type="submit">
                {{ $type === 'login' ? __('text.login') : ($type === 'register' ? __('text.register') : __('text.login_register')) }}
            </button>
            @if ($type != 'begin')
            <a class="flex items-center gap-2 py-auto hover:cursor-grab btn-back dark:invert dark:text-secondary-dark" href="javascript:void(0);" onclick="location.reload();">
                    <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" alt="Back Icon" />
                    <span class="leading-none">
                        {{ __('text.back') }}
                    </span>
                </a>
            @endif
        </div>
    </form>

    <input type="hidden" wire:model="returnUrl" value="">

    <div class="mt-3">
        @if (session()->has('error'))
            <div wire:transition.fade>
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
        @endif
    </div>
</div>

@script
<script>
Livewire.hook('morphed',  (componet) => {
    if (componet.component.canonical.type == 'login') {
        setTimeout(() => {
            let passwordInput = document.querySelector('#password');
            passwordInput.focus();
        }, 155);
    }
    if (componet.component.canonical.type == 'register') {
        setTimeout(() => {
            let usernameInput = document.querySelector('#username');
            usernameInput.focus();
        }, 155);
    }
})
</script>
@endscript
