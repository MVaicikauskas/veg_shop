@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Orders') }}
                    <a class="btn btn-primary" href="{{ route('order.create') }}">Create new order</a>
                </div>

                <div class="card-body">
                    @if (Auth::user()->role_id === 1)
                    <form action="{{ route('order.index') }}" method="get">
                        <label for="by_amount">Show all orders</label>
                        <input type="checkbox" value="all" name="all" id="">
                        <button type="submit" class="btn btn-info">Filter</button>
                    </form>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Products</th>
                                <th>Order amount</th>
                                <th>Order created</th>
                                @if (Auth::user()->role_id === 1)
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <td>{{$order->id}}</td>
                                <td>
                                    @foreach ($order->products as $product)
                                    {{ $product->name }},
                                    @endforeach
                                </td>
                                <td>{{$order->order_amount}}</td>
                                <td>{{$order->created_at}}</td>
                                <td><a class="btn btn-warning" href="{{ route('order.edit', $order->id) }}">Edit</a>
                                    @if (Auth::user()->role_id === 1)
                                        <form class="d-inline" action="{{ route('order.delete', $order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form></td>
                                    @endif
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
