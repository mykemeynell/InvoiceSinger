@extends('errors::illustrated-layout')

@section('title', __('Not found'))
@section('code', '404')
@section('message', 'That page doesn\'t exist or has been moved')

@section('image')
    <div style="width:100%;height:100%;position:relative;">
        <div style="width:60%;position:absolute;top:50%;left:50%;transform:translateY(-50%) translateX(-50%);">
            <div style="margin:0 auto;">
                <div style="width:100%;border-bottom:1px solid #d6d6d6;text-align: center;">
                    <img src="{{ asset('images/decoration/bg/404-terminal.svg') }}" alt="Error 500 terminal" style="width:80%;display:block;margin-left:auto;margin-right:auto;">
                </div>
                <img src="{{ asset('images/decoration/bg/terminal-shadow.svg') }}" alt="Shadow">
            </div>
        </div>

    </div>
@endsection
