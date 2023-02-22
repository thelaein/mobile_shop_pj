@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="btn-toolbar justify-content-center">
            <div>
                <div class="btn-group ml-4" style="margin-right: 10px;">
                    <input style="width: 320px;" class="form-control form-control-sm mr-sm-2" type="search"
                           id="keyword" name="keyword" maxlength="100"
                           placeholder="Text to search by product name and description"
                           value="{{ $keyword }}" aria-label="Search">
                </div>
                <div class="btn-group ml-4">
                    <a id="link" href="#" class="btn btn-sm btn-primary my-2 my-sm-0">
                        <i class="bi bi-search"></i>&nbsp;SEARCH
                    </a>
                </div>
                <div class="btn-group ml-4" style="margin-left: 10px;">
                    @if($cart_list_count > 0)
                        <span class="badge badge-danger bg-danger rounded-4"
                              style="position: absolute; top: -8px; right: -8px; z-index: 2;">
                            <small>{{ $cart_list_count }}</small></span>
                    @endif
                    <a class="btn rounded-2 btn-sm btn-primary" href="{{ url('/info/get-my-cart') }}"
                       style="position: relative; z-index: 1;">
                        <i class="bi bi-cart"></i>
                    </a>
                </div>
            </div>
        </div>
        @if($accessories && $accessories->isNotEmpty())
            <div class="row">
                @foreach($accessories as $accessory)
                    <div class="col-md-3 mt-4">
                        <div class="card item-product bg-white rounded-2" style="width: auto">
                            <img style="width: 100px; margin-left: 18px; margin-top: 18px;"
                                 src="{{$accessory->photo_url}}"
                                 class="card-img-top" alt="{{$accessory->name}}">
                            <div class="card-body">
                                <h5 class="card-title item-product-name">{{$accessory->name}}</h5>
                                <p class="card-text item-product-description">{{$accessory->description}}</p>
                                <p class="card-text"
                                   style="color: orangered">{{number_format($accessory->price, 0, '.', ',')}}
                                    &nbsp; MMK</p>
                            </div>
                            <div class="card-footer text-muted" style="text-align: center;">
                                <a href="{{ url('/products/get-accessories/detail/'.$accessory->id) }}"
                                   style="text-decoration: none;" class="card-link"><span>SHOP NOW</span></a>
                            </div>
                            <div class="cart-icon" style="position: absolute; top: 12px; right: 18px;">
                                @if($accessory->available_count > 0)
                                    <span style="font-family: 'Century Gothic'"
                                          class="badge text-sm-center bg-primary">Available Count : {{$accessory->available_count}}</span>
                                @else
                                    <span style="font-family: 'Century Gothic'"
                                          class="badge text-sm-center bg-danger">Sold Out</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-4">
                    {{ $accessories->links() }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="d-flex justify-content-center mt-4">
                    <div class="alert alert-danger">
                        <i class="bi bi-binoculars"></i> &nbsp; NO INFORMATION FOUND.
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            updateSearchLink("");
            $("#keyword").on('input', function () {
                var keyword = this.value;
                updateSearchLink(keyword);
            });
        });

        function updateSearchLink(keyword) {
            if (keyword === "") {
                $('#link').attr('href', '/products/get-accessories');
            } else {
                $('#link').attr('href', '/products/get-accessories/search/' + keyword);
            }
        }
    </script>
@endsection
