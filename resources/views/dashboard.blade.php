@extends('layouts.master')
@section('content')
@include('includes.messages-box')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <header class="header">
            <h3>what's in your mind now</h3>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea rows="5" name="body" id="new-post" class="form-control" placeholder="wtite something here ..."></textarea>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-primary" type="submit">Post</button>
            </form>
        </header>
    </div>

</div>
<div class="row posts">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>What people say ..</h3><hr></header>
        @foreach($posts as $post)
        <article class="post col-flat">
            <strong>{{ $post->user->full_name }}</strong><br>
            <small>{{ $post->created_at }}</small>
            <hr>
            <p id="{{ $post->id }}">
                {{ $post->body }}
            </p>
            <div class="interaction">
                <ul class="list-inline">
                    @if(Auth::user()!= $post->user)
                    <li><a href="#" class="like" id="like-{{ $post->id }}" data-id="{{ $post->id }}" data-islike="true">{{ count($post->likes()->where('like',1)->get())>0 ? '('.count($post->likes()->where('like',1)->get()).')':'(0)' }} {{ Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 1 ?'Unlike':'Like':'Like' }}</a></li>
                    <li><a href="#" class="like" id="dislike-{{ $post->id }}" data-id="{{ $post->id }}" data-islike="false">{{ count($post->likes()->where('like',0)->get())>0 ? '('.count($post->likes()->where('like',0)->get()).')':'(0)' }} {{ Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 0 ?'unDislike':'Dislike':'Dislike' }}</a></li>
                    @else
                    <li><a href="#">{{ count($post->likes()->where('like',1)->get())> 0 ? '('.count($post->likes()->where('like',1)->get()).')':'(0)' }} Like</a></li>
                    <li><a href="#">{{ count($post->likes()->where('like',0)->get())> 0 ? '('.count($post->likes()->where('like',0)->get()).')':'(0)' }} Dislike</a></li>
                    @endif
                    @if(Auth::user()== $post->user)
                    <li><a href="#" class="btn-edit_post" data-postid="{{ $post->id }}">Edite</a></li>
                    <li><a href="{{ route('post.delete',['post_id'=>$post->id]) }}">Delete</a></li>
                    @endif
                </ul>
            </div>
        </article>
        @endforeach

        @if(count($posts)<=0)

        <article class="post col-flat">
            <p class="text-center">
                No stories...
            </p>
        </article>
        @endif
    </div>
</div>
@include('includes.edite_post')
@endsection
@section('scripts')
<script src="{{ URL::to('js/main.js') }}"></script>
@endsection