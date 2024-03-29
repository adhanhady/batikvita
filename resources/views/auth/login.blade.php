@extends('auth.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>

                        {{-- @error('email') --}}
                            <div class="invalid-feedback">
                                {{-- {{ $message }} --}}
                                Please fill in your email
                            </div>
                        {{-- @enderror --}}
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                        {{-- @error('password') --}}
                            <div class="invalid-feedback">
                                {{-- {{ $message }} --}}
                                Please fill in your password
                            </div>
                        {{-- @enderror --}}
                    </div>

                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                        </div>
                    </div> -->



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
              </div>
            </div>

            <div class="simple-footer">
              Copyright &copy; BatikVita 2022
            </div>
          </div>
        </div>
    </div>
@endsection
