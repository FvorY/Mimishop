@extends('main')
@section('content')

<div class="container">
    <h3 class="cart-page-title">Your cart items</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            {{-- <form action="#"> --}}
                <div class="table-content table-responsive cart-table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                            $total = 0
                          @endphp
                          @foreach ($data as $key => $value)
                            @php $total += (int)$value->qty * (int)$value->price @endphp
                            <tr class="cart{{$value->id_figure}}">
                                <td class="product-thumbnail">
                                    <a><img src="{{url('/')}}/{{$value->image}}" alt="" width="100px"></a>
                                </td>
                                <td class="product-name"><a href="#">{{$value->name}}</a></td>
                                <td class="product-price-cart"><span class="amount">{{number_format($value->price,0,',','.')}}</span></td>
                                <td class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" id="qty{{$value->id_figure}}" onkeyup="changeqty({{$value->id_figure}}, {{$value->price}})" name="qtybutton" value="{{$value->qty}}">
                                    </div>
                                </td>
                                <td class="product-subtotal" id="subtotal{{$value->id_figure}}">{{number_format($value->price * $value->qty,0,',','.')}}</td>
                                <td class="product-remove">
                                    <a class="closecart" data-id="{{$value->id_figure}}"><i class="sli sli-close"></i></a>
                               </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- </form> --}}
              <br>

                <div class="col-lg-4 col-md-12">
                    <div class="grand-totall">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                        </div>
                        <h4 class="grand-totall-title">Grand Total  <span>{{number_format($total,2,',','.')}}</span></h4>
                        <a href="#" class="btncheckout">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extra_script')
  <script type="text/javascript">
  $('.closecart').on('click', function(){
    var id_figure = $(this).data('id');

    $.ajax({
      type: 'get',
      data: {id_figure: id_figure},
      dataType: 'json',
      url: "{{url('removecart')}}",
      success : function(response) {
        if (response.status == "berhasil") {
          $('#cart'+id_figure).remove();
        } else {
          swal.fire({
              title: "Info",
              text: "Gagal menghapus cart, cek koneksi internet !",
              icon: 'error',
              showConfirmButton: false,
              timer: 900
          });
        }
      }
    });
  })

  function changeqty(id, price) {
    var qty = $('#qty'+id).val();
    var subtotal = 0;

    if (qty != "") {
      subtotal = parseInt(qty) * parseInt(price);

      $('#subtotal'+id).text(formatRupiah(String(subtotal, "")));

      $.ajax({
        type: 'get',
        data: {id_figure: id, qty: qty},
        url: "{{url('updateqty')}}",
        success : function(response){

        }
      });
    }
  }
  </script>
@endsection
