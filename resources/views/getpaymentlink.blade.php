@extends('layouts.app')

@section('content')

@include('inc.dashboardnav')

<div class="main-content">
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-end">
                    <div class="col">
                        <h6 class="header-pretitle">specific charge</h6>
                        <h1 class="header-title">View Payment Request</h1>
                    </div>
                </div> 
            </div> 
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h1 class="header-title">{{ $charges->name }}</h1>
                                </div>
                                
                                <div class="col-auto mr-3">
                                    <div class="row">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deletePaymentRequest">Delete</button>

                                        <form action="/dashboard/charges/845/resend/" method="post">
                                            <input type="hidden" name="csrfmiddlewaretoken" value="vnr8kqpSnKTV89JKbqYrHi8QBxTYlNgNKcsef0oQOWzfUY3zpLVbDbl2ZDiWmzge">
                                            <button type="submit" class="btn btn-primary ml-2 ">Resend request</button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="card card-body p-5">
                        <div class="row">
                            <div class="col text-right">
                              @if($charges->paid == 'true')
                                <div class="badge badge-success">Paid</div>
                              @else
                                <div class="badge badge-warning">Unpaid</div>
                              @endif
                              </div>
                          </div> 
                          <div class="row">
                              <div class="col">
                                  <div class="text-center">
                                      <p id="amount" class="display-2 mb-3 ">€{{ $charges->amount }}</p>
                                      <h2 id="name" class="mb-2 font-weight-light">Billed to {{ $charges->name }}</h2>
                                      <p id="email" class="text-muted mb-5">{{ $charges->email }}</p>
                                  </div>
                                  <div class="row justify-content-center">
                                      <div class="col-12 col-lg-10 col-xl-6  ">
                                          <input type="text" id="copy-text" class="form-control form-control-rounded text-center mb-4 text-truncate" value="{{ route('getPayment', ['user_name' => strtolower($user->first_name), 'user_id' => $user->id, 'charge_id' => $charges->id]) }}" readonly>
                                      </div>
                                  </div>

                                  <div class="row justify-content-center">
                                      <div class="col-12 col-lg-10 col-xl-6 ">
                                          <button class="btn btn-primary btn-block mb-5" id="copy-btn" data-clipboard-text="{{ route('getPayment', ['user_name' => strtolower($user->first_name), 'user_id' => $user->id, 'charge_id' => $charges->id]) }}" onclick="tectCopied()" style="display: block;">Copy pay link</button>
                                          <p class="text-primary mt-3 mb-5 h3 text-center" id="y" style="display: none;">Link copied</p>
                                      </div>
                                  </div>
                              </div>
                          </div> 
                          <div class="row">
                              <div class="col-12">
                                  <div class="my-5"></div>
                                  <h6 class="text-uppercase">Charge Description</h6>
                                  <p id="description" class="text-muted mb-0">{{ $charges->description }}</p>
                              </div>
                          </div> 
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

      <div class="modal fade" id="deletePaymentRequest" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalCenterTitle">Delete payment request</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>

                  <div class="modal-body text-center">
                      <p class="lead  font-weight-bold">You are about to delete this payment request, are you sure?</p>
                      <small class="text-center">This action has immediate effect and cannot be reversed</small>
                  </div>
                  
                  <form action="{{ route('deletePaymentLink', ['charge_id' => $charges->id ]) }}" method="post">
                      {{ csrf_field() }}
                  
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-outline-danger btn-block">Delete request</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div> 

@endsection