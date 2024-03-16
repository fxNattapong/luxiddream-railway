<title>Rule | LuxidDream</title>

@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ asset('css/webpages/rule-page.css') }}" rel="stylesheet">

  <div class="banner">
      <div class="story p-8 max-md:p-4">
        <div class="w-[78vw] max-md:w-[90vw] m-auto px-8 max-md:px-3 rounded-md" style="background: rgba(165, 143, 191, 255);">
            <h1 class="text-center text-3xl font-medium py-4">วิธีการเล่น</h1>
            @php
                $RulePages = [];
                for ($i = 1; $i <= 15; $i++) {
                    $RulePages[] = 'RulePageTH_' . $i . '.png';
                }
            @endphp

            @include('webpages.components.Slider', ['Pages' => $RulePages])

          <div class="flex items-center justify-center py-4">
            <div class="relative flex-col space-y-2">
              <button class="w-full bg-[#4e4299] hover:bg-indigo-900 rounded-full px-4 py-3 max-md:py-2 whitespace-nowrap overflow-hidden duration-300" (click)="downloadEN()">
                คู่มือการเล่นภาษาอังกฤษ
              </button>
              <button class="w-full bg-[#4e4299] hover:bg-indigo-900 rounded-full px-4 py-3 max-md:py-2 whitespace-nowrap overflow-hidden duration-300" (click)="downloadTH()">
                คู่มือการเล่นภาษาไทย
              </button>
            </div>
          </div>
        </div>
    </div>
  </div>
  
@endsection