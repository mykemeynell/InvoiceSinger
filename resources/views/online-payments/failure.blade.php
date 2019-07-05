@extends('layouts.error', [
    'show_button' => false,
])

@section('code', 'Sorry')
@section('title', __('Something went wrong'))

@section('message')
    Something went wrong whilst our payment provider was attempting to process
    your transaction.
@endsection
