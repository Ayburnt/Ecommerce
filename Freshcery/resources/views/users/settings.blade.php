@extends('layouts.app')

@section('content')
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0"
             style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}'); background-size: cover;">
            <div class="container text-white py-5">
                <h1 class="pt-5">Settings</h1>
                <p class="lead">Update Your Account Info</p>
            </div>
        </div>
    </div>

    <section id="account-settings" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <h4 class="mb-4 text-center">Account Details</h4>

                            <form action="#" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input id="name" name="name" class="form-control" type="text" value="{{ $user->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="2">{{ $user->address }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="town" class="form-label">Town / City</label>
                                    <input id="town" name="town" class="form-control" type="text" value="{{ $user->town }}">
                                </div>

                                <div class="mb-3">
                                    <label for="state" class="form-label">State / Country</label>
                                    <input id="state" name="state" class="form-control" type="text" value="{{ $user->state }}">
                                </div>

                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Postcode / Zip</label>
                                    <input id="zip_code" name="zip_code" class="form-control" type="text" value="{{ $user->zip_code }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" name="email" class="form-control" type="email" value="{{ $user->email }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input id="phone_number" name="phone_number" class="form-control" type="tel" value="{{ $user->phone_number }}">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update Info</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
