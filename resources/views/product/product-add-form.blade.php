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
                    @if($category_id == 1)
                        <div class="card-header">Add New Phone</div>
                    @else
                        <div class="card-header">Add New Accessory</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <ul style="margin-right: 32px">
                                <li class="list-group-item" style="box-sizing: border-box; padding: 24px;">
                                    <form class="row g-3" method="POST" enctype="multipart/form-data"
                                          action="{{ url('/products/get-products-list/add') }}">
                                        @csrf
                                        <div class="col-md-4">
                                            <label for="add_category" class="form-label">
                                                Category <span class="text-danger">*</span></label>
                                            <select name="add_category" id="add_category" class="form-select">
                                                @foreach($categories as $category)
                                                    @if($category->id == $category_id)
                                                        <option selected
                                                                value="{{$category->id}}">{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="add_brand" class="form-label">
                                                Brand <span class="text-danger">*</span></label>
                                            <select name="add_brand" id="add_brand" class="form-select">
                                                <option selected>-- Choose Brand --</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="add_model" class="form-label">
                                                Model <span class="text-danger">*</span></label>
                                            <select name="add_model" id="add_model" class="form-select">
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="product_name" class="form-label">
                                                Product Name <span class="text-danger">*</span></label>
                                            <input name="product_name" type="text" class="form-control"
                                                   id="product_name" maxlength="100"
                                                   placeholder="Enter product name">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="product_price" class="form-label">
                                                Product Price <span class="text-danger">*</span></label>
                                            <input name="product_price" type="number" class="form-control"
                                                   id="product_price"
                                                   placeholder="Enter price in MMK">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="product_count" class="form-label">
                                                Add Product Count <span class="text-danger">*</span></label>
                                            <input name="product_count" type="number" class="form-control"
                                                   id="product_count"
                                                   placeholder="Enter Count">
                                        </div>

                                        <div class="col-12">
                                            <label for="img_file" class="form-label">
                                                Choose Product Photo [max: 2MB] <span
                                                    class="text-danger">*</span></label>
                                            <input name="img_file" class="form-control-file"
                                                   accept="image/jpeg,image/png,image/jpg" type="file" id="img_file">
                                        </div>

                                        <div class="col-12">
                                            <span class="input-group-text">
                                                Product Description <span class="text-danger">*</span></span>
                                            <textarea name="description" maxlength="1000" id="description"
                                                      class="form-control"
                                                      aria-label="With textarea"></textarea>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-arrow-left-circle"></i> &nbsp; BACK TO PRODUCT LIST</a>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    style="float: right; margin-left: 8px;"><i
                                                    class="bi bi-clipboard-plus-fill"></i> &nbsp;SUBMIT
                                            </button>
                                            <button type="reset" class="btn btn-sm btn-primary" style="float: right;">
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
        $("#add_brand").on('change', function () {
            var category_id = document.getElementById("add_category").value;
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
                        $('#add_model').empty();
                        $.each(result.data, function (key, value) {
                            $("#add_model").append('<option value="' + value.model_id + '">' + value.name + '</option>')
                        });
                    }
                }
            });
        });

        //on category option changed.
        $("#add_category").on('change', function () {
            var brand_id = document.getElementById("add_brand").value;
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
                        $('#add_model').empty();
                        $.each(result.data, function (key, value) {
                            $("#add_model").append('<option value="' + value.model_id + '">' + value.name + '</option>')
                        });
                    }
                }
            });
        });

    </script>
@endsection
