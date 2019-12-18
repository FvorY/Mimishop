@extends('main')
@section('content')

  <div class="container">
      <div class="row">
          <div class="col-lg-7 col-md-12 ml-auto mr-auto">
              <div class="login-register-wrapper">
                  <div class="login-register-tab-list nav">
                      <a class="{{Request::is('login') ? 'active' : ''}}" href="{{url('/login')}}">
                          <h4> login </h4>
                      </a>
                      <a class="{{Request::is('register') ? 'active' : ''}}" href="{{url('/register')}}">
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
                                      {{ csrf_field() }}
                                      @if (session('sukses'))
                                        <div class="alert alert-success" role="alert">
                                          Account berhasil disimpan!
                                        </div>
                                      @endif
                                      @if (session('validate'))
                                        <div class="alert alert-danger" role="alert">
                                          Isi Form Dengan Benar!
                                        </div>
                                      @endif
                                      @if (session('tidaksama'))
                                        <div class="alert alert-danger" role="alert">
                                          Password & Confirm Password Tidak Sama!
                                        </div>
                                      @endif
                                      @if (session('gagal'))
                                        <div class="alert alert-danger" role="alert">
                                          Account gagal disimpan!
                                        </div>
                                      @endif
                                      <form id="contact-form" action="{{url('dosaveuser')}}" enctype="multipart/form-data" method="post">
                                      {{ csrf_field() }}
                                      {{-- <<input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}"> --}}
                                      {{-- <label for="fullname">Fullname : </label> --}}
                                      <input name="fullname" type="text" placeholder="Fullname" >
                                      {{-- <label for="fullname">Email : </label> --}}
                                      <input name="email" type="text" placeholder="Email" >
                                      {{-- <label for="fullname">Password : </label> --}}
                                      <input name="password" type="password" placeholder="Password" >
                                      {{-- <label for="fullname">Confirm Password : </label> --}}
                                      <input name="confirm_password" type="password" placeholder="Confirm Password" >
                                      {{-- <label for="phone">Phone : </label> --}}
                                      <input name="phone" type="number" placeholder="Phone" >
                                      {{-- <br>
                                      <br> --}}
                                      {{-- <label for="gender">Gender : </label> --}}
                                      <br>
                                      <select class="form-Control" name="gender">
                                          <option value="L">Laki - Laki</option>
                                          <option value="P">Perempuan</option>
                                      </select>
                                      {{-- <br>
                                      <br> --}}
                                      {{-- <label for="gender">Role : </label> --}}
                                      <br>
                                      <br>
                                      <select class="form-Control" name="role">
                                          <option value="admin">Admin</option>
                                          <option value="member">Member</option>
                                      </select>
                                      <br>
                                      <br>
                                      {{-- <br>
                                      <br> --}}
                                      {{-- <label for="address">Address : </label> --}}
                                      <textarea name="address" rows="8" cols="20"></textarea>
                                      <label for="profile_picture">Profile picture : </label>
                                      <input type="file" name="profile_picture" value="">
                                      {{-- <br>
                                      <br> --}}
                                      <center>
                                        <div class="image-holder">
                                          {{-- <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt=""> --}}
                                        </div>
                                      </center>
                                      {{-- <div class="col-md-2"> --}}
                                        <input type="checkbox" name="terms_and_condition" value="Y"> I agree to term and condition
                                        <br>
                                        <br>
                                      {{-- </div>
                                      <div class="col-md-5">

                                      </div> --}}



                                      <div class="button-box">
                                          {{-- <div class="login-toggle-btn">
                                              <input type="checkbox">
                                              <label>Remember me</label>
                                              <a href="#">Forgot Password?</a>
                                          </div> --}}
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
  {{-- </div> --}}

@endsection
@section('extra_script')
  <script type="text/javascript">
  $("#profile_picture").on('change', function () {
      $('.save').attr('disabled', false);
      if (typeof (FileReader) != "undefined") {
          var image_holder = $(".image-holder");
          image_holder.empty();
          var reader = new FileReader();
          reader.onload = function (e) {
              image_holder.html('<img src="{{ asset('assets/img/loading.gif') }}" class="img-responsive" width="60px">');
              $('.save').attr('disabled', true);
              setTimeout(function(){
                  image_holder.empty();
                  $("<img />", {
                      "src": e.target.result,
                      "class": "thumb-image img-responsive",
                      "width": "150px",
                  }).appendTo(image_holder);
                  $('.save').attr('disabled', false);
              }, 2000)
          }
          image_holder.show();
          reader.readAsDataURL($(this)[0].files[0]);
      } else {
          alert("This browser does not support FileReader.");
      }
  });
  </script>
@endsection
