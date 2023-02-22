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

        .bg-facebook {
            background-color: #3b5998 !important;
            border: 1px solid #3b5998;
            color: white;
        }
    </style>
    <div class="container">
        <div class="btn-toolbar">
            <div class="btn-group ml-4 justify-content-end" style="margin-right: 10px;">
                <select id="filtered_status" name="filtered_status" class="form-select form-select-sm"
                        aria-label="Select Status">
                    @if($status === 'ALL')
                        <option selected value="ALL">ALL STATUS</option>
                    @else
                        <option value="ALL">ALL STATUS</option>
                    @endif
                    @if($status === 'PURCHASED')
                        <option selected value="PURCHASED">PURCHASED</option>
                    @else
                        <option value="PURCHASED">PURCHASED</option>
                    @endif
                    @if($status === 'PACKAGING')
                        <option selected value="PACKAGING">PACKAGING</option>
                    @else
                        <option value="PACKAGING">PACKAGING</option>
                    @endif
                    @if($status === 'DELIVERING')
                        <option selected value="DELIVERING">DELIVERING</option>
                    @else
                        <option value="DELIVERING">DELIVERING</option>
                    @endif
                    @if($status === 'RECEIVED')
                        <option selected value="RECEIVED">RECEIVED</option>
                    @else
                        <option value="RECEIVED">RECEIVED</option>
                    @endif
                </select>
            </div>
            <div class="btn-group ml-4">
                <a id="link" href="#" class="btn btn-sm btn-primary">
                    <i class="bi bi-search"></i>&nbsp;SEARCH
                </a>
            </div>
        </div>
        <div style="margin-top: 10px;">
            <table>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Invoice No.</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Total Amount (MMK)</th>
                    <th style="text-align: center;">Address</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Action</th>
                </tr>
                @foreach($data as $product)
                    <tr>
                        <td style="text-align: center;">{{ ($loop->index) + 1 }}.</td>
                        <td style="text-align: center;">{{ strtoupper($product->invoice_number) }}</td>
                        <td style="text-align: center;">{{ $product->user_name }}</td>
                        <td style="text-align: center;">{{ $product->created_at }}</td>
                        <td style="text-align: right;">{{ number_format($product->total_amount, 0, '.', ',') }}</td>
                        <td style="text-align: left;">{{ $product->address }}</td>
                        @if($product->delivery_status === "PURCHASED")
                            <td style="text-align: center;">
                                <button type="button" style="width: 90px;" class="btn btn-sm bg-primary">
                                    <small>
                                        <strong
                                            class="text-light">{{ str_replace("_", " ", $product->delivery_status) }}</strong>
                                    </small>
                                </button>
                            </td>
                        @elseif($product->delivery_status === "PACKAGING")
                            <td style="text-align: center;">
                                <button type="button" style="width: 90px;" class="btn btn-sm bg-info">
                                    <small>
                                        <strong
                                            class="text-light">{{ str_replace("_", " ", $product->delivery_status) }}</strong>
                                    </small>
                                </button>
                            </td>
                        @elseif($product->delivery_status === "DELIVERING")
                            <td style="text-align: center;">
                                <button type="button" style="width: 90px;" class="btn btn-sm bg-warning">
                                    <small>
                                        <strong
                                            class="text-light">{{ str_replace("_", " ", $product->delivery_status) }}</strong>
                                    </small>
                                </button>
                            </td>
                        @elseif($product->delivery_status == "RECEIVED")
                            <td style="text-align: center;">
                                <button type="button" style="width: 90px;" class="btn btn-sm bg-success">
                                    <small>
                                        <strong
                                            class="text-light">{{ str_replace("_", " ", $product->delivery_status) }}</strong>
                                    </small>
                                </button>
                            </td>
                        @else
                            <td style="text-align: center;">N/A</td>
                        @endif
                        <td style="text-align: center;"><a style="width: 64px" class="btn btn-sm btn-outline-danger"
                                                           href="{{ url('/sold-list/get-sold-list/admin/'.$product->invoice_number) }}"><small>CHECK</small></a>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links() }}
        </div>
    </div>
    <script>
        $("#filtered_status").on('change', function () {
            var filteredStatus = this.value;
            $('#link').attr('href', '/sold-list/get-sold-list/admin/filter/' + filteredStatus);
        });
    </script>
@endsection
