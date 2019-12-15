@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  <h2>Manage Account</h2>
                      <span type="button" onclick="docreate()" class="btn btn-primary" name="button"> <em class="fa fa-pencil"></em> Insert New Account </span>
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
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-lg-12">
                      <center><h2 id="titlemodal">Insert New Category</h2></center>
                      <br>
                        <input type="text" name="category" value="" id="category" placeholder="Category Name">
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary" id="buttonsave" style="width:100% !important" name="button" onclick="dosave()"> Save </button>
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

    function dosave() {
      $.ajax({
        type: 'get',
        data: {category: $("#category").val()},
        dataType: 'json',
        url: "{{url('dosavecategory')}}",
        success : function(response) {
          if (response.status == "sukses") {
            swal.fire({
                title: "Save",
                text: "Category berhasil disimpan!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
              setTimeout(function(){
                    window.location.reload();
            }, 850);
          } else {
            swal.fire({
                title: "Save",
                text: "Category gagal disimpan!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
          }
        }
      });
    }

    function doedit(id) {
      $.ajax({
        type: 'get',
        data: {id: id},
        dataType: 'json',
        url: "{{url('doeditcategory')}}",
        success : function(response) {
          $("#category").val(response.category_name);
          $("#exampleModal").modal('show');
          $('#titlemodal').text("Update Category");
          $('#buttonsave').text("Update");
          $('#buttonsave').attr('onclick', 'doupdate('+id+')');
        }
      });
    }

    function docreate(){
      $("#exampleModal").modal('show');
      $('#titlemodal').text("Insert New Category");
      $('#buttonsave').text("Save");
      $('#buttonsave').attr('onclick', 'dosave()');
      $("#category").val("");
    }

    function doupdate(id){
      $.ajax({
        type: 'get',
        data: {id: id, category: $('#category').val()},
        dataType: 'json',
        url: "{{url('doupdatecategory')}}",
        success : function(response) {
          if (response.status == "sukses") {
            swal.fire({
                title: "Save",
                text: "Category berhasil diupdate!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
              setTimeout(function(){
                    window.location.reload();
            }, 850);
          } else {
            swal.fire({
                title: "Save",
                text: "Category gagal diupdate!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
          }
        }
      });
    }

    function dodelete(id){
      $.ajax({
        type: 'get',
        data: {id: id},
        dataType: 'json',
        url: "{{url('dodeletecategory')}}",
        success : function(response) {
          if (response.status == "sukses") {
            swal.fire({
                title: "Save",
                text: "Category berhasil dihapus!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
              setTimeout(function(){
                    window.location.reload();
            }, 850);
          } else {
            swal.fire({
                title: "Save",
                text: "Category gagal dihapus!",
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
