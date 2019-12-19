@extends('main')
@section('content')

<div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-top-bar">
                        <div class="select-shoing-wrap">
                            {{-- <p>Showing 1–12 of 20 result</p> --}}
                        </div>
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-1" data-toggle="tab">
                                <i class="sli sli-grid"></i>
                            </a>
                            <a href="#shop-2" data-toggle="tab">
                                <i class="sli sli-menu"></i>
                            </a>
                        </div>
                    </div>
                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row ht-products">
                                  @foreach ($data as $key => $value)
                                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                        <!--Product Start-->

                                          <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                              <div class="ht-product-inner">
                                                  <div class="ht-product-image-wrap">
                                                      <a class="ht-product-image"> <img src="{{url('/')}}/{{$value->image}}" alt="Universal Product Style"> </a>

                                                      <div class="ht-product-action">
                                                          <ul>
                                                              <li><a onclick="clickdetail({{$value->id_figure}})"><i class="sli sli-magnifier"></i><span class="ht-product-action-tooltip">Quick View</span></a></li>
                                                              @if (Auth::check())
                                                              <li><a class="clickcart" data-id="{{$value->id_figure}}"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                                              @endif
                                                          </ul>
                                                      </div>

                                                  </div>
                                                  <div class="ht-product-content">
                                                      <div class="ht-product-content-inner">
                                                          <h4 class="ht-product-title"><a href="product-details.html">{{$value->name}}</a></h4>
                                                          <div class="ht-product-price">
                                                              <span class="new">Rp. {{number_format($value->price,2,',','.')}}</span>
                                                          </div>
                                                      </div>
                                                      @if (Auth::check())
                                                      <div class="ht-product-action">
                                                          <ul>
                                                              <li><a class="clickcart" data-id="{{$value->id_figure}}"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                                          </ul>
                                                      </div>
                                                    @endif
                                                  </div>
                                              </div>
                                          </div>

                                        <!--Product End-->
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="shop-2" class="tab-pane">
                                <div class="shop-list-wrap shop-list-mrg2 shop-list-mrg-none mb-30">
                                    <div class="row">
                                      @foreach ($data as $key => $value)
                                        <div class="col-lg-4 col-md-4">
                                            <div class="product-list-img">
                                                <a onclick="clickdetail({{$value->id_figure}})">
                                                    <img src="{{url('/')}}/{{$value->image}}" alt="Universal Product Style">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 align-self-center">
                                            <div class="shop-list-content">
                                                <h3><a>{{$value->name}}</a></h3>
                                                <p>{{$value->description}}</p>
                                                <p>Category : {{$value->category_name}}</p>
                                                <div class="shop-list-price-action-wrap">
                                                    <div class="shop-list-price-ratting">
                                                        <div class="ht-product-list-price">
                                                            <span class="new">Rp. {{number_format($value->price,2,',','.')}}</span>
                                                            {{-- <span class="old">$70.00</span> --}}
                                                        </div>
                                                    </div>
                                                    @if (Auth::check())
                                                    <div class="ht-product-list-action">
                                                        {{-- <a class="list-wishlist" title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a> --}}
                                                        <a class="list-cart" class="clickcart" data-id="{{$value->id_figure}}" title="Add To Cart" ><i class="sli sli-basket-loaded"></i> Add to Cart</a>
                                                        {{-- <a class="list-refresh" title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a> --}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ $data->links('vendor.pagination.custom') }}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-style mr-30">
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">Search </h4>
                            <div class="pro-sidebar-search mb-50 mt-25">
                                <form class="pro-sidebar-search-form" action="{{url('searchfigure')}}" method="get">
                                  {{-- {{ csrf_field() }} --}}
                                    <input type="text" id="search" name="search" placeholder="Search here...">
                                    <button id="btnsearch">
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </form>
                            </div>
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
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="tab-content quickview-big-img">
                                <div class="tab-pane fade show active">
                                    <img id="imagemodal" src="assets/img/product/quickview-l1.svg" alt="">
                                </div>
                            </div>
                            <!-- Thumbnail Large Image End -->
                            <!-- Thumbnail Image End -->
                            {{-- <div class="quickview-wrap mt-15">
                                <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                    <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/img/product/quickview-s1.svg" alt=""></a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-details-content quickview-content">
                                <h2 id="productmodal">Products Name Here</h2>
                                <div class="product-details-price">
                                    <span>Rp. &nbsp;<span id="pricemodal"> $18.00 </span> </span>
                                </div>
                                <p id="descriptionmodal">Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                                <div class="pro-details-list">
                                    <ul>
                                        <li>Category : <span id="categorymodal">0.5 mm Dail</span></li>
                                    </ul>
                                </div>

                            </div>
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
        function clickdetail(id){
          $.ajax({
            type: 'get',
            data: {id},
            dataType: 'json',
            url: "{{url('detailfigure')}}",
            success : function (response) {
              $('#imagemodal').attr('src', "{{url('/')}}/"+response.image);
              $('#productmodal').text(response.name);
              $('#pricemodal').text(formatRupiah(String(response.price, 'Rp. ')));
              $('#descriptionmodal').text(response.description);
              $('#categorymodal').text(response.category_name);

              $('#exampleModal').modal('show');
            }
          });
        }
    </script>

  @endsection
