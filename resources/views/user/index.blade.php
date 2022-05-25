@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Users') }}
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <form action="{{ route('user.index') }}" method="get">
                        <label for="by_name">Order user list by user's name</label>
                        <input type="checkbox" value="by_name" name="by_name" id="">
                        <button type="submit" class="btn btn-info">Filter</button>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Have Orders</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->orders->count()}}</td>
                                <td>
                                    @if(Auth::user()->role_id === 1)
                                        @if ($user->orders->count() == 0)
                                        <form class="d-inline" action="{{ route('user.delete', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="order_count" value="0">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @endif
                                    @endif
                                </td>
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
