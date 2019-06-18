@extends('layouts.app', [
    'show_header' => false,
    'show_fab' => false,
])

@section('body_classes', 'page-login full-height grey lighten-4')

@section('content')
    <div class="valign-wrapper full-height">
        <div class="container">
        <div class="row">
            <div class="col s4 offset-s4">

                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Login</span>

                        <form id="login-form" name="login-form">
                            <div class="input-field">
                                <input id="email" type="email" autocomplete="off" class="validate">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </form>
                    </div>
                    <div class="card-action">
                        <button class="waves-effect waves-light btn">Login</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
