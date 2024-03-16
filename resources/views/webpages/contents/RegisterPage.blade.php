@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ asset('css/webpages/register.css') }}" rel="stylesheet">

  <div class="background">
    <div class="goHome">
      <a href="#"><i class="fa-solid fa-circle-chevron-left"></i></a>
    </div>
    <div class="container">
      <div class="register text-center">
        <h1 style="margin-bottom: 35px">Register</h1>
        <form (ngSubmit)="onSubmit()" [formGroup]="registrationForm">
          <div>
            <input
              class="input"
              type="text"
              id="username"
              name="username"
              formControlName="username"
              placeholder="Username"
              required />
          </div>
          <div>
            <input
              class="input"
              type="email"
              id="email"
              name="email"
              formControlName="email"
              placeholder="Email"
              required />
          </div>
          <div>
            <input
              class="input"
              type="text"
              id="phone"
              name="phone"
              formControlName="phone"
              placeholder="Phone Number"
              required />
          </div>
          <div
            class="test"
            *ngIf="
              registrationForm.get('phone')?.hasError('invalidPhone') &&
              (registrationForm.get('phone')?.touched ||
                !registrationForm.get('phone')?.pristine)
            ">
            Phone number must be exactly 10 digits.
          </div>
          <div>
            <input
              class="input"
              type="password"
              id="password"
              name="password"
              formControlName="password"
              placeholder="Password"
              required />
          </div>
          <div>
            <input
              class="input"
              type="password"
              id="confirmPassword"
              name="confirmPassword"
              formControlName="confirmPassword"
              placeholder="Confirm Password"
              required />
          </div>
          <div
            class="test"
            *ngIf="
              registrationForm.hasError('passwordMismatch') &&
              registrationForm.get('confirmPassword')?.value
            ">
            Passwords do not match.
          </div>
          <hr style="margin-bottom: 45px" />
          <button class="googleButton flex items-center justify-center" type="submit">
            <img
              src="../../../assets/images/google_image.png"
              width="45px"
              height="30px"
              alt="" />Sign in with google</button
          ><br />
          <div>Already have an account? <a href="login">log in</a></div>
          <br />
          <button class="registerButton" type="submit">Register</button>
        </form>
      </div>
    </div>
  </div>


@endsection