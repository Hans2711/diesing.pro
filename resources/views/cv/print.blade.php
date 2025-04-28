@extends('layouts.minimal', ['title' => $user->name . "'s " . __('text.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv', 'print' => true, 'dark' => false])

@section('content')
<style>
        body {
            color: #000 !important;
            background: #fff !important;
        }

        .bg-white {
            background-color: #fff !important;
        }

        .text-white,
        .text-gray-100,
        .text-gray-200,
        .text-gray-300,
        .text-gray-400,
        .text-gray-500,
        .text-gray-600,
        .text-gray-700,
        .text-gray-800,
        .text-gray-900 {
            color: #000 !important;
        }

        .border,
        .border-gray-300,
        .border-gray-800 {
            border-color: #E5E7EB !important;
        }


        /* Optional: improve contrast on shadowed elements */
        .shadow-sm, .shadow {
            box-shadow: none !important;
        }
        .page-break {
            page-break-after: always;
        }
</style>

    @include('cv.content', ['cv' => $cv, 'user' => $user, 'print' => true])
@endsection

