@extends('layouts.main')

@section('content')
<link href="template/css/blocked.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:500,700,900" rel="stylesheet">

<div id="sign-wrapper">
  <div id="hole1" class="hole"></div>
  <div id="hole2" class="hole"></div>
  <div id="hole3" class="hole"></div>
  <div id="hole4" class="hole"></div>
  <header id="header">
    <h1>Oops!</h1>

  </header>
  <section id="sign-body">
    <div id="copy-container">
      <h2>Your account is blocked</h2>
      <p>Please contact the admin for further assistance.</p>
      <div style="text-align: center;">
      <a href="{{ route('contacts') }}" class="btn btn-danger mt-4">Contact Us</a>
      </div>
    </div>
    <div id="circle-container">
      <svg version="1.1" viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
        <defs>
          <pattern id="image" patternUnits="userSpaceOnUse" height="450" width="450">
            <image x="25" y="25" height="450" width="450" xlink:href="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png"></image>
          </pattern>
        </defs>
        <circle cx="250" cy="250" r="200" stroke-width="40px" stroke="#ef5350" fill="url(#image)"/>
        <line x1="100" y1="100" x2="400" y2="400" stroke-width="40px" stroke="#ef5350"/>
      </svg>
    </div>
  </section>
</div>

@endsection
