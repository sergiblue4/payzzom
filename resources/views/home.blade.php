@extends('layouts.app')

@section('content')

<body data-gr-c-s-loaded="true">

<div class="main-content">
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-12 col-lg-8 col-md-8 col-xl-5">

<div class="header mt-md-5">
<div class="header-body">
<div class="row align-items-center">
<div class="col">

<h6 class="header-pretitle">
Connect To Stripe
</h6>

<h3 class="header-title">
Powered by Payzzom
</h3>
</div>
</div> 
</div>
</div>

<div class="card card-body p-5">
<div class="row">
<div class="col text-center">

<h2 class="mb-2">
Let's Do This 
</h2>
<form method="post" action="/recur/donempresa/gPgnLQT-6mw/create/">

<a href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id={{ env('STRIPE_CLIENT_ID') }}&scope=read_write&redirect_uri={{ route('stripeConnect') }}&state={{ csrf_token() }}" type="submit" class="btn btn-primary btn-block">Connect To Stripe</a>

</form>
</div>
</div> 
<div class="row">
<div class="col-12">
<hr class="mb-5 mt-4">

<h6 class="text-uppercase">
description
</h6>

<p class="text-muted mb-0">
adfsdf
</p>
</div>
</div> 
</div>
</div>
</div> 
</div>
</div> 

@endsection