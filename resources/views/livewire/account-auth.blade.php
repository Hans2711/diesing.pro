<div>
    @if($type == null)
        <div wire:trasition>
            <div class="mb-5">
                {!! __('text.account_text') !!}
            </div>
            <form wire:submit.prevent="begin">
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="login"',
                    'id' => 'login',
                    'name' => 'login',
                    'label' => __('text.username_or_email'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 1
                ])

                <button class="btn" type="submit">{{ __('text.login_register') }}</button>
            </form>
        </div>
    @endif

    @if($type == 'login')
        <div wire:trasition>
            <form wire:submit.prevent="loginUser">
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="login"',
                    'id' => 'login',
                    'name' => 'login',
                    'label' => __('text.username_or_email'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 1
                ])

                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="password"',
                    'id' => 'password',
                    'name' => 'password',
                    'label' => __('text.password'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 2,
                    'type' => 'password'
                ])

                <button class="btn" type="submit">{{ __('text.login') }}</button>
            </form>
        </div>
    @endif

    @if($type == 'register')
        <div wire:trasition>
            <h2>{{ __('text.register') }}</h2>
            <form wire:submit.prevent="register">
                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="username"',
                    'id' => 'username',
                    'name' => 'username',
                    'label' => __('text.username'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 1
                ])

                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="email"',
                    'id' => 'email',
                    'name' => 'email',
                    'label' => __('text.email'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 2
                ])

                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="name"',
                    'id' => 'name',
                    'name' => 'name',
                    'label' => __('text.name'),
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 3
                ])

                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="password"',
                    'id' => 'password',
                    'name' => 'password',
                    'label' => __('text.password'),
                    'type' => 'password',
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 4
                ])

                @include('global.partials.floating-label-input', [
                    'additional' => 'wire:model="passwordConfirm"',
                    'id' => 'password-confirm',
                    'name' => 'passwordConfirm',
                    'label' => __('text.confirm_password'),
                    'type' => 'password',
                    'wrapperClass' => 'w-full md:w-auto mb-3',
                    'tabindex' => 5
                ])

                <button class="btn" type="submit">{{ __('text.register') }}</button>
            </form>
        </div>
    @endif

    <input type="hidden" wire:model="returnUrl" value="">

    <div class="mt-3">
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
