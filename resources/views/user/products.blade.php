@extends('layout.app')

@section('title', 'Products')

@section('content')

<div class="products_container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="page-header position-relative">
                <div class="header-title">
                    <h1>Products List</h1>
                </div>
                <div class="header-buttons">
                        <a href="{{url('logout')}}" style="color: blue; width: auto;">
                             Logout
                        </a>
                    </div>
            </div>
        </div>
    
</div>
    <br/>
    <div class="product well bordered-left bordered-themeprimary">
        <div class="row">
            @if(count($products) > 0)
                @foreach ($products as $product)
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="databox databox-xlg radius-bordered databox-shadowed databox-graded">
                        <div class="databox-left bg-pink">
                            <div class="databox-piechart">
                                <img src="{{asset('img/avatars/bing.png ')}}" class="product_img" />
                            </div>
                        </div>
                        <div class="databox-right bordered-thick bordered-warning">
                            <div class="databox-row row-6 bordered-platinum padding-10">
                                <div class="databox-cell cell-6 no-padding">
                                    <span class="databox-title darkgray">{{ $product->name }}</span>
                                    <span class="databox-text darkgray">{{ $product->description }}</span>
                                </div>
                            </div>
                            <div class="databox-row row-3 bordered-bottom bordered-platinum">
                                <span class="databox-text darkgray padding-10">PRODUCT TYPE</span>
                                <div class="databox-stat bg-yellow radius-bordered">
                                    <div class="stat-text">{{ isset($product_types[$product->product_type_id]) ? $product_types[$product->product_type_id] : ""}}</div>
                                </div>
                            </div>
                            <div class="databox-row row-3">
                                <span class="databox-text darkgray padding-10">LOCATION</span>
                                <div class="databox-stat bg-pink radius-bordered">
                                    <div class="stat-text">{{ isset($locations[$product->location_id]) ? $locations[$product->location_id] : ""}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="error alert alert-warning fade in radius-bordered alert-shadowed">
                    <i class="fa-fw fa fa-times"></i>
                    <strong>Oops!</strong> There is no product in your region
                </div>
            @endif
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>

@endsection