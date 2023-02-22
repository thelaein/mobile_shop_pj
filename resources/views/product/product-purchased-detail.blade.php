@extends("layouts.app")
@section("content")
    <div class="container">
        @foreach($invoice as $item)
            <div class="row justify-content-center py-sm-1">
                <div class="col-md-8">
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
                                                        <img src="{{ $item->product->photo_url }}" width="64"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="preview col-md-8">
                                                <h4 class="product-title">{{ $item->product->name }}</h4>
                                                <p style="margin-bottom: 0px">
                                                    <small>MODEL: </small>
                                                    <strong>{{ $item->product->model->name }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0px">
                                                    <small>COUNT: </small>
                                                    <strong>x{{ $item->item_count }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0px">
                                                    <small>TOTAL AMOUNT: </small>
                                                    {{ number_format(($item->product_price * $item->item_count), 0, '.', ',') }}
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
        <div class="row justify-content-center py-sm-1" style="margin-top: 10px;">
            <div class="col-md-8">
                <div class="wrapper row">
                    <div class="preview col-md-4">
                    </div>
                    <div class="preview col-md-8">
                        <p style="margin-bottom: 0px; margin-top: 8px;">
                            <small>&nbsp;BUYER: </small>
                            <strong>{{ $data->user->name }}</strong>
                        </p>
                        <p style="margin-bottom: 0px; margin-top: 8px;">
                            <small>&nbsp;INVOICE NO.: </small>
                            <strong>{{ strtoupper($data->invoice_number) }}</strong>
                        </p>
                        <p style="margin-bottom: 0px; margin-top: 8px;">
                            <small>&nbsp;PAY METHOD: </small>
                            <strong>{{ str_replace("_", " ", $pay_method) }}</strong>
                        </p>
                        <p style="margin-bottom: 0px; margin-top: 8px;">
                            <small>&nbsp;TOTAL AMOUNT: </small>
                            <strong>{{ number_format($data->total_amount, 0, '.', ',') }}</strong>
                            <small>&nbsp;MMK</small>
                        </p>
                        <div class="text-right mx-auto" style="margin-top: 24px;">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group ml-4" role="group" aria-label="Third group">
                                    <a href="{{ url()->previous() }}"
                                       class="btn btn-sm btn-primary">DONE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
