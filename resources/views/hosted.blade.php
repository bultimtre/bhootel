<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
      
            body {
                margin: 24px 0;
                background-color:rgb(216, 238, 200) ;
            }
            .spacer {
                margin-bottom: 24px;
            }
            #card-number, #cvv, #expiration-date {
                background: white;
                height: 20px;
                border: 1px solid #CED4DA;
                padding: .375rem .75rem;
                border-radius: .25rem;
            }
        </style>
  </head>
  <body>
  <p>{{(Request::get('ads'))}}</p>
 
      <div class="container">
            <div class="col-md-6 offset-md-3">
                <h1>Payment Form</h1>
                <div class="spacer"></div>
              
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                <form action="{{route('payment.make',[$apartment ->id,Request::get('ads')])}}" method="POST" id="my-sample-form">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="province" name="province">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postalcode">Postal Code</label>
                                    <input type="text" class="form-control" id="postalcode" name="postalcode">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" value="{{$price/100}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="cc_number">Credit Card Number</label>

                                <div class="form-group" id="card-number">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="expiry">Expiry</label>

                                <div class="form-group" id="expiration-date">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cvv">CVV</label>

                                <div class="form-group" id="cvv">

                                </div>
                            </div>

                        </div>

                        <div class="spacer"></div>

                        <div id="paypal-button"></div>

                        <div class="spacer"></div>

                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button type="submit" class="btn btn-success">Submit Payment</button>
                    </form>
                    </div>
        </div>
    <script src="https://js.braintreegateway.com/web/3.57.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.57.0/js/hosted-fields.min.js"></script>
    
    <script>
      var form = document.querySelector('#my-sample-form');
      var submit = document.querySelector('input[type="submit"]');

      braintree.client.create({
        authorization: 'sandbox_24rsfnxv_8w4hz737npfm33s6'
      }, function (clientErr, clientInstance) {
        if (clientErr) {
          console.error(clientErr);
          return;
        }

        // This example shows Hosted Fields, but you can also use this
        // client instance to create additional components here, such as
        // PayPal or Data Collector.

        braintree.hostedFields.create({
          client: clientInstance,
          styles: {
            'input': {
              'font-size': '14px'
            },
            'input.invalid': {
              'color': 'red'
            },
            'input.valid': {
              'color': 'green'
            }
          },
          fields: {
            number: {
              selector: '#card-number',
              placeholder: '4111 1111 1111 1111'
            },
            cvv: {
              selector: '#cvv',
              placeholder: '123'
            },
            expirationDate: {
              selector: '#expiration-date',
              placeholder: '10/2019'
            }
          }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
          if (hostedFieldsErr) {
            console.error(hostedFieldsErr);
            return;
          }

          //submit.removeAttribute('disabled');

          form.addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
              if (tokenizeErr) {
                console.error(tokenizeErr);
                return;
              }
            
              // If this was a real integration, this is where you would
              // send the nonce to your server.
                 document.querySelector('#nonce').value = payload.nonce;
                form.submit();
              //console.log('Got a nonce: ' + payload.nonce);
            
            });
          }, false);
        },);
      });
    </script>
    
  </body>
</html>