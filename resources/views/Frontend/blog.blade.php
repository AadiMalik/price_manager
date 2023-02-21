@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.frontend')
@section('content')
  <div class="container mt-5">
     <div class="row">
         <div class="col-md-12">
             <h2>Blogs</h2>
             <hr/>
         </div>
     </div>
  <div class="row">
    <div class="col-md-8" style="border-right:2px solid #4444;">
      @foreach($blog as $item)
        <div class="card mb-3">
            @if(isset($item->image))
          <a href="{{url('blog-detail/'.$item->slug)}}"><img src="{{asset($item->image??'')}}" style="height: 300px;" class="card-img-top" alt="..."></a>
          @endif
          <div class="card-body" style="margin-top:10px; padding:6px;">
            <a href="{{url('blog-detail/'.$item->slug)}}" style="text-decoration: none;"><h5 class="card-title" style="margin-bottom:0px;"><b>{{$item->title??''}}</b></h5></a>
            <hr style="margin-top:0px;"/>
            <p class="card-text">{!! Str::limit($item->description, 100, ' ...') !!}</p>
            <hr style="margin-bottom:0px;"/>
            <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()??''}}</small></p>
          </div>
        </div>
    @endforeach
    <div>
        {!! $blog->links() !!}
    </div>
    </div>
    <div class="col-12 col-md-4">
        <h5>Search blog</h5>
        <form method="GET" action="{{url('blog-search')}}">
         @csrf
        <div class="row">
            <div class="col-md-10">
                <input type="text" class="form-control" name="search"/>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
        </form>
          <hr/>
        <h5>Other Blogs</h5>
          <hr/>
    @foreach($otherblog->take(4) as $item)
      <div class="card mb-3">
          @if(isset($item->image))
          <a href="{{url('blog-detail/'.$item->slug)}}"><img src="{{asset($item->image??'')}}" class="card-img-top" alt="..."></a>
          @endif
          <div class="card-body" style="margin-top:10px; padding:6px;">
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