@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('info'))
                    <div class="alert alert-danger">
                        {{ session('info') }}
                    </div>
                @endif
                <div class="card">
                    <div class="cart-icon" style="position: absolute; top: 8px; right: 14px;">
                        <a style="text-decoration: none" href="{{ url()->previous() }}">
                            <i class="bi bi-escape"></i></a>
                    </div>
                    <div class="card-header">{{ $accessory->name }}</div>
                    <div class="row">
                        <div class="col">
                            <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                <div class="container-fliud">
                                    <div class="wrapper row">
                                        <div class="preview col-md-6">
                                            <div class="preview-pic tab-content">
                                                <div class="tab-pane active"
                                                     style="text-align: center; margin-bottom: 24px;"
                                                     id="pic-1">
                                                    <img src="{{ $accessory->photo_url }}" width="280"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="details col-md-6">
                                            <h3 class="product-title">{{ $accessory->name }}</h3>
                                            <p>{{ $accessory->description }}</p>

                                            <p><small>PRODUCT ID: </small>
                                                <strong>{{ $accessory->id }}</strong>
                                            </p>

                                            <p><small>AVAILABLE COUNT:</small>
                                                <strong
                                                    id="availability">{{ $accessory->available_count }}</strong>
                                            </p>

                                            <p><small>CATEGORY: </small>
                                                <strong>{{ $accessory->category->name }}</strong>
                                            </p>

                                            <p><small>BRAND: </small>
                                                <strong>{{ $accessory->brand->name }}</strong>
                                            </p>

                                            <p><small>MODEL: </small>
                                                <strong>{{ $accessory->model->name }}</strong>
                                            </p>

                                            <p><small>UPLOADED DATE: </small>
                                                <strong>{{ $accessory->created_at->diffForHumans() }}</strong>
                                            </p>

                                            <p><small>PRICE: </small>
                                                <strong
                                                    style="color: orangered">{{number_format($accessory->price, 0, '.', ',')}}</strong>
                                                <small>MMK</small>
                                            </p>

                                            <form action="{{ url('/products/accessories/add-to-cart') }}"
                                                  method="post">
                                                @csrf
                                                <input id="id_count" type="hidden" value="0"
                                                       name="picked_count">
                                                <input type="hidden" name="accessory_id"
                                                       value="{{ $accessory->id }}">
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @unless(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                                        <div>
                                                            <button class="btn border-light bg-light" type="button"
                                                                    style="margin-right: 8px;" id="increment">+
                                                            </button>
                                                            @if($cart_item)
                                                                <span
                                                                    id="number">{{ $cart_item->item_count }}</span>
                                                            @else
                                                                <span id="number">0</span>
                                                            @endif
                                                            <button class="btn border-light bg-light" type="button"
                                                                    style="margin-left: 8px;" id="decrement">-
                                                            </button>
                                                        </div>
                                                        <div class="action">
                                                            <div class="btn-group ml-4 mt-4" role="group"
                                                                 aria-label="Third group">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="bi bi-cart-plus-fill"></i>
                                                                    &nbsp;&nbsp;ADD TO CART
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endunless
                                                @endif
                                                @guest
                                                    <div class="action">
                                                        <div class="btn-group ml-4 mt-4" role="group"
                                                             aria-label="Third group">
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <i class="bi bi-cart-plus-fill"></i>
                                                                &nbsp;ADD TO CART
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endguest
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
    </div>
@endsection

