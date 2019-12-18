@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                      Figure berhasil disimpan!
                    </div>
                  @endif
                  @if (session('validate'))
                    <div class="alert alert-danger" role="alert">
                      Isi Form Dengan Benar!
                    </div>
                  @endif
                  @if (session('gagal'))
                    <div class="alert alert-danger" role="alert">
                      Figure gagal disimpan!
                    </div>
                  @endif
                  <h2>Manage Figure</h2>
                      <span type="button" data-toggle="modal" data-target="#modalsave" class="btn btn-primary" name="button"> <em class="fa fa-pencil"></em> Insert New Figure </span>
                  <br>
                  <br>
                  <div class="table-responsive">
                    <table class="table data-table">
                    <thead class="thead-dark">
                        <tr>
                          <th width="5%">No</th>
                          <th>Figure Picture</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Description</th>
                          <th>Stock</th>
                          <th>Price</th>
                          <th width="10%">Edit</th>
                          <th width="10%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>
                            <img src="{{url('/') . '/'}}{{$value->image}}" width="100px;" alt="">
                          </td>
                          <td>{{$value->name}}</td>
                          <td>{{$value->category_name}}</td>
                          <td>{{$value->description}}</td>
                          <td>{{$value->stock}} Pcs</td>
                          <td>Rp. {{number_format($value->price,2,',','.')}}</td>
                          <td>
                            <span type="button" class="btn btn-primary" onclick="doedit({{$value->id_figure}})" name="button"> <em class="fa fa-pen"></em> </span>
                          </th>
                          <td>
                            <span type="button" class="btn btn-danger" onclick="dodelete({{$value->id_figure}})" name="button"> <em class="fa fa-trash"></em> </span>
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
<div class="modal fade" id="modalsave" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-lg-12">
                      <form id="contact-form" action="{{url('dosavefigure')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                      <center><h2 id="titlemodal">Insert New Figure</h2></center>
                      {{-- <<input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}"> --}}
                      <label for="name">Figure Name : </label>
                      <input name="name" type="text" placeholder="Figure Name" >
                      <label for="description">Description : </label>
                      <textarea name="description" rows="8" cols="20"></textarea>
                      <label for="stock">Stock : </label>
                      <input name="stock" type="number" placeholder="Stock" >
                      <label for="price">Price : </label>
                      <input name="price" type="number" placeholder="Price" >
                      <br>
                      <br>
                      <label for="category">Category : </label>
                      <select class="select" name="id_category">
                        @foreach ($category as $key => $value)
                          <option value="{{$value->id_category}}">{{$value->category_name}}</option>
                        @endforeach
                      </select>
                      <br>
                      <br>
                      <label for="image">Image : </label>
                      <input type="file" name="image" class="image" value="">
                      <br><br>
                      <center>
                        <div class="image-holder">
                          {{-- <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt=""> --}}
                        </div>
                      </center>
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
                      <form id="contact-form" action="{{url('doupdatefigure')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="" id="id">
                      <input type="hidden" name="image_old" value="" id="image_old">
                      <center><h2 id="titlemodal">Update New Figure</h2></center>
                      {{-- <<input type="hidden" name="id_account" value="{{encrypt($data->id_account)}}"> --}}
                      <label for="name">Figure Name : </label>
                      <input name="name" type="text" placeholder="Figure Name" id="name">
                      <label for="description">Description : </label>
                      <textarea name="description" rows="8" cols="20" id="description"></textarea>
                      <label for="stock">Stock : </label>
                      <input name="stock" type="number" placeholder="Stock" id="stock">
                      <label for="price">Price : </label>
                      <input name="price" type="number" placeholder="Price" id="price">
                      <br>
                      <br>
                      <label for="category">Category : </label>
                      <select class="select" name="id_category" id="id_category">
                        @foreach ($category as $key => $value)
                          <option value="{{$value->id_category}}">{{$value->category_name}}</option>
                        @endforeach
                      </select>
                      <br>
                      <br>
                      <label for="image">Image : </label>
                      <input type="file" name="image" class="image" value="">
                      <br><br>
                      <center>
                        <div class="image-holder">
                          {{-- <img src="{{url('/') . "/" . $data->profile_picture}}" class="thumb-image img-responsive" width="150px" alt=""> --}}
                        </div>
                      </center>
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

@endsection
@section('extra_script')

  <script type="text/javascript">
  $(".image").on('change', function () {
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
      url: "{{url('/doeditfigure')}}",
      success : function(response) {
        $('#name').val(response.name);
        $('#id_category').val(response.id_category);
        $('#price').val(response.price);
        $('#description').text(response.description)
        $('#stock').val(response.stock)
        $('#id_category').val(response.id_category).trigger('change');
        $('#image_old').val(response.image);
        $('#id').val(response.id_figure);

        var image_holder = $(".image-holder");
        image_holder.empty();

        $("<img />", {
            "src": "{{url('/')}}/"+response.image,
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
      url: "{{url('dodeletefigure')}}",
      success : function(response) {
        if (response.status == "sukses") {
          swal.fire({
              title: "Delete",
              text: "Figure berhasil dihapus!",
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
              text: "Figure gagal dihapus!",
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
