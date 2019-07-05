@extends('layouts.error', [
    'show_button' => false,
])

@section('code', 'Hooray!')
@section('title', __('Thank you'))

@section('message')
    Your payment has been received and is currently being processed, you will
    receive a receipt via email shortly. If you don\'t receive an email soon -
    check your "spam" folder.
@endsection
