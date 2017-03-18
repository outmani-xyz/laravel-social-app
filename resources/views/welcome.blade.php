@extends('layouts.master')
@section('title')
this is title
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Sign in</h2>
        <form action="{{ route('user.signin') }}" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="name" name="email"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" name="password"/>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
    <div class="col-md-6">
        <h2>Sign up</h2>
        <form action="{{ route('user.signup') }}" method="post">
            <div class="form-group">
                <label>Full name</label>
                <input type="text" class="form-control" id="full_name" name="full_name"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="name" name="email"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" name="password"/>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
</div>
@endsection