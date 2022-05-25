@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Order') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('order.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                            <div class="row mb-3">
                                <select class="form-select" name="product[]" id="product" multiple>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}"@if(in_array($product->id, $selected_products)) selected @endif>{{ $product->name}}, {{$product->price}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Order') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
