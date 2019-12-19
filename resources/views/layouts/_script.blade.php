<script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- Plugins JS -->
<script src="{{asset('assets/js/plugins.js')}}"></script>
<!-- Ajax Mail -->
{{-- <script src="{{asset('assets/js/ajax-mail.js')}}"></script> --}}
<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Modernizer JS -->
<script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/DataTables/datatables.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $(".data-table").DataTable();
  })
</script>

@if (Auth::check())
<script type="text/javascript">
  var countcart = 0

    $('.clickcart').on('click', function(e){
      var id_figure = $(this).data('id');


      @if (Auth::check())
        var auth = "{{Auth::user()->id_account}}";
      @else
        var auth = "";
      @endif

      if (auth == "") {
        swal.fire({
            title: "Info",
            text: "Login terlebih dahulu untuk menambah cart!",
            icon: 'error',
            showConfirmButton: false,
            timer: 900
        });
      } else {
        $.ajax({
          type: 'get',
          data: {id_figure: id_figure, id_account: auth},
          dataType: 'json',
          url: "{{url('addcart')}}",
          success : function(response) {
            if (response.status == "berhasil") {
              countcart++

              $('#countcart').text(countcart);
            } else {
              swal.fire({
                  title: "Info",
                  text: "Gagal menambah cart, cek koneksi internet anda!",
                  icon: 'error',
                  showConfirmButton: false,
                  timer: 900
              });
            }
          }
        });
      }

    })

    $('.togglecart').on('click', function(){
      $.ajax({
        type: 'get',
        dataType: 'json',
        url: "{{url('getcart')}}",
        success: function(response){
          // console.log(response);
          var html1 = "";
          var html2 = "";
          var total = 0;

          for (var i = 0; i < response.length; i++) {
            total += parseInt(response[i].price) * parseInt(response[i].qty);
            html1 += '<li class="single-shopping-cart cart'+response[i].id_figure+'">'+
                      '<div class="shopping-cart-img">'+
                    '<a><img alt="" src="{{url('/')}}/'+response[i].image+'"></a>'+
                    '<div class="item-close">'+
                        '<a class="closecart" data-id="'+response[i].id_figure+'"><i class="sli sli-close"></i></a>'+
                    '</div>'+
                    '</div>'+
                    '<div class="shopping-cart-title">'+
                      '<h4><a>'+response[i].name+'</a></h4>'+
                      '<span>'+response[i].qty+' x '+formatRupiah(String(response[i].price), 'Rp. ')+'</span>'+
                    '</div>'+
                    '</li>';

            html2 += '<li class="single-shopping-cart cart'+response[i].id_figure+'">'+
                        '<div class="shopping-cart-img">'+
                            '<a><img alt="" src="{{url('/')}}/'+response[i].image+'"></a>'+
                        '</div>'+
                        '<div class="shopping-cart-title">'+
                            '<h4><a>'+response[i].name+'</a></h4>'+
                            '<span>'+response[i].qty+' x '+formatRupiah(String(response[i].price), 'Rp. ')+'</span>'+
                        '</div>'+
                    '</li>';
          }

          $('#showcart1').html(html1);
          $('#showcart2').html(html2);

          $('.shop-total').text(formatRupiah(String(total, 'Rp. ')));

        }
      });
    });

    $('.closecart').on('click', function(){
      var id_figure = $(this).data('id');

      $.ajax({
        type: 'get',
        data: {id_figure: id_figure},
        dataType: 'json',
        url: "{{url('removecart')}}",
        success : function(response) {
          if (response.status == "berhasil") {
            $('.cart'+id_figure).remove();
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

    $('.btncheckout').on('click', function(){
      $.ajax({
        type: 'get',
        url: "{{url('savecart')}}",
        dataType: 'json',
        success : function(response){
          if (response.status == "berhasil") {
            swal.fire({
                title: "Info",
                text: "berhasil checkout!",
                icon: 'success',
                showConfirmButton: false,
                timer: 900
            });
            setTimeout(function(){
                  window.location.href = "{{url('/')}}";
          }, 850);
          } else {
            swal.fire({
                title: "Info",
                text: "Gagal checkout, cek koneksi internet !",
                icon: 'error',
                showConfirmButton: false,
                timer: 900
            });
          }
        }
      });
    })

    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endif
