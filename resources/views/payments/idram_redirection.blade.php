@extends('payments.layouts.payments')
@section('title', 'Idram')
@section('description', 'Idram Payment')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="anim-reload"><div></div><div></div><div></div></div>
    <div class="form-container-wrapper">
        <div class="container">
            <div class="row no-gutters">
                <form action="{{ $data_idram['url'] }}" method="POST" id="idram_form">
                    <input type="hidden" name="EDP_LANGUAGE" value="{{ $data_idram['EDP_LANGUAGE'] }}">
                    <input type="hidden" name="EDP_REC_ACCOUNT" value="{{$data_idram['EDP_REC_ACCOUNT']}}">
                    <input type="hidden" name="EDP_DESCRIPTION" value="{{ $data_idram['EDP_DESCRIPTION'] }}">
                    <input type="hidden" name="EDP_AMOUNT" value="{{ $data_idram['EDP_AMOUNT'] }}">
                    <input type="hidden" name="EDP_BILL_NO" value="{{ $data_idram['EDP_BILL_NO'] }}">
                    <input type="submit" value="submit" style="display: none;">
                </form>
            </div>
        </div>
    </div>
    <style>
        body{
            background: #f3811e;

        }
    .anim-reload {
        display: inline-block;
        width: 80px;
        height: 80px;
        position: fixed;
        right: 0;
        left: 0;
        bottom: 0;
        top: 0;
        margin: auto;
    }
    .anim-reload div {
        display: inline-block;
        position: absolute;
        left: 8px;
        width: 16px;
        background: #fff;
        animation: anim-reload 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }
    .anim-reload div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }
    .anim-reload div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }
    .anim-reload div:nth-child(3) {
        left: 56px;
        animation-delay: 0;
    }
    @keyframes anim-reload {
        0% {
            top: 8px;
            height: 64px;
        }
        50%, 100% {
            top: 24px;
            height: 32px;
        }
    }

</style>
{{--TODO: uncomment--}}
    <script>
        jQuery(document).ready(function () {
            jQuery('#idram_form').submit();
        });
    </script>
@endsection


