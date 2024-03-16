@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ secure_asset('css/webpages/accountpage.css') }}" rel="stylesheet">

  <div class="banner">
    <div class="story">
      <div class="flex items-center justify-center">
        <div class="box m-5 px-5 w-[50%]">
          <div class="pt-4 fs-4">Account Information</div>
          <hr />
          <div class="grid grid-cols-2">
            <div>Username</div>
            <div>userDetails.username</div>
          </div>
          <div class="grid grid-cols-2">
            <div>Email</div>
            <div>userDetails.email</div>
          </div>
          <div class="grid grid-cols-2">
            <div>Phone</div>
            <div>userDetails.phone</div>
          </div>
          <div class="grid grid-cols-2">
            <div>Match History</div>
            <div>userDetails.static_data.score_play times</div>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="">
          <ul class="flex ulcss">
            <li class="link">Terms of Service</li>
            <li class="link">Privacy Policy</li>
            <li class="link">FAQ</li>
            <li class="link">Contact Us</li>
          </ul>
        </div>
        <div class="text-center">
          Copyright © COGNOSPHERE. All Rights Reserved.
        </div>
      </div>
    </div>
  </div>

@endsection