@extends('layouts.frontend')
@section('content')
  <div class="container mt-5">
     <div class="row">
         <div class="col-md-12">
             <h3>{{$blog->title??''}}</h3>
             <hr/>
         </div>
     </div>
  <div class="row">
    <div class="col-md-10" style="border-right:2px solid #4444;">
      
        <div class="card mb-3">
            @if(isset($blog->image))
          <img src="{{asset($blog->image??'')}}" style="height: 500px;" class="card-img-top" alt="...">
          @endif
          <div class="card-body" style="margin-top:10px; padding:6px;"> 
          <b><span class="fa fa-user"></span> Admin</b>
            <p class="card-text" style="margin-bottom:0px;"><small class="text-muted"><span class="fa fa-calendar"></span> {{$blog->created_at->diffForHumans()??''}}</small> <br/>
            {{--<small class="text-muted"><span class="fa fa-comment"></span> {{$comment->count()??'0'}}</small></p>--}}
            <hr style="margin-top:0px;"/>
            <p class="card-text">
                {!!$blog->description??''!!}
                </p>
          </div>
        </div>
        {{--<div class="row">
            <div class="col-md-12">
                <h5><b>Add Comment</b></h5>
                <form method="POST" action="{{route('comment.store',$blog->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <textarea type="text" class="form-control" name="comment" required>{{old('comment')}}</textarea>
                    </div>
                    <div class="col-md-2 mt-2">
                        <button class="btn background-link" type="submit">Post</button>
                    </div>
                </div>
                </form>
                  <hr/>
                <h5><b>Comments</b></h5>
                <hr/>
                @foreach($comment as $item)
                <div class="media">
                    @if(isset($item->image))
                  <div class="media-left">
                    <img src="{{asset($item->user_name->image??'')}}" class="media-object" style="width: 50px;height: 50px;margin-right: 10px;">
                  </div>
                  @endif
                  <div class="media-body">
                    <h5 class="media-heading">{{$item->user_name->name??''}}</h5>
                    <small>{{$item->created_at->diffForHumans()??''}}</small>
                    <p>{{$item->description??''}}</p>
                  </div>
                </div>
                @endforeach
            </div>
        </div>--}}
    </div>
    <div class="col-md-2">
        <h5>Other Blogs</h5>
          <hr/>
          
      @foreach($otherblog->take(4) as $item)
      <div class="card mb-3">
          @if(isset($item->image))
          <a href="{{url('blog-detail/'.$item->slug)}}"><img src="{{asset($item->image??'')}}" class="card-img-top" alt="..."></a>
          @endif
          <div class="card-body" style="margin-top:10px; padding:0px;">
            <a href="{{url('blog-detail/'.$item->slug)}}" style="text-decoration: none;"><h6 class="card-title" style="margin-bottom:0px;"><b>{{$item->title??''}}</b></h6></a>
            <hr style="margin-top:0px;"/>
          </div>
        </div>
        @endforeach
    </div>
 </div>
 </div>
<hr/>
@endsection