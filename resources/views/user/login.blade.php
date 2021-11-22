@extends('layout.auth')

@section('title', 'Login')

@section('content')

<div class="login-container animated fadeInDown">
        <div class="loginbox bg-white">
            <div class="loginbox-title">SIGN IN</div>
            <div class="error hidden alert alert-danger fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                <i class="fa-fw fa fa-times"></i>
                <strong>Error!</strong> <span class="message"></span>
            </div>
            <?php if(isset($_GET['signup']) && $_GET['signup'] == 1) { ?>
                <div class="alert alert-success fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                    <i class="fa-fw fa fa-times"></i>
                    <strong>Congrats!</strong> <span class="message">You have successfully registered!</span>
                </div>
            <?php } ?>
            <form class="loginForm" method="POST">
                @csrf
                <div class="loginbox-textbox">
                    <input type="text" class="form-control" placeholder="Email" name="email" />
                </div>
                <div class="loginbox-textbox">
                    <input type="text" class="form-control" placeholder="Password" name="password" />
                </div>
                <div class="loginbox-submit">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                </div>
            </form>
            <div class="loginbox-signup">
                <a href="{{ url('register') }}">Sign Up With Email</a>
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
        //$('.error').hide();
        $('.loginForm').submit(function(e){
            e.preventDefault();

            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?= url('login')?>",
                data: form.serialize(),
                processData: false,
                //dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.error === undefined){
                        $('.error').addClass('hidden');
                        window.location = "<?= url('/') ?>"+"/user/products";
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