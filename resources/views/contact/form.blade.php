@extends('layouts.app', ['title' => 'Kontakt', 'active' => 'contact'])

@section('content')
    <h1>Kontakt</h1>

    <form method="POST" action="#">
    @csrf
    <div class="xl:w-1/2 w-full">
        <div class="sm:columns-2 columns-1 mt-2">
            <div class="form-group mt-4 sm:mt-0">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded bg-red-50" required>
            </div>
            <div class="form-group mt-4 sm:mt-0">
                <label for="firma" class="block mb-2">Firma</label>
                <input type="text" name="firma" id="firma" class="w-full p-2 border rounded bg-red-50" required>
            </div>
        </div>
        <hr class="mt-5" />
        <div class="sm:columns-2 columns-1 mt-2">
            <div class="form-group mt-4 sm:mt-0">
                <label for="email" class="block mb-2">E-Mail</label>
                <input type="text" name="email" id="email" class="w-full p-2 border rounded bg-red-50" required>
            </div>
            <div class="form-group mt-4 sm:mt-0">
                <label for="tel" class="block mb-2">Tel. Nr.</label>
                <input type="text" name="tel" id="tel" class="w-full p-2 border rounded bg-red-50" required>
            </div>
        </div>
        <hr class="mt-5" />
        <label for="message" class="block mb-2 mt-2">Nachricht</label>
        <textarea name="message" id="message" class="w-full p-2 border rounded bg-red-50" rows="10" required></textarea>

        <input type="submit" value="Abschicken" class="mt-2 p-4 btn" disabled>
    </div>
</form>
@endsection
