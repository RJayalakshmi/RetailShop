@extends('layout.auth')

@section('title', 'Admin Login')

@section('content')

<div class="login-container animated fadeInDown">
        <div class="loginbox bg-white">
            <div class="loginbox-title">ADMIN SIGN IN</div>
            <div class="error hidden alert alert-danger fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                <i class="fa-fw fa fa-times"></i>
                <strong>Error!</strong> <span class="message"></span>
            </div>
            <form class="loginForm" method="POST">
                @csrf
                <input type="hidden" name="client_id" value="2" />
                <input type="hidden" name="client_secret" value="pBlJOpd6vOoaQTykr0ENx5xX3dwpz7BbN7h4Pf19" />
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
                url: "<?= url('/admin/login')?>",
                data: form.serialize(),
                processData: false,
                //dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.error === undefined){
                        $('.error').addClass('hidden');
                        if(data.isAdmin == 1){
                            window.location = "<?= url('/') ?>"+"/admin/dashboard";
                        }else{
                            $('.error .message').html('You are unauthorized to access this page');
                            $('.error').removeClass('hidden');
                        }                        
                    }else{
                        $('.error .message').html(data.message);
                        $('.error').removeClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    //console.log(error, status, xhr);
                    $('.error .message').html(xhr.responseJSON.message);
                    $('.error').removeClass('hidden');
                }

            })
        });

    });
</script>

@endsection