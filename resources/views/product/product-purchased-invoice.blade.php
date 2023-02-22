@extends("layouts.app")
@section("content")
    <div class="container">
        @if($data)
            <div class="row justify-content-center py-sm-1">
                <div class="col-md-6">
                    <div class="card item-product bg-white rounded-2">
                        <div class="row">
                            <div class="col">
                                <div style="margin-left: 32px; margin-right: 32px;"
                                     class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="container-fliud">
                                        <div class="wrapper row" style="margin-top: 24px; margin-bottom: 18px;">
                                            <div class="preview col-12">
                                                <h2 style="margin-left: 16px;">INVOICE</h2>
                                            </div>
                                        </div>
                                        <div class="wrapper row" style="margin-top: 10px;">
                                            <div class="preview col-5">
                                                <p style="margin-left: 16px;">PRODUCT NAME</p>
                                            </div>
                                            <div class="preview col-7">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <p>MODEL</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <p>COUNT</p>
                                                    </div>
                                                    <div class="col-6" style="text-align: right;">
                                                        <p>TOTAL</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($data as $product)
                                            <div class="wrapper row">
                                                <div class="preview col-5">
                                                    <p>
                                                        <small>{{ ($loop->index) + 1 }}.</small>
                                                        &nbsp;&nbsp;{{ $product->product->name }}
                                                    </p>
                                                </div>
                                                <div class="preview col-7">
                                                    <div class="wrapper row">
                                                        <div class="preview col-3">
                                                            <p>{{ $product->product->model->name }}</p>
                                                        </div>
                                                        <div class="preview col-3">
                                                            <p>{{ $product->item_count }}x</p>
                                                        </div>
                                                        <div class="preview col-6" style="text-align: right;">
                                                            <p>
                                                                {{ number_format($product->total_amount, 0, '.', ',') }}
                                                                <small>&nbsp;MMK</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="wrapper row">
                                            <div class="preview col-12">
                                                <p class="invoice-dash"
                                                   style="white-space: nowrap; margin-bottom: 0px;">
                                                    -------------------------------------------------------------------------------------------------------------</p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style="margin-left: 8px;">
                                            <div class="preview col-6">
                                                <small style="margin-bottom: 0px;">TOTAL: </small>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ number_format($data->sum('total_amount'), 0, '.', ',') }}</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>DELIVERY FEE: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px">
                                                    <strong>5,000</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>TOTAL AMOUNT: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ number_format($data->sum('total_amount') + 5000, 0, '.', ',') }}</strong>
                                                    <small>&nbsp;MMK</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row">
                                            <div class="preview col-12">
                                                <p class="invoice-dash"
                                                   style="white-space: nowrap; margin-bottom: 0px;">
                                                    -------------------------------------------------------------------------------------------------------------</p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style="margin-left: 8px;">
                                            <div class="preview col-6" style="margin-bottom: 0;">
                                                <p style="margin-bottom: 0px;">
                                                    <small>INVOICE NO.: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;margin-bottom: 0;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ strtoupper($invoice) }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>BUYER: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ $name }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>PAY METHOD: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ str_replace("_", " ", $payMethod) }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>PHONE: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ $phone }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style=" margin-left: 8px;">
                                            <div class="preview col-6">
                                                <p style="margin-bottom: 0px;">
                                                    <small>ADDRESS: </small>
                                                </p>
                                            </div>
                                            <div class="preview col-6" style="text-align: right;">
                                                <p style="margin-bottom: 0px;">
                                                    <strong>{{ $address }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wrapper row" style="margin-top: 24px; margin-bottom: 18px;">
                                            <div class="col" style="width: 100px; text-align: right;">
                                                <form id="show-message-form" action="{{ url('/shop/welcome') }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('GET')
                                                </form>
                                                <a class="btn btn-sm btn-primary" href="#"
                                                   onclick="displaySuccessMessage()"> <i
                                                        class="bi bi-bag-check-fill"></i> &nbsp;DONE</a>
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
        @endif
    </div>

    <script>
        function displaySuccessMessage() {
            if (confirm("Purchased successful!\nYour order will deliver within 2 days.\nThank you for shopping with us.")) {
                document.getElementById(`show-message-form`).submit();
            }
        }
    </script>

@endsection
