@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="chinform" class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-script')
<script>
    $(function(){
        $('#chinform').submit(function(){
                event.preventDefault();
                var form = $('#chinform')
                var formData = new FormData();
                formData.append('email', $("input[name='email']",form).val());
                $.ajax({
                url: $(this).attr('action'),
                method: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,

                data: formData,

                error: function (data) {
                    $('div.alert div',form).remove();
                    if (data.status === 422) {
                        $('div.alert',form).append("<div>"+data.message+"</div>");
                        $('div.alert',form).show();
                    } else {
                        //log error
                    }
                        

                },
                success: function (data){
                    $('div.alert div',form).remove();
                        $('div.alert',form).show();
                        $('div.alert',form).css("background-color","#9FDE8A");
                        $('div.alert',form).css("border-color","#9FDE8A");
                        $('div.alert',form).css("color","#437A31");
                        $('div.alert',form).append("<div>"+data.message+"</div>");
                }
                
                });

        });
    });
</script>
@endsection