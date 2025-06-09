@extends('layouts.app')

@section('content')

    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        {{ $products->name }}
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            @if (session('Success'))
                <div class="alert alert-success">
                    <p>{{ session('Success') }}</p>
                </div>
            @endif

        </div>
        <div class="product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="slider-zoom">
                            <a href="{{ asset('assets/img/' . $products->image . '') }}" class="cloud-zoom"
                                rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10"
                                id="cloudZoom">
                                <img alt="Detail Zoom thumbs image" src="{{ asset('assets/img/' . $products->image . '') }}"
                                    style="width: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <strong>Overview</strong><br>
                            {{ $products->description }}

                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <strong>Price</strong> (/Pack)<br>
                                    <span class="price">Php {{ $products->price }}</span>
                                    {{-- <span class="old-price">Rp 150.000</span> --}}
                                </p>
                            </div>

                        </div>
                        <p class="mb-1">
                            <strong>Quantity</strong>
                        </p>
                        <form method="POST" action="{{ route('products.add.cart') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <input name="qty" class="form-control" type="number" min="1"
                                        data-bts-button-down-class="btn btn-primary"
                                        data-bts-button-up-class="btn btn-primary" value="1">
                                </div>
                                <div class="col-sm-6"><span class="pt-1 d-inline-block">Pack (1000 gram)</span></div>
                            </div>

                            <input name="name" value="{{ $products->name }}" type="hidden">
                            <input name="price" value="{{ $products->price }}" type="hidden">
                            <input name="pro_id" value="{{ $products->id }}" type="hidden">
                            <input name="image" value="{{ $products->image }}" type="hidden">

                            @if ($checkInCart > 0)
                                <button disabled class="mt-3 btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-basket"></i> Added to Cart
                                </button>
                            @else
                                <button type="submit" name="submit" class="mt-3 btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-basket"></i> Add to Cart
                                </button>
                            @endif
                        </form>

                    </div>
                </div>
            </div>

            <section id="related-product">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title">Related Products</h2>
                            <div class="product-carousel owl-carousel">
                                @if ($relatedProducts->count() > 0)
                                    @foreach ($relatedProducts as $related)
                                        <div class="item">
                                            <div class="card card-product">
                                                <div class="card-ribbon">
                                                    <div class="card-ribbon-container right">
                                                        <span class="ribbon ribbon-primary">SPECIAL</span>
                                                    </div>
                                                </div>
                                                <div class="card-badge">
                                                    <div class="card-badge-container left">
                                                        <span class="badge badge-default">
                                                            Until {{ $related->exp_date }}
                                                        </span>
                                                        <span class="badge badge-primary">
                                                            20% OFF
                                                        </span>
                                                    </div>
                                                    <img src="{{ asset('assets/img/' . $related->image) }}"
                                                        alt="Card image" class="card-img-top">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">
                                                        <a
                                                            href="{{ route('single.product', $related->id) }}">{{ $related->name }}</a>
                                                    </h4>
                                                    <div class="card-price">
                                                        <span class="reguler">Php. {{ $related->price }}</span>
                                                    </div>
                                                    <a href="{{ route('single.product', $related->id) }}"
                                                        class="btn btn-block btn-primary">
                                                        Product Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                            </div>
                        @else
                            <p class="alert alert-success">There are no related products in this category</p>
                            @endif
                        </div>
                    </div>
            </section>
        </div>
