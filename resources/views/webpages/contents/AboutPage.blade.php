<title>About | LuxidDream</title>

@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ asset('css/webpages/aboutpage.css') }}" rel="stylesheet">

  <div class="banner">
      <div class="story p-8 max-md:p-4 h-full flex justify-center items-center">
        <div class="w-[78vw] max-md:w-[90vw] m-auto px-8 max-md:px-3 rounded-md">
              @php
                  $AboutPages = [];
                  for ($i = 1; $i <= 13; $i++) {
                      $AboutPages[] = 'aboutTH_' . $i . '.png';
                  }
              @endphp

              @include('webpages.components.Slider', ['Pages' => $AboutPages])
        </div>
      </div>
  </div>

@endsection