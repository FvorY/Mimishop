@extends('main')
@section('content')

<div class="container">
    <h3 class="cart-page-title">Your cart items</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="#">
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
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-3.svg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Product Name</a></td>
                                <td class="product-price-cart"><span class="amount">$260.00</span></td>
                                <td class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                    </div>
                                </td>
                                <td class="product-subtotal">$110.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="sli sli-pencil"></i></a>
                                    <a href="#"><i class="sli sli-close"></i></a>
                               </td>
                            </tr>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-4.svg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Product Name</a></td>
                                <td class="product-price-cart"><span class="amount">$150.00</span></td>
                                <td class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                    </div>
                                </td>
                                <td class="product-subtotal">$150.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="sli sli-pencil"></i></a>
                                    <a href="#"><i class="sli sli-close"></i></a>
                               </td>
                            </tr>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-5.svg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Product Name </a></td>
                                <td class="product-price-cart"><span class="amount">$170.00</span></td>
                                <td class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                    </div>
                                </td>
                                <td class="product-subtotal">$170.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="sli sli-pencil"></i></a>
                                    <a href="#"><i class="sli sli-close"></i></a>
                               </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-update">
                                <a href="{{url('/')}}">Continue Shopping</a>
                            </div>
                            <div class="cart-clear">
                                <a href="#">Clear Shopping Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <div class="col-lg-4 col-md-12">
                    <div class="grand-totall">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                        </div>
                        <h4 class="grand-totall-title">Grand Total  <span>$260.00</span></h4>
                        <a href="#">Proceed to Checkout</a>
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
