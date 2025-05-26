<div>
    <div class="mb-5">
        {!! __('text.account_text') !!}
    </div>

    <form wire:submit.prevent="loginUser" class="mb-6">
        <h2 class="text-lg font-bold mb-2">{{ __('text.login') }}</h2>
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="login"',
            'id' => 'login',
            'name' => 'login',
            'label' => __('text.username_or_email'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 1
        ])
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="loginPassword"',
            'id' => 'login-password',
            'name' => 'loginPassword',
            'label' => __('text.password'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 2,
            'type' => 'password'
        ])
        <button class="btn" wire:loading.class="opacity-50" wire:loading.attr="disabled" type="submit">
            {{ __('text.login') }}
        </button>
    </form>

    <form wire:submit.prevent="register">
        <h2 class="text-lg font-bold mb-2">{{ __('text.register') }}</h2>
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="username"',
            'id' => 'username',
            'name' => 'username',
            'label' => __('text.username'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 3
        ])
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="email"',
            'id' => 'email',
            'name' => 'email',
            'label' => __('text.email'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 4
        ])
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="name"',
            'id' => 'name',
            'name' => 'name',
            'label' => __('text.name'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 5
        ])
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="registerPassword"',
            'id' => 'register-password',
            'name' => 'registerPassword',
            'label' => __('text.password'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 6,
            'type' => 'password'
        ])
        @include('global.partials.floating-label-input', [
            'additional' => 'wire:model="registerPasswordConfirm"',
            'id' => 'register-password-confirm',
            'name' => 'registerPasswordConfirm',
            'label' => __('text.confirm_password'),
            'wrapperClass' => 'w-full md:w-auto mb-3',
            'tabindex' => 7,
            'type' => 'password'
        ])
        <button class="btn" wire:loading.class="opacity-50" wire:loading.attr="disabled" type="submit">
            {{ __('text.register') }}
        </button>
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
