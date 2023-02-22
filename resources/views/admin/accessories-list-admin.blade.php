@extends("layouts.app")
@section("content")
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <div class="container">
        @if(session('info'))
            <div class="row justify-content-center">
                <div class="col-4 alert alert-success align-content-center">
                    <i class="bi bi-check-circle-fill"></i> &nbsp; {{ session('info') }}
                </div>
            </div>
        @elseif(session('success'))
            <div class="row justify-content-center">
                <div class="col-4 alert alert-success align-content-center">
                    <i class="bi bi-check-circle-fill"></i> &nbsp; {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="btn-toolbar">
                <div class="col-4">
                    <a class="btn btn-sm btn-primary" href="{{url('/products/get-products-list/add/2')}}"><i
                            class="bi bi-clipboard-plus-fill"></i> &nbsp; ADD NEW ACCESSORY</a>
                </div>
                <div class="btn-group ml-4 justify-content-end">
                    <select name="acc_search_brand" id="acc_search_brand" class="form-select form-select-sm"
                            style="margin-right: 8px; height:  32px; width: 240px;" aria-label="Select Role">
                        <option selected value="">-- Brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <select name="acc_search_model" id="acc_search_model" class="form-select form-select-sm"
                            style="margin-right: 8px; height: 32px; width: 240px;" aria-label="Select Role">
                    </select>
                    <a id="search" class="btn btn-sm btn-primary rounded-2" style="height:  32px; text-align: center;"
                       href="#">SEARCH</a>
                </div>
            </div>
        </div>
        @if($accessories && $accessories->isNotEmpty())
            <div style="margin-top: 10px;">
                <table>
                    <tr>
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">Product ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Brand</th>
                        <th style="text-align: center;">Model</th>
                        <th style="text-align: center;">Price (Ks)</th>
                        <th style="text-align: center;">Available Count</th>
                        <th style="text-align: center;">Detail</th>
                        <th style="text-align: center;">Edit</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                    @foreach($accessories as $item)
                        <tr>
                            <td style="text-align: center;">{{ ($loop->index) + 1 }}.</td>
                            <td style="text-align: center;">{{ $item->id }}</td>
                            <td>{{$item->name}}</td>
                            <td style="text-align: center;">{{$item->brand->name}}</td>
                            <td style="text-align: center;">{{$item->model->name}}</td>
                            <td style="text-align: right;">{{$item->price}}</td>
                            <td style="text-align: center;">
                                @if($item->available_count)
                                    {{ $item->available_count }}
                                @else
                                    <span class="text-danger"><strong>{{ $item->available_count }}</strong></span>
                                @endif
                            </td>
                            <td style="text-align: center;width: 80px;">
                                <a style="width: 64px"
                                   class="btn btn-sm btn-primary"
                                   href="{{ url('/products/get-accessories/detail/'.$item->id) }}"><small>DETAIL</small></a>
                            <td style="text-align: center;width: 80px;">
                                <a style="width: 64px"
                                   class="btn btn-sm btn-primary"
                                   href="{{ url('/products/get-accessories/admin/edit/'.$item->id) }}"><small>EDIT</small></a>
                            <td style="text-align: center;width: 80px;">
                                <form id="delete-form-{{ $item->id }}"
                                      action="{{ route('accessory.delete', $item->id) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                                <a style="width: 64px"
                                   class="btn btn-sm btn-outline-danger"
                                   href="#" onclick="confirmDelete({{ $item->id }})"><small>DELETE</small></a>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $accessories->links() }}
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
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
        //on category option changed.
        $("#acc_search_model").on('change', function () {
            var brand_id = document.getElementById("acc_search_brand").value;
            var model_id = this.value;
            setupSearchLink(brand_id, model_id);
        });

        //on brand option changed.
        $("#acc_search_brand").on('change', function () {
            var brand_id = this.value;
            var model_id = '';
            setupSearchLink(brand_id,model_id);
            $.ajax({
                url: "{{ route('models.list') }}",
                data: {
                    "category_id": 2,
                    "brand_id": brand_id
                },
                type: 'get',
                success: function (result) {
                    console.log(result.data);
                    if (result.data) {
                        $('#acc_search_model').empty();
                        $("#acc_search_model").append('<option selected value="">-- Model --</option>')
                        $.each(result.data, function (key, value) {
                            $("#acc_search_model").append('<option' + ' value="' + value.model_id + '">' + value.name + '</option>')
                        });
                    }
                }
            });
        });

        $(document).ready(function () {
            var brand_id = '';
            var model_id = '';
            setupSearchLink(brand_id, model_id);
        });

        function setupSearchLink(brand_id, model_id) {
            if(brand_id === ''){
                brand_id = 0;
            }
            if(model_id === '') {
                model_id = 0;
            }
            console.log("[" + brand_id + "," + model_id + "]");
            if (brand_id === "" && model_id === "") {
                $('#search').attr('href', '/products/get-accessories/admin');
            } else {
                $('#search').attr('href', '/products/get-accessories/admin/filter/' + brand_id + "/" + model_id);
            }
        }
    </script>
@endsection
