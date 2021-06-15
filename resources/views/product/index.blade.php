@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Products <a href="{{ route('home') }}" class="btn btn-success">Home</a></h1>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('product_store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Enter SKU">
                        </div>

                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                        </div>

                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter Price">
                        </div>

                        <div class="form-group">
                            <label for="">Qty.</label>
                            <input type="number" name="qty" class="form-control" placeholder="Enter Quantity">
                        </div>

                        <input type="submit" name="submit" value="submit" class="btn btn-primary">
                    </form>


                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td scope="row">{{ $item->SKU }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection