@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  <h2>Manage Feedback</h2>
                  <div class="table-responsive">
                    <table class="table data-table">
                    <thead class="thead-dark">
                        <tr>
                          <th width="5%">No</th>
                          <th>Feedback Description</th>
                          <th>Status</th>
                          <th width="10%">Approve</th>
                          <th width="10%">Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$value->feedback}}</th>
                          @if ($value->status == "Y")
                            <td>Approve</th>
                          @elseif ($value->status == "N")
                            <td>Reject</th>
                          @else
                            <td></td>
                          @endif
                          <td>
                            <span type="button" class="btn btn-primary" onclick="doapprove({{$value->id_feedback}})" name="button">&#10004;</span>
                          </th>
                          <td>
                            <span type="button" class="btn btn-danger" onclick="doreject({{$value->id_feedback}})" name="button">&#10006;</span>
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

@endsection
@section('extra_script')

  <script type="text/javascript">

  // $(document).ready(function() {
    function doapprove(id) {
      $.ajax({
        type: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          "id"  : id,
        },
        url: "{{url('feedbackapprove')}}",
        dataType: 'json',
        success : function(response){
          if (response.status == "sukses") {
            swal.fire({
                title: "Approve",
                text: "Feedback berhasil diapprove!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
              setTimeout(function(){
                    window.location.reload();
            }, 850);
          } else {
            swal.fire({
                title: "Approve",
                text: "Feedback gagal diapprove!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
          }
        }
      });
    }

    function doreject(id) {
      $.ajax({
        type: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          "id"  : id,
        },
        url: "{{url('feedbackreject')}}",
        dataType: 'json',
        success : function(response){
          if (response.status == "sukses") {
            swal.fire({
                title: "Reject",
                text: "Feedback berhasil direject!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
              setTimeout(function(){
                    window.location.reload();
            }, 850);
          } else {
            swal.fire({
                title: "Reject",
                text: "Feedback gagal direject!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
          }
        }
      });
    }
  // })
  </script>

@endsection
