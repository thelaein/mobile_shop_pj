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
        <a class="btn btn-primary" href="{{url('/products/get-products-list/add')}}">+ Add New Product</a>
        <div class="card mt-2">
            <table>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Product ID</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Brand</th>
                    <th style="text-align: center;">Price (Ks)</th>
                    <th style="text-align: center;">Count</th>
                    <th style="text-align: center;">Edit</th>
                    <th style="text-align: center;">Delete</th>
                    <th style="text-align: center;">Detail</th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td style="text-align: center;">{{ ($loop->index) + 1 }}.</td>
                        <td style="text-align: center;">{{ $product->id }}</td>
                        <td>{{$product->name}}</td>
                        <td style="text-align: center;">{{$product->brand->name}}</td>
                        <td style="text-align: right;">{{$product->price}}</td>
                        <td style="text-align: center;">{{$product->available_count}}</td>
                        <td style="text-align: center;"><a style="width: 64px" class="btn btn-sm btn-primary" href="{{ url('/products/get-products-list/edit/'.$product->id) }}">Edit</a>
                        </td>
                        <td style="text-align: center;"><a style="width: 64px" class="btn btn-sm btn-danger" href="#">Delete</a>
                        </td>
                        <td style="text-align: center;"><a style="width: 64px" class="btn btn-sm btn-primary" href="#">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
