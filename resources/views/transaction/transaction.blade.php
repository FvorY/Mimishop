@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  <br>
                  Transaction Date : {{$data[0]->date}}  <br>
                  Transaction Number : {{$data[0]->id_transaction}} <br>
                  Buyer Name : {{$data[0]->fullname}} <br>
                  <br>
                  <h2>Transaction</h2>
                  <div class="table-responsive">
                    <table class="table data-table">
                    <thead class="thead-dark">
                        <tr>
                          <th>Figure Picture</th>
                          <th>Name</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $value)
                        <tr>
                          <td>
                            <img src="{{url('/') . '/'}}{{$value->image}}" width="100px;" alt="">
                          </td>
                          <td>{{$value->name}}</td>
                          <td>{{$value->qty}}</td>
                          <td>{{$value->price}}</td>
                          <td>{{number_format($value->qty * $value->price,2,',','.')}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    </table>
                    <br>
                    {{ $data->links('vendor.pagination.custom') }}
                    <br>
                    <br>
                    <br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('extra_script')

@endsection
