@extends('layouts.private', ['title' => 'Dateien', 'active' => 'private', 'activeTool' => 'files'])

@section('tool-content')
@vite(['resources/js/files.js'])

<form action="/privater-bereich/dateien/update" id="files-dropzone" class="dropzone w-96 h-80 border-solid border-2 rounded flex items-center justify-center flex-row">
  @csrf
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>

<div class="dz-preview dz-file-preview hidden">
  <div class="dz-details">
    <div class="dz-filename"><span data-dz-name></span></div>
    <div class="dz-size" data-dz-size></div>
    <img data-dz-thumbnail />
  </div>
  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
  <div class="dz-success-mark"><span>✔</span></div>
  <div class="dz-error-mark"><span>✘</span></div>
  <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>

@endsection

