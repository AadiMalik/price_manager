@extends('layouts.frontend')

@section('content')

<div class="page-header">
    <h2 style="color:#fff; font-weight:bold;">Terms & Conditions</h2>
</div>
<div class="container">
    <div class="row">
        @foreach($term as $index => $item)
        <div class="col-lg-12">
            <h4>@if(!$loop->first){{$index}}.@endif {{$item->heading}}</h4>
            <div style="text-align:justify;">
                <p style=" font-size: 16px;">{!!nl2br(e($item->description))!!}</p>
            </div>
            <hr>
            <div style="text-align:end;">
                <p style="font-family: system-ui; font-size: 16px;">{!!nl2br(e($item->urdu))!!}</p>
            </div>
        </div>
        @endforeach
    </div>
  
<!--  <div class="item">-->
<!--     <div class="item-header" id="headingTwo">-->
<!--        <h2 class="mb-0">-->
<!--           <button class="btn btn-link collapsed" type="button" data-toggle="collapse"-->
<!--              data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">-->
<!--           Collapsible Item #2-->
<!--           <i class="fa fa-angle-down"></i>-->
<!--           </button>-->
<!--        </h2>-->
<!--     </div>-->
<!--     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"-->
<!--        data-parent="#accordionExample">-->
<!--        <div class="t-p">-->
<!--It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).-->
<!--        </div>-->
<!--     </div>-->
<!--  </div>-->
</div>
</div>
@endsection