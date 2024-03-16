<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebpagesController extends Controller
{
    public function HomePage() {
        return view('webpages/contents/HomePage');
    }

    public function AboutPage() {
        return view('webpages/contents/AboutPage');
    }

    public function AccountPage() {
        return view('webpages/contents/AccountPage');
    }

    public function LoginPage() {
        return view('webpages/contents/LoginPage');
    }

    public function RegisterPage() {
        return view('webpages/contents/RegisterPage');
    }

    public function RulePage() {
        return view('webpages/contents/RulePage');
    }
}
