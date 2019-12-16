@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                      Update profile berhasil disimpan!
                    </div>
                  @endif
                  @if (session('gagal'))
                    <div class="alert alert-danger" role="alert">
                      Update profile gagal disimpan!
                    </div>
                  @endif
                  <h2>Personal Info</h2>
                    <form id="contact-form" action="{{url('doedit')}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}">
                        <label for="fullname">Fullname : </label>
                        <input name="fullname" id="fullname" type="text" placeholder="Fullname" value="{{$data->fullname}}">
                        <label for="fullname">Email : </label>
                        <input name="email" id="email" type="text" placeholder="Email" value="{{$data->email}}">
                        <label for="phone">Phone : </label>
                        <input name="phone" id="phone" type="number" placeholder="Phone" value="{{$data->phone}}">
                        <br>
                        <br>
                        <label for="gender">Gender : </label>
                        <select class="form-Control" name="gender" id="gender">
                            <option value="L" @if ($data->gender == "L")
                              selected
                            @endif>Laki - Laki</option>
                            <option value="P" @if ($data->gender == "P")
                              selected
                            @endif>Perempuan</option>
                        </select>
                        <br>
                        <br>
                        <label for="address">Address : </label>
                        <textarea name="address" id="address" rows="8" cols="20">{{$data->address}}</textarea>
                        <label for="profile_picture">Profile picture : </label>
                        <input type="file" name="profile_picture" id="profile_picture" value="">
                        <br>
                        <center>
                          <div class="image-holder" @if (!is_null($data->profile_picture)) @else style="display: none;" @endif>
                            <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt="">
                          </div>
                        </center>
                        <br>
                        <input type="hidden" name="profile_picture_old" value="{{$data->profile_picture}}">
                        <button class="submit" class="save" type="submit">Update Profile</button>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
</div>

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
