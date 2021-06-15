@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Orders <a href="{{ route('home') }}" class="btn btn-success">Home</a></h1>
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

                    <form action="{{ route('order_store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Product Name</label>
                            
                            <select name="name" class="form-control">
                                <option selected>Choose...</option>
                                @foreach ($products as $item)
                                <option value="{{ $item->name }}" class="from-control">{{ $item->name }}</option>
                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Qty.</label><br>
                            
                            <input type="number" name="qty" class="form-control" placeholder="Enter Quantity">
                        </div>

                        <input type="submit" name="submit" value="submit" class="btn btn-primary">
                    </form>


                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td scope="row">{{ $item->id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td><a href="edit/{{ $item->id }}" class="btn btn-sm btn-primary">Edit</a></td>
                                <td><a href="delete/{{ $item->id }}" class="btn btn-sm btn-danger">Delete</a></td>
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