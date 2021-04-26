<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Karunungan Village Academy </title>

    <!-- Bootstrap -->
    <link href="{{url('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{url('template/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('template/build/css/custom.min.css')}}" rel="stylesheet">

    <style>
      body, html {
        height: 100%;
        margin: 0;
      }

      .login {
        background-image: url("{{asset('images/systemImages/wallpaper2.jpg')}}");/* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }  

      .login-box{
        width: 500px;
        background: rgba(0,0,0,0.8);
        margin: 12% auto;
        padding: 50px 0;
        color: white;
        box-shadow: 0 0 20px 2px rgba(0,0,0,0.5);
        margin-top: 150px;
      }

    </style>
  </head>

  <body class="login">
    <div class="login-box">
          <section class="login_content">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf

              <h1>Verify Email Address</h1>

              <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},

                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </div>


              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Karunungan Village Academy</h1>
                  <p>©2020 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
    </div>
    
  </body>
</html>

