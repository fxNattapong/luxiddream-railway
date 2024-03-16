@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ asset('css/webpages/login.css') }}" rel="stylesheet">

  <div class="background">
    <div class="goHome">
      <a href="#"><i class="fa-solid fa-circle-chevron-left"></i></a>
    </div>
    <div class="container mx-auto">
      <div class="login text-center">
        <h1 class="uppercase text-3xl font-bold mb-[35px]">Log In</h1>
        <form (ngSubmit)="onSubmit()">
          <div>
            <!-- <label for="username">Username:</label> -->
            <input
              class="input"
              type="text"
              id="username"
              name="username"
              [(ngModel)]="username"
              placeholder="Username"
              required />
          </div>
          <div>
            <!-- <label for="password">Password:</label> -->
            <input
              class="input"
              type="password"
              id="password"
              name="password"
              [(ngModel)]="password"
              placeholder="Password"
              required />
          </div>
          <hr style="margin-bottom: 45px" />
          <button class="googleButton flex items-center justify-center" type="submit">
            <img
              src="../../../assets/images/google_image.png"
              width="45px"
              height="30px"
              alt="" />Sign in with google</button>
          <br />
          <div>Don't have an account? <a href="register">register</a></div>
          <br />
          <button class="logButton" type="submit">Log In</button>
        </form>
      </div>
    </div>
  </div>

@endsection