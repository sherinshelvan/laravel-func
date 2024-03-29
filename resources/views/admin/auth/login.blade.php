@extends('admin.layouts.app')

@section('title', 'Login')

@section('navigation')


@endsection

@section('content')
<form class="" method="post">
	@csrf
    <div class='row'>
        <div class='col s12'>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12'>
            <input class='validate' type='email' name='email' id='email' />
            <label for='email'>Enter your email</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12'>
            <input class='validate' type='password' name='password' id='password' />
            <label for='password'>Enter your password</label>
        </div>
        <label style='float: right;'>
            <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
        </label>
    </div>
    <br />
    <center>
        <div class='row'>
            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
        </div>
    </center>
</form>
@endsection