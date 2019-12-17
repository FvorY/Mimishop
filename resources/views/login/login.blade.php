@extends('main')
@section('content')

  <div class="container">
      <div class="row">
          <div class="col-lg-7 col-md-12 ml-auto mr-auto">
              <div class="login-register-wrapper">
                  <div class="login-register-tab-list nav">
                      <a class="{{Request::is('login') ? 'active' : ''}}" data-toggle="tab" href="#lg1">
                          <h4> login </h4>
                      </a>
                      <a class="{{Request::is('register') ? 'active' : ''}}" data-toggle="tab" href="#lg2">
                          <h4> register </h4>
                      </a>
                  </div>
                  <div class="tab-content">
                      <div id="lg1" class="tab-pane {{Request::is('login') ? 'active' : ''}}">
                          <div class="login-form-container">
                              <div class="login-register-form">
                                <form class="login100-form validate-form" autocomplete="off" method="GET" action="{{ url('dologin') }}">
                                      {{ csrf_field() }}
                                      @if (session('validate'))
                                      <div class="red"  style="color: red"><b>Masukkan email & password dengan benar</b></div>
                                      @endif
                                      @if (session('email'))
                                      <div class="red"  style="color: red"><b>Email Tidak ada</b></div>
                                      @endif
                                      <input type="text" name="email" placeholder="Email">
                                      @if (session('password'))
                                      <div class="red"  style="color: red"><b>Password Yang Anda Masukan Salah</b></div>
                                      @endif
                                      <input type="password" name="password" placeholder="Password">

                                      <div class="button-box">
                                          {{-- <div class="login-toggle-btn">
                                              <input type="checkbox">
                                              <label>Remember me</label>
                                              <a href="#">Forgot Password?</a>
                                          </div> --}}
                                          <button type="submit">Login</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <div id="lg2" class="tab-pane {{Request::is('register') ? 'active' : ''}}">
                          <div class="login-form-container">
                              <div class="login-register-form">
                                  <form action="#" method="post">
                                      <input type="text" name="user-name" placeholder="Username">
                                      <input type="password" name="user-password" placeholder="Password">
                                      <input name="user-email" placeholder="Email" type="email">
                                      <div class="button-box">
                                          <button type="submit">Register</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>

@endsection
@section('extra_script')

@endsection
