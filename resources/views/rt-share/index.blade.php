@extends('layouts.app', ['title' => __('titles.rt-share'), 'description' => __('descriptions.rt-share')])

@section('content')
    <h1>{{ __('text.rt-share') }}</h1>

   @vite('resources/js/rt-share.js')

    <div class="share-wrapper">
    </div>

    <script type="text/template" id="user-template">
        <div class="user-block" data-userid="<%- userID %>">
            <p>User ID: <%- userID %> <% if (current) { %>(Current) <% } %></p>
            <input type="text" placeholder="Enter message" class="user-input" />
            <button class="send-btn">Send</button>
            <br>
            <input type="file" class="file-input" />
            <button class="file-send-btn">Send File</button>
        </div>
    </script>
@endsection

