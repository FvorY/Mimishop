@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  <br>
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
                  <h2>Manage Account</h2>
                      <span type="button" data-toggle="modal" data-target="#modalsave" class="btn btn-primary" name="button"> <em class="fa fa-pencil"></em> Insert New Account </span>
                  <br>
                  <br>
                  <div class="table-responsive">
                    <table class="table data-table">
                    <thead class="thead-dark">
                        <tr>
                          <th width="5%">No</th>
                          <th>Profile Picture</th>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Gender</th>
                          <th>Role</th>
                          <th width="10%">Edit</th>
                          <th width="10%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>
                            <img src="{{url('/') . '/'}}{{$value->profile_picture}}" width="100px;" alt="">
                          </td>
                          <td>{{$value->fullname}}</td>
                          <td>{{$value->email}}</td>
                          <td>{{$value->phone}}</td>
                          <td>{{$value->address}}</td>
                          @if ($value->gender == "L")
                            <td>Laki - Laki</td>
                          @elseif ($value->gender == "P")
                            <td>Perempuan</td>
                          @endif
                          <td>{{$value->role}}</td>
                          <td>
                            <span type="button" class="btn btn-primary" onclick="doedit({{$value->id_account}})" name="button"> <em class="fa fa-pen"></em> </span>
                          </th>
                          <td>
                            <span type="button" class="btn btn-danger" onclick="dodelete({{$value->id_account}})" name="button"> <em class="fa fa-trash"></em> </span>
                          </th>
                        </tr>
                      @endforeach
                    </tbody>
                    </table>
                    <br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalsave" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-lg-12">
                      <form id="contact-form" action="{{url('dosaveuser')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                      <center><h2 id="titlemodal">Insert New Account</h2></center>
                      {{-- <<input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}"> --}}
                      <label for="fullname">Fullname : </label>
                      <input name="fullname" type="text" placeholder="Fullname" >
                      <label for="fullname">Email : </label>
                      <input name="email" type="text" placeholder="Email" >
                      <label for="fullname">Password : </label>
                      <input name="password" type="password" placeholder="Password" >
                      <label for="fullname">Confirm Password : </label>
                      <input name="confirm_password" type="password" placeholder="Confirm Password" >
                      <label for="phone">Phone : </label>
                      <input name="phone" type="number" placeholder="Phone" >
                      <br>
                      <br>
                      <label for="gender">Gender : </label>
                      <select class="form-Control" name="gender">
                          <option value="L">Laki - Laki</option>
                          <option value="P">Perempuan</option>
                      </select>
                      <br>
                      <br>
                      <label for="gender">Role : </label>
                      <select class="form-Control" name="role">
                          <option value="admin">Admin</option>
                          <option value="member">Member</option>
                      </select>
                      <br>
                      <br>
                      <label for="address">Address : </label>
                      <textarea name="address" rows="8" cols="20"></textarea>
                      <label for="profile_picture">Profile picture : </label>
                      <input type="file" name="profile_picture" class="profile_picture" value="">
                      <br>
                      <br>
                      <center>
                        <div class="image-holder" style="display: none">
                          {{-- <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt=""> --}}
                        </div>
                      </center>
                      <div class="col-md-2">
                        <input type="checkbox" name="terms_and_condition" value="Y">
                      </div>
                      <div class="col-md-5">
                          I agree to term and condition
                      </div>
                      <br>
                        <button type="submit" class="btn btn-primary" style="width:100% !important" name="button" > Save </button>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
</div>
<!-- Modal end -->


<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-lg-12">
                      <form id="contact-form" action="{{url('doupdateuser')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="profile_picture_old" id="profile_picture_old">
                      <center><h2 id="titlemodal">Update New Account</h2></center>
                      {{-- <<input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}"> --}}
                      <label for="fullname">Fullname : </label>
                      <input name="fullname" id="fullname" type="text" placeholder="Fullname" >
                      <label for="fullname">Email : </label>
                      <input name="email" id="email" type="text" placeholder="Email" >
                      <label for="phone">Phone : </label>
                      <input name="phone" id="phone" type="number" placeholder="Phone" >
                      <br>
                      <br>
                      <label for="gender">Gender : </label>
                      <select class="form-Control" name="gender" id="gender">
                          <option value="L">Laki - Laki</option>
                          <option value="P">Perempuan</option>
                      </select>
                      <br>
                      <br>
                      <label for="gender">Role : </label>
                      <select class="form-Control" name="role" id="role">
                          <option value="admin">Admin</option>
                          <option value="member">Member</option>
                      </select>
                      <br>
                      <br>
                      <label for="address">Address : </label>
                      <textarea name="address" id="address" rows="8" cols="20"></textarea>
                      <label for="profile_picture">Profile picture : </label>
                      <input type="file" name="profile_picture" class="profile_picture" id="profile_picture" value="">
                      <br>
                      <br>
                      <center>
                        <div class="image-holder" style="display: none">
                          {{-- <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt=""> --}}
                        </div>
                      </center>
                      <br>
                        <button type="submit" class="btn btn-primary" id="buttonsave" style="width:100% !important" name="button" > Save </button>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
</div>
<!-- Modal end -->

@endsection
@section('extra_script')

  <script type="text/javascript">
  $(".profile_picture").on('change', function () {
      // $('.save').attr('disabled', false);
      if (typeof (FileReader) != "undefined") {
          var image_holder = $(".image-holder");
          image_holder.empty();
          var reader = new FileReader();
          reader.onload = function (e) {
              image_holder.html('<img src="{{ asset('assets/img/loading.gif') }}" class="img-responsive" width="60px">');
              // $('.save').attr('disabled', true);
              setTimeout(function(){
                  image_holder.empty();
                  $("<img />", {
                      "src": e.target.result,
                      "class": "thumb-image img-responsive",
                      "width": "150px",
                  }).appendTo(image_holder);
                  // $('.save').attr('disabled', false);
              }, 2000)
          }
          image_holder.show();
          reader.readAsDataURL($(this)[0].files[0]);
      } else {
          alert("This browser does not support FileReader.");
      }
  });

  function doedit(id) {
    $.ajax({
      type: 'get',
      data: {id:id},
      dataType: 'json',
      url: "{{url('/doedituser')}}",
      success : function(response) {
        $('#fullname').val(response.fullname);
        $('#email').val(response.email);
        $('#phone').val(response.phone);
        $('#address').text(response.address)
        $('#gender').val(response.gender).trigger('change');
        $('#role').val(response.role).trigger('change');
        $('#profile_picture_old').val(response.profile_picture);
        $('#id').val(response.id_account);

        var image_holder = $(".image-holder");

        image_holder.empty();

        $("<img />", {
            "src": "{{url('/')}}/"+response.profile_picture,
            "class": "thumb-image img-responsive",
            "width": "150px",
        }).appendTo(image_holder);


        $('#modaledit').modal('show');
      }
    });
  }

  function dodelete(id){
    $.ajax({
      type: 'get',
      data: {id: id},
      dataType: 'json',
      url: "{{url('dodeleteuser')}}",
      success : function(response) {
        if (response.status == "sukses") {
          swal.fire({
              title: "Delete",
              text: "Account berhasil dihapus!",
              icon: 'success',
              showConfirmButton: false,
              timer: 900
          });
            setTimeout(function(){
                  window.location.reload();
          }, 850);
        } else {
          swal.fire({
              title: "Delete",
              text: "Account gagal dihapus!",
              icon: 'success',
              showConfirmButton: false,
              timer: 900
          });
        }
      }
    });
  }
  </script>

@endsection
