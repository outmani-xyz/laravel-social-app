<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @if(count($errors)>0)
        <ul>
            @foreach($errors->all() as $error)
            <li class="label label-danger">{{ $error }}</li> 
            @endforeach
        </ul>  
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @if(Session::has('message'))
        <strong class="label label-info">{{ Session::get('message') }}</strong>
        @endif
    </div>
</div>
