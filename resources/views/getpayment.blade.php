@extends('layouts.app')

@section('content')

<script src="https://js.stripe.com/v3/"></script>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-8 col-md-8 col-xl-5">
			<div class="header mt-md-5">
				<div class="header-body">
					<div class="row align-items-center">
						<div class="col">
							<h6 class="header-pretitle">Secure Payments</h6>
							<h3 class="header-title">Powered by Payzzom</h3>
						</div>
					</div> 
				</div>
			</div>

			<div class="card card-body p-5">
				<div class="row">
					<div class="col text-center">
						<h2 class="mb-2">{{ $user->first_name }}</h2>
						<p class="text-muted mb-5">{{ $user->last_name }}</p>
						<h1 class="display-2">€{{ $charges->amount }}</h1>
						<p class="lead mb-2">Payment request to {{ $charges->name }}</p>
						<p class="text-muted mb-5">{{ $charges->email }}</p>
						<button class="btn btn-primary btn-block btn-lg mb-3" data-toggle="modal" data-target="#payModal">Pay by card</button>
						<div id="payment-request-button" style="display: none;">
							<p class="text-muted text-center mt-4">Checking extra payment options</p>
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-12">
						<hr class="my-5">
						<h6 class="text-uppercase">charge description</h6>
						<p class="text-muted mb-0">{{ $charges->description }}</p>
					</div>
				</div> 
			</div>
		</div>
	</div> 
</div>

<div class="modal fade show" id="payModal" tabindex="-1" role="dialog" style="padding-right: 17px; display: none;" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-0">
				<p class="modal-title  mt-2 mb-0" id="exampleModalCenterTitle">Payment for {{ $user->first_name }}</p>
				<button type="button" class="btn btn-sm btn-dark " data-dismiss="modal">Cancel</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('createPayment', ['user_id' => $user->id ]) }}" method="post" id="payment-form">
				      {{ csrf_field() }}
				      <input type="hidden" name="amount" value="{{ $charges->amount }}00">
				      <input type="hidden" name="charge_id" value="{{ $charges->id }}">

				      <h1 class="display-2 text-center mt-3">€{{ $charges->amount }}</h1>
					  <div class="form-row">
					    <div class="form-group mt-0">
					      <label class="mb-10" for="card-element">
					        Credit Or Debit Card
					      </label>
						  
						  <div class="StripeElement StripeElement--empty" style="width: 30em" #stripecardelement id="card-element">
						        <!-- A Stripe Element will be inserted here. -->
						  </div>
						  

					      <!-- Used to display form errors. -->
					      <div style="width: 30em; height: 2em; letter-spacing: 0em" id="card-errors" role="alert"></div>
					    </div>
					  </div>

				  <button type="submit" class="btn btn-success btn-block">Pay now</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection