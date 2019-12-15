@extends('main')
@section('content')

<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="contact-from contact-shadow">
                  @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                      Feedback berhasil dikirim!
                    </div>
                  @endif
                  @if (session('gagal'))
                    <div class="alert alert-danger" role="alert">
                      Feedback gagal dikirim!
                    </div>
                  @endif
                  <h2>Feedback</h2>
                    <form id="feedback-form" action="{{url('dofeedback')}}" method="post">
                      {{ csrf_field() }}
                        <textarea name="feedback" rows="8" cols="20" placeholder="Insert Feedback"></textarea>
                        <button type="submit" name="button">Send Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extra_script')

@endsection
