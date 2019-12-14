@extends('main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- My Account Page Start -->
            <div class="myaccount-page-wrapper">
                <!-- My Account Tab Menu Start -->
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="#account-info" class="active" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                            <a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="myaccountContent">
                            <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Account Details</h3>
                                    <div class="account-details-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="fullname" class="required">Fullname</label>
                                                        <input type="text" id="fullname" disabled value="{{$data->fullname}}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email</label>
                                                        <input type="text" id="email" disabled value="{{$data->email}}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="phone" class="required">Phone</label>
                                                        <input type="text" id="phone" disabled value="{{$data->phone}}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="gender" class="required">Gender</label>
                                                        @if ($data->gender == "L")
                                                          <input type="text" id="gender" disabled value="Laki - Laki" />
                                                        @elseif ($data->gender == "P")
                                                          <input type="text" id="gender" disabled value="Perempuan" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="single-input-item">
                                                        <label for="address" class="required">Address</label>
                                                        <textarea name="address"  id="address" rows="3" cols="80" disabled>{{$data->address}}</textarea>
                                                        {{-- <input type="text" id="address" disabled value="" /> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-input-item">
                                                {{-- <a href="#" class="check-btn sqr-btn">Edit Profile</a> --}}
                                                <button class="check-btn sqr-btn" type="button" id="btnedit">Edit Profile</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- Single Tab Content End -->
                        </div>
                    </div> <!-- My Account Tab Content End -->
                </div>
            </div> <!-- My Account Page End -->
        </div>
    </div>

@endsection
@section('extra_script')

<script type="text/javascript">
  $("#btnedit").on('click', function() {
    window.location.href = "{{url('/editaccount')}}" + "/" + "{{encrypt(Auth::user()->id_account)}}";
  });
</script>

@endsection
