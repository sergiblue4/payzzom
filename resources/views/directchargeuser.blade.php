@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-12 col-lg-8 col-md-8 col-xl-5">

<div class="header mt-md-5">
<div class="header-body">
<div class="row align-items-center">
<div class="col">

<h6 class="header-pretitle">
Secure Payments
</h6>

<h3 class="header-title">
Powered by SuperPay
</h3>
</div>
</div> 
</div>
</div>

<div class="card card-body p-5">
<div class="row">
<div class="col ">
<div class="text-center">
</div>

<h2 class="mb-2 text-center">
{{ $check_user_exists->first_name }}
</h2>

<p class="text-muted mb-5 text-center">
{{ $check_user_exists->last_name }}
</p>
<form method="post">
@csrf
<input type="hidden" name="stripeToken" value="tok_visa">
<div class="row">
<div class="col-md-6">
<div id="div_id_first_name" class="form-group  ">
<label for="id_first_name" class="control-label required-field  ">
Name
</label>
<div class="">
<input type="text" name="name" maxlength="50" class=" form-control" placeholder="Enter your name" required="" id="id_first_name">
</div>
</div>
</div>
<div class="col-md-6">
<div id="div_id_email" class="form-group  ">
<label for="id_email" class="control-label required-field  ">
Email
</label>
<div class="">
<input type="email" name="email" class=" form-control  " placeholder="Enter your email" id="id_email">
</div>
</div>
</div>
</div>
<div id="div_id_product_description" class="form-group  ">
<label for="id_product_description" class="control-label required-field ">
What is this payment for?
</label>
<div class="">
<textarea type="url" name="description" maxlength="150" class=" form-control" id="product_description" style="height:85px;" required="" placeholder="Enter a description"></textarea>
</div>
</div>
<label>Amount</label>
<div class="input-group mb-2">
<div class="input-group-prepend">
<div class="input-group-text">€</div>
</div>
<input name="amount" type="number" step="0.01" class="form-control" id="inlineFormInputGroup" placeholder="Enter amount" min="1" max="99999999" title="Amount must be between £1 and £999,999.99" required="">
</div>

<button type="submit" class="mt-5 mb-5 btn btn-primary btn-lg btn-block">Next</button>
</form>
</div>
</div> 
</div>
</div>
</div> 


</div></div>
@endsection