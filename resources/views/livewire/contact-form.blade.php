<div>
    <form wire:submit.prevent="submit">
        <div class="xl:w-1/2 w-full">
            <div class="sm:columns-1 columns-1 mt-2">
                <div class="form-group mt-4 sm:mt-0">
                    <div>
                        <p class="block mb-2 mt-2">{{ __('text.recepient') }} *</p>
                        <select name="recepient" class="rounded mb-3" wire:model="recepient">
                            <option value="">{{ __('text.select-recepient') }}</option>
                            @foreach ($users as $user)
                                <option value="{{$user->email}}" @if ($user->email === $recepient) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('recepient')
                            <span class="text-red-500 text-sm block">{{ $message }}</span>
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
                        <span class="text-red-500 text-sm block">{{ $message }}</span>
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
                        <span class="text-red-500 text-sm block">{{ $message }}</span>
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
                        <span class="text-red-500 text-sm block">{{ $message }}</span>
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
                        'additional' => 'wire:model="tel"'
                    ])
                    @error('tel')
                        <span class="text-red-500 text-sm block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr class="mt-2 md:mb-4 mb-3" />
            <label for="message" class="block mb-2 mt-2 text-sm">{{ __('text.message') }} *</label>
            <textarea name="message" id="message" class="w-full p-2 border rounded" rows="10" wire:model="message" required></textarea>
            @error('message')
                <span class="text-red-500 text-sm block">{{ $message }}</span>
            @enderror
            <input type="submit" id="contact-submit" value="{{ __('text.submit') }}" class="mt-2 p-4 btn">
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
