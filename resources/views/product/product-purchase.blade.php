@extends("layouts.app")
@section("content")
    <div class="container">
        @if($data)
            <div class="row justify-content-center py-sm-1">
                <div class="col-md-6">
                    <div class="card item-product bg-white rounded-2">
                        <div class="row">
                            <div class="col">
                                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="container-fliud">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul style="margin-bottom: 0px;">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="wrapper row" style="margin-top: 24px; margin-left: 16px;">
                                            <div class="preview col-2">
                                            </div>
                                            <div class="preview col-10">
                                                <form class="row g-3" method="POST"
                                                      action="{{ url('/products/cart/purchase/save') }}">
                                                    @csrf
                                                    <input type="hidden" name="delivery_fee"
                                                           value="{{ $delivery_fee }}">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="delivery_phone_number" class="form-label">Phone
                                                                Number <span class="text-danger">*</span></label>
                                                            <input type="tel" class="form-control" maxlength="20"
                                                                   id="delivery_phone_number"
                                                                   name="contact_phone_number"
                                                                   placeholder="09 xxxxxxxxx">
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="delivery_location" class="form-label">Delivery
                                                                Location <span class="text-danger">*</span></label>
                                                            <textarea name="delivery_location" maxlength="200"
                                                                      id="delivery_location"
                                                                      class="form-control"
                                                                      aria-label="With textarea"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <label class="form-label">Choose Payment Method <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="payMethodRadios" id="payMethodRadios1"
                                                                   value="CASH_ON_DELIVERY" checked>
                                                            <label class="form-check-label" for="payMethodRadios1">
                                                                CASH ON DELIVERY
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="payMethodRadios" id="payMethodRadios2"
                                                                   value="MPU">
                                                            <label class="form-check-label" for="payMethodRadios2">
                                                                MPU
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="payMethodRadios" id="payMethodRadios3"
                                                                   value="VISA_CARD">
                                                            <label class="form-check-label" for="payMethodRadios3">
                                                                VISA CARD
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="payMethodRadios" id="payMethodRadios4"
                                                                   value="MASTER_CARD">
                                                            <label class="form-check-label" for="payMethodRadios4">
                                                                MASTER CARD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 mt-4 mb-4"
                                                         style="display: flex; justify-content: space-between;">
                                                        <a style="width: 45%;" class="btn btn-sm btn-primary"
                                                           href="{{ url()->previous() }}">
                                                            <i class="bi bi-cart-plus-fill"></i> &nbsp; CART LIST</a>
                                                        <button style="width: 45%;" class="btn btn-sm btn-primary"
                                                                type="submit">
                                                            <i class="bi bi-bag-check-fill"></i> &nbsp; SUBMIT
                                                        </button>
                                                    </div>
                                                </form>
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
@endsection
