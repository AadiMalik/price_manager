@extends('layouts.frontend')

@section('content')
<div class="page-header">
    <h1 style="color:#fff; font-size:35px; font-weight:bold;">Frequently Asked Questions</h1>
</div>
<!-- FAQ - START -->
<div class="container">
    <div class="panel-group" id="accordion">
        @foreach($faq as $loop => $item)
        <div class="card">
            <div class="card-header" style="padding: 0px 1.25rem; color:#000;">
                <h4 class="panel-title" style="margin-top:0px;">
                    <a  class="accordion-toggle @if($loop->first) @else  collapsed @endif" data-toggle="collapse" style="color:#da5c22; font-size:22px; font-weight:bold; font-style: none;" href="#collapse{{$item->id}}">{{$item->heading}}
                    <span style="float:right; margin-top:5px;" class="fa fa-arrow-down"></span></a>
                </h4>
            </div>
            <div id="collapse{{$item->id}}" class="panel-collapse collapse in">
                <div class="body" style="padding:10px;">
                    <div style="text-align:justify;">
                        {{$item->description}}
                    </div>
                    <hr>
                    <div style="text-align:right;">
                        {{$item->urdu}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection