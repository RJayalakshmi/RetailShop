@extends('layout.auth')

@section('title', 'Register')

@section('content')

<div class="register-container login-container animated fadeInDown">
        <div class="registerbox loginbox bg-white" style="height: auto !important;">
            <div class="loginbox-title">Register</div>
                <div class="registerbox-textbox error hidden alert alert-danger fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                    <i class="fa-fw fa fa-times"></i>
                    <strong>Error!</strong> <span class="message"></span>
                </div>
                <form class="loginForm" method="POST">
                    @csrf
                <div class="registerbox-caption ">Please fill in your information</div>
                <div class="registerbox-textbox">
                    <input type="text" class="form-control" placeholder="Full Name" name="name" />
                </div>
                <div class="registerbox-textbox">
                    <input type="text" class="form-control" placeholder="Email" name="email" />
                </div>
                <div class="registerbox-textbox">
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" />
                </div>
                <div class="registerbox-textbox">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" />
                </div>
                
                <div class="registerbox-textbox form-group has-feedback">
                        <select class="form-control" name="location_id" data-bv-field="country">
                            <option value="">Select a location</option>
                            @foreach($locations as $key => $location)
                                <option value="{{ $key }}">{{ $location }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="registerbox-textbox no-padding-bottom">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="colored-primary" checked="checked" disabled="disabled">
                            <span class="text darkgray">By clicking "Submit", you agree to the Company <a class="themeprimary">Terms of Service</a> and Privacy Policy</span>
                        </label>
                    </div>
                </div>
                <div class="registerbox-submit">
                    <input type="submit" class="btn btn-primary pull-right" value="SUBMIT">
                </div>
            </form>
            <br/><br/>
            <hr class="wide" />
            <div class="loginbox-signup registerbox-textbox">
                Already have an account? <a href="{{ url('login') }}">Sign In</a>
            </div>
        </div>
        <div class="logobox" style="text-align: center; height: 71px !important;">
            <img src="{{ asset('img/logo.png') }}" style="height: 88%;" />
        </div>
    </div>


@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){
        $('.loginForm').submit(function(e){
            e.preventDefault();

            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= url('api/v1/user/register')?>",
                data: form.serialize(),
                headers: {
                    'Accept':'application/json'
                },
                processData: false,
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.status == 'Success'){
                        $('.error').addClass('hidden');
                        window.location = "<?= url('/') ?>"+"/login?signup=1";
                    }else{
                        $('.error .message').html(data.message);
                        $('.error').removeClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    //alert(error);
                    //console.log(error, status, xhr);
                    $('.error .message').html(xhr.responseJSON.message);
                    $('.error').removeClass('hidden');
                }

            })
        });

    });
</script>

@endsection