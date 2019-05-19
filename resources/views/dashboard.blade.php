@extends('layouts.app')

@section('content')

@include('inc.dashboardnav')

<div class="main-content">
<style>
.iti-flag {
  background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/img/flags.png");
}
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
    .iti-flag {
      background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/img/flags@2x.png");
    }
}
</style>

<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col">
                    <h6 class="header-pretitle">overview</h6>
                    <h1 class="header-title">Dashboard</h1>
                </div>
                <div class="col-auto">
                    <a href="/dashboard/logout" class="btn btn-dark">Logout</a>
                </div>
            </div>
        </div> 
    </div>
</div> 

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-2">Company</h6>
                            <span class="h2 mb-0">{{ auth()->user()->first_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-6 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-2">Direct Pay link</h6>
                            <div>
                                <input type="text" class="form-control form-control-rounded form-control-sm text-truncate" id="copy-text" value="{{ route('directChargeUser', ['user_name' => strtolower(auth()->user()->first_name), 'user_id' => auth()->user()->id]) }}" readonly>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class='btn btn-primary btn-sm mt-3 ml-0' id='copy-btn' data-clipboard-text="fokfokfofkof" onclick="tectCopied()">Copy</button>
                            <small class='text-success mt-3 ml-0' id='y' style='display: none;'>Copied!</small>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <script src="https://kareemcoding.github.io/assets/libs/clipboard/clipboard.min.js" type="text/javascript"></script>
      
      <script type="text/javascript">
          new ClipboardJS('.btn');

      </script>
      <script type="text/javascript">
          function tectCopied() {
              var x = document.getElementById("copy-btn");
              var y = document.getElementById("y");

              var copyText = document.getElementById("copy-text");
              
              copyText.select();

              /* Copy the text inside the text field */
              document.execCommand("copy");

              x.style.display = "none";

              y.style.display = "block";

          }
      </script>

        <div class="col-12 col-lg-6 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-2">Active Payment Requests</h6>
                            <div class="row align-items-center no-gutters">
                                <div class="col-auto">
                                    <span class="h2 mr-2 mb-0">{{ count($charges) }}</span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">Recent Payments</h4>
                        </div>
                        <div class="col-auto">
                            <a href="/dashboard/charges" class="btn btn-sm btn-white">View all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" class="text-muted ">Name</a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted ">Status</a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted ">Amount</a>
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($charges as $payment)
                            <tr>
                                <td class="goal-project">
                                   {{ $payment->name }}
                                </td>
                                <td class="goal-status">
                                    @if($payment->paid == 'true')
                                    <span class="text-success">●</span> Paid
                                    @else
                                    <span class="text-warning">●</span> Unpaid
                                    @endif
                                </td>
                                <td class="goal-progress">
                                   €{{ $payment->amount }}
                                </td>
                                <td class="goal-date">
                                    <a class="btn btn-sm btn-dark" href="{{ route('getPaymentLink', ['charge_id' => $payment->id]) }}"> See details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">Create Payment Request</h4>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('createPaymentLink') }}" method="POST" id='paymentRequestForm'>
                                {{ csrf_field() }}
                                <button type="reset" class="btn btn-sm btn-secondary">Start again</button>
                                <div class='card-body'>
                                    <div class='row'>
                                        <div class='col-12 col-xl-6'>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name="name" maxlength="100" required class="form-control" placeholder="Enter full name">
                                            </div>
                                        </div>
                                        <div class='col-12 col-xl-6'>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name='email' placeholder="Enter email" maxlength="254" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Phone number</label>
                                        <div class="input-group mb-2">
                                            <input id="phone" type="tel" name="phone" class="form-control">
                                            <!--<input id='hidden_phone' type="text" name='phone' style='display:none;'>-->
                                        </div>
                                        <small class='text=muted'>If entered will send them a payment link via text (optional)</small>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input name="send_email" type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                            <label class="custom-control-label" for="customSwitch1">Send email with a payment link</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Enter an amount</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">€</div>
                                                <input type="number" name="amount" class="form-control" id="inlineFormInputGroup" placeholder="Enter amount" step='0.01' min='1' max='999999' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Charge Description</label>
                                        <textarea name="description" maxlength="500" class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Enter a description for this charges" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{ var_dump($errors) }}
@endsection
