@extends('layouts.master')
@section('content')
@include('includes.messages-box')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <header class="header">
            <h3>what's in your mind now</h3>
            <form action="{{ route('user.account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}">
                </div>
                <div class="form-group">
                    <div class="container-fluid">
                        <div class="row">                           
                            <div class="col-md-6">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                @if(Storage::disk('local')->has($user->id.'-'.$user->full_name.'.jpg'))
                                <img class="img-responsive" src="{{ route('user.image',['file'=>$user->id.'-'.$user->full_name.'.jpg']) }}"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-primary" type="submit">Post</button>
            </form>
        </header>
    </div>
</div>
@endsection