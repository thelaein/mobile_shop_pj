@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Update Product</div>
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <ul style="margin-right: 32px">
                                <li class="list-group-item" style="box-sizing: border-box; padding: 24px;">

                                    <form class="row g-3" method="POST" action="{{ url('/products/get-products-list/update') }}">
                                        @csrf

                                        <input type="hidden" name="edit_product_id" value="{{ $product->id }}">

                                        <div class="col-md-4">
                                            <label for="edit_category" class="form-label">
                                                Category <span class="text-danger">*</span></label>
                                            <select name="edit_category" id="edit_category" class="form-select" disabled>
                                                @foreach($categories as $category)
                                                    <option
                                                        {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_brand" class="form-label">
                                                Brand <span class="text-danger">*</span></label>
                                            <select name="edit_brand" id="edit_brand" class="form-select" disabled>
                                                @foreach($brands as $brand)
                                                    <option
                                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_model" class="form-label">
                                                Model <span class="text-danger">*</span></label>
                                            <select name="edit_model" id="edit_model" class="form-select" disabled>
                                                @foreach($models as $model)
                                                    <option
                                                        {{ $product->model_id == $model->id ? 'selected' : '' }} value="{{$model->id}}">{{$model->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_product_name" class="form-label">
                                                Product Name <span class="text-danger">*</span></label>
                                            <input name="edit_product_name" type="text" value="{{ $product->name }}"
                                                   class="form-control" maxlength="100"
                                                   id="edit_product_name"
                                                   placeholder="Enter product name">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_product_price" class="form-label">
                                                Product Price (MMK) <span class="text-danger">*</span></label>
                                            <input name="edit_product_price" type="number" value="{{ $product->price }}"
                                                   class="form-control"
                                                   id="edit_product_price"
                                                   placeholder="Enter price in MMK">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_product_count" class="form-label">
                                                Add Product Count <span class="text-danger">*</span></label>
                                            <input name="edit_product_count" type="number"
                                                   value="{{ $product->available_count }}"
                                                   class="form-control" id="edit_product_count"
                                                   placeholder="Enter Count">
                                        </div>

                                        <!--<div class="col-12">
                                            <label for="edit_img_file" class="form-label">
                                                Choose Product Photo [max: 2MB] <span
                                                    class="text-danger">*</span></label>
                                            <input name="edit_img_file" class="form-control" type="file"
                                                   accept="image/jpeg,image/png,image/jpg" id="edit_img_file">
                                        </div>-->

                                        <div class="col-12">
                                            <span class="input-group-text">
                                                Product Description <span class="text-danger">*</span></span>
                                            <textarea disabled name="edit_description" maxlength="1000" id="edit_description" class="form-control"
                                                      aria-label="With textarea">{{ $product->description }}</textarea>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-arrow-left-circle"></i> &nbsp; BACK TO PRODUCT LIST</a>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    style="float: right; margin-left: 8px;"><i
                                                    class="bi bi-clipboard-plus-fill"></i> &nbsp;SUBMIT
                                            </button>
                                            <button type="reset" class="btn btn-primary btn-sm" style="float: right;">
                                                <i class="bi bi-arrow-counterclockwise"></i> &nbsp;RESET
                                            </button>
                                        </div>

                                    </form>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //on brand option changed.
        $("#edit_brand").on('change', function () {
            var category_id = document.getElementById("edit_category").value;
            var brand_id = this.value;
            $.ajax({
                url: "{{ route('models.list') }}",
                data: {
                    "category_id": category_id,
                    "brand_id": brand_id
                },
                type: 'get',
                success: function (result) {
                    if (result.data) {
                        $('#edit_model').empty();
                        $.each(result.data, function (key, value) {
                            $("#edit_model").append('<option value="' + value.model_id + '">' + value.name + '</option>')
                        });
                    }
                }
            });
        });

        //on category option changed.
        $("#edit_category").on('change', function () {
            var brand_id = document.getElementById("edit_brand").value;
            var category_id = this.value;
            $.ajax({
                url: "{{ route('models.list') }}",
                data: {
                    "category_id": category_id,
                    "brand_id": brand_id
                },
                type: 'get',
                success: function (result) {
                    if (result.data) {
                        $('#edit_model').empty();
                        $.each(result.data, function (key, value) {
                            $("#edit_model").append('<option value="' + value.model_id + '">' + value.name + '</option>')
                        });
                    }
                }
            });
        });

    </script>
@endsection
