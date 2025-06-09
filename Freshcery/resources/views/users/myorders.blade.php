@extends('layouts.app')

@section('content')
    <div id="page-content" class="page-content">
        {{-- Hero Banner --}}
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}'); background-size: cover; background-position: center;">
                <div class="container">
                    <h1 class="pt-5 text-white">Your Transactions</h1>
                    <p class="lead text-white-50">Save time and leave the groceries to us.</p>
                </div>
            </div>
        </div>

        {{-- Orders Table --}}
        <section id="cart" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        @if($orders->count() > 0)
                            <div class="table-responsive shadow-sm border rounded">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Town</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->last_name ?? '-' }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->phone_number }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->town }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->status === 'Completed' ? 'success' : ($order->status === 'Cancelled' ? 'danger' : 'warning') }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center mt-4">
                                <i class="fas fa-info-circle me-2"></i>
                                You have no orders at the moment.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
