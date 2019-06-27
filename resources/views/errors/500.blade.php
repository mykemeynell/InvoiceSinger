@extends('errors::illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('image')
    <div style="background-image: url('{{ asset('images/decoration/bg/500-error.jpg') }}');background-position:center;background-size:cover;width:100%;height:100%;"></div>
@endsection
