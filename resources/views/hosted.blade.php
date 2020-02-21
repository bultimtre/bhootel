<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
      
            body {
                margin: 0;
                background-color: #1248a5;
                 }
            .box 
            {       
              margin: auto;
              width: 70%;
              padding: 2px;
              background: rgba(0,0,0,.5);
              box-sizing: border-box;
              box-shadow: 0 15px 25px rgba(2,2,2,.3);
              border-radius: 10px;
                }
                .box h2 {
                       
                        color: #fff;
                        text-align: center;
                    }
                    
                .box  input {
                      width: 100%;
                      padding: 5px 0;
                      font-size: 1.2em;
                      color: #fff;
                      margin-bottom: 5px;
                      border: none;
                      border-bottom: 1px solid #fff;
                      outline: none;
                      background:transparent;
                  }

                   .box label
                   {
                      padding: 2px 5px;
                      font-size: 1.2em;
                      color: #fff;
                   
                      transition: .5s; 
                    }

                    .box input:focus ~ label,
                    .boxx input:valid ~ label {
                        top: -20px;
                        left: 0;
                        color: #03a9f4;
                        font-size: 10px;
                    }
            .spacer {
                margin-bottom: 24px;
            }
            .box #card-number, #cvv, #expiration-date {
                background: white;
                height: 35px;
                border: 1px solid #CED4DA;
                padding: 5px 5px;
                border-radius: 10px;
            }
        </style>
  </head>
  <body>
  <p>{{(Request::get('ads'))}}</p>
 <div class="box">
      <div class="container">
            <div class="col-md-6 offset-md-3">
                <h2>Payment Form</h2>
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
                            <input type="email" class="inputBox" id="email">
                            
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
              placeholder: '12/2020'
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