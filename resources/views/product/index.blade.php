@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Products') }}
                        <a class="btn btn-success" href="{{ route('product.create')}}">Create Product</a>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <form action="{{ route('product.index') }}" method="get">
                        <label for="by_order">Show products without Orders</label>
                        <input type="checkbox" value="no_orders" name="by_order" id="">
                        <button type="submit" class="btn btn-info">Filter</button>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Ordered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->orders->count()}}</td>
                                <td><a class="btn btn-warning" href="{{ route('product.edit', $product->id) }}">Edit</a>
                                <form class="d-inline" action="{{ route('product.delete', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form></td>
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
