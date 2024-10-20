@extends('layouts.app', ['title' => 'Kontakt', 'active' => 'contact'])

@section('content')
    @vite(['resources/js/contact.js', 'resources/css/contact.css'])
    <h1>Kontakt</h1>

    <form method="POST" action="#" id="contact-form">
    @csrf
    <div class="xl:w-1/2 w-full">
        <div class="sm:columns-2 columns-1 mt-2">
            <div class="form-group mt-4 sm:mt-0">
                @include('private.modals.parts.floating-label-input', ['id' => 'name', 'name' => 'name', 'label' => 'Name', 'wrapperClass' => 'w-full sm:w-auto', 'tabindex' => 1, 'required' => true])
            </div>
            <div class="form-group mt-4 sm:mt-0">
                @include('private.modals.parts.floating-label-input', ['id' => 'firma', 'name' => 'firma', 'label' => 'Firma', 'wrapperClass' => 'w-full sm:w-auto', 'tabindex' => 2])
            </div>
        </div>
        <hr class="md:my-5 mb-0 mt-5" />
        <div class="sm:columns-2 columns-1 mt-2">
            <div class="form-group mt-4 sm:mt-0">
                @include('private.modals.parts.floating-label-input', ['id' => 'email', 'name' => 'email', 'label' => 'E-Mail', 'wrapperClass' => 'w-full sm:w-auto', 'tabindex' => 3, 'required' => true])
            </div>
            <div class="form-group mt-4 sm:mt-0">
                @include('private.modals.parts.floating-label-input', ['id' => 'tel', 'name' => 'tel', 'label' => 'Tel. Nr.', 'wrapperClass' => 'w-full sm:w-auto', 'tabindex' => 4, 'required' => true])
            </div>
        </div>
        <hr class="md:my-5 md:mb-4 mb-3 mt-5" />
        <label for="message" class="block mb-2 mt-2 text-sm">Nachricht *</label>
        <textarea name="message" id="message" class="w-full p-2 border rounded " rows="10" required></textarea>

        <input type="submit" value="Abschicken" class="mt-2 p-4 btn">
    </div>
</form>
<p class="form-message"></p>
@endsection
