<div>
    <form wire:submit.prevent="submit">
        <div class="xl:w-1/2 w-full">
            <div class="sm:columns-1 columns-1 mt-2">
                <div class="form-group mt-4 w-full sm:mt-0">
                    <div>
                        <p class="block mb-2 mt-2">{{ __('text.recipient') }} *</p>
                        <select name="recipient" class="rounded mb-3 dark:bg-secondary-light w-full md:w-fit" wire:model="recipient">
                            <option value="">{{ __('text.select-recipient') }}</option>
                            @foreach ($users as $user)
                                @if ($user->portfolios->count() > 0)
                                    <option value="{{$user->email}}" @if ($user->email === $recipient) selected @endif>{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('recipient')
                            <span class="text-primary-dark dark:text-primary-light text-sm block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="md:mb-5 mb-0 mt-2" />
            <div class="sm:columns-2 columns-1 mt-2">
                <div class="form-group mt-4 sm:mt-0">
                    @include('global.partials.floating-label-input', [
                        'id' => 'name',
                        'name' => 'name',
                        'label' => 'Name',
                        'wrapperClass' => 'w-full sm:w-auto mb-3',
                        'tabindex' => 1,
                        'required' => true,
                        'additional' => 'wire:model="name"'
                    ])
                    @error('name')
                        <span class="text-primary-dark dark:text-primary-light text-sm block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-4 sm:mt-0">
                    @include('global.partials.floating-label-input', [
                        'id' => 'firma',
                        'name' => 'firma',
                        'label' => __('text.company'),
                        'wrapperClass' => 'w-full sm:w-auto mb-3',
                        'tabindex' => 2,
                        'additional' => 'wire:model="firma"'
                    ])
                    @error('firma')
                        <span class="text-primary-dark dark:text-primary-light text-sm block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr class="md:mb-5 mb-0 mt-2" />
            <div class="sm:columns-2 columns-1 mt-2">
                <div class="form-group mt-4 sm:mt-0">
                    @include('global.partials.floating-label-input', [
                        'id' => 'email',
                        'name' => 'email',
                        'label' => __('text.email'),
                        'wrapperClass' => 'w-full sm:w-auto mb-3',
                        'tabindex' => 3,
                        'required' => true,
                        'additional' => 'wire:model="email"'
                    ])
                    @error('email')
                        <span class="text-primary-dark dark:text-primary-light text-sm block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-4 sm:mt-0">
                    @include('global.partials.floating-label-input', [
                        'id' => 'tel',
                        'name' => 'tel',
                        'label' => __('text.mobile'),
                        'wrapperClass' => 'w-full sm:w-auto mb-3',
                        'tabindex' => 4,
                        'required' => true,
                        'additional' => 'wire:model="tel" autocomplete="tel"'
                    ])
                    @error('tel')
                        <span class="text-primary-dark dark:text-primary-light text-sm block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr class="mt-2 md:mb-4 mb-3" />
            <label for="message" class="block mb-2 mt-2 text-sm">{{ __('text.message') }} *</label>
            <textarea name="message" id="message" class="w-full p-2 border rounded dark:bg-secondary-light" tabindex="5" rows="10" wire:model="message" required></textarea>
            @error('message')
                <span class="text-red-500 text-sm block">{{ $message }}</span>
            @enderror
            <button type="submit" id="contact-submit" tabindex="6" class="mt-2 p-4 btn flex items-center gap-2" wire:loading.attr="disabled">
                <img wire:loading.remove class="w-6 h-6 invert" src="{{ Vite::asset('resources/icons/envelope.svg') }}" alt="Send" title="Send" />
                <span wire:loading.remove>{{ __('text.submit') }}</span>
                <img wire:loading class="w-4 h-4 animate-spin invert" src="{{ Vite::asset('resources/icons/sync.svg') }}" alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}" />
            </button>
        </div>
    </form>

    <div class="mt-3">
        @if (session()->has('status'))
            <div wire:transition.fade>
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif
    </div>
</div>
