@extends("layouts.app")
@section("content")
    <div class="container">
        @if($data && $data->isNotEmpty())
            @foreach($data as $product)
                <div class="row justify-content-end py-sm-1">
                    <div class="col-md-6">
                        <div class="card item-product bg-white rounded-2">
                            <div class="row">
                                <div class="col">
                                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                        <div class="container-fliud">
                                            <div class="wrapper row">
                                                <div class="preview col-md-4">
                                                    <div class="preview-pic tab-content">
                                                        <div class="tab-pane active"
                                                             style="text-align: center; margin-bottom: 24px;"
                                                             id="pic-1">
                                                            <img src="{{ $product->product->photo_url }}" width="64"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview col-md-8">
                                                    <div class="cart-icon"
                                                         style="position: absolute; top: 14px; right: 12px;">
                                                        <a class="btn btn-danger btn-sm"
                                                           href="{{ url('/products/cart/delete/'.$product->id) }}">Remove</a>
                                                    </div>
                                                    <h4 class="product-title">{{ $product->product->name }}</h4>
                                                    <p style="margin-bottom: 0px">
                                                        <small>MODEL: </small>
                                                        <strong>{{ $product->product->model->name }}</strong>
                                                    </p>
                                                    <p style="margin-bottom: 0px">
                                                        <small>COUNT: </small>
                                                        <strong>x{{ $product->item_count }}</strong>
                                                        @if($product->product->category_id === 1)
                                                            <small><a
                                                                    href="{{ url('/products/get-mobile-phones/detail/'.$product->product_id) }}">Edit
                                                                    Count</a></small>
                                                        @else
                                                            <small><a
                                                                    href="{{ url('/products/get-accessories/detail/'.$product->product_id) }}">Edit
                                                                    Count</a></small>
                                                        @endif
                                                    </p>
                                                    <p style="margin-bottom: 0px">
                                                        <small>TOTAL AMOUNT: </small>
                                                        {{ number_format($product->total_amount, 0, '.', ',') }}
                                                        <small>&nbsp;MMK</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row py-sm-1 justify-content-end">
                <div class="col-md-6">
                    <div class="card item-product bg-white rounded-2">
                        <div class="row">
                            <div class="col">
                                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="container-fliud">
                                        <div class="wrapper row">
                                            <div class="preview col-md-4">
                                            </div>
                                            <div class="preview col-md-8">
                                                <p style="margin-bottom: 0px">
                                                    <small>SUB TOTAL: </small>
                                                    <strong>{{ number_format($data->sum('total_amount'), 0, '.', ',') }}</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                                <p style="margin-bottom: 0px">
                                                    <small>DELIVERY FEE: </small>
                                                    <strong>{{ $delivery_fee }}</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                                <p>
                                                    <small>TOTAL: </small>
                                                    <strong>{{ number_format($data->sum('total_amount') + $delivery_fee, 0, '.', ',') }}</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                                <a class="btn btn-sm btn-primary" href="{{ url('/products/cart/purchase/'.$delivery_fee) }}">PURCHASE</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="alert alert-danger" style="text-align: center;">
                        <p style="margin-bottom: 0px;">
                            <i class="bi bi-cart-x"></i> &nbsp;NO PRODUCT SELECTED
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
