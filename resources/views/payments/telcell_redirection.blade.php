@extends('payments.layouts.payments')
@section('title', 'Telcell')
@section('description', 'Telcell Payment')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="anim-reload">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="form-container-wrapper">
        <div class="container">
            <div class="row no-gutters">
                <form action="{{$data_telcell['url']}}" method="POST" id="telcell_form">
                    <input type="hidden" name="issuer" value="{{$data_telcell['issuer']}}">
                    <input type="hidden" name="action" value="{{$data_telcell['action']}}">
                    <input type="hidden" name="currency" value="{{$data_telcell['currency']}}">
                    <input type="hidden" name="price" value="{{$data_telcell['price']}}">
                    <input type="hidden" name="product" value="{{$data_telcell['product']}}">
                    <input type="hidden" name="issuer_id" value="{{$data_telcell['issuer_id']}}">
                    <input type="hidden" name="valid_days" value="{{$data_telcell['valid_days']}}">
                    <input type="hidden" name="lang" value="{{$data_telcell['lang']}}">
                    <input type="hidden" name="security_code" value="{{$data_telcell['security_code']}}">
                    <input type="submit" value="submit" style="display: none;">
                </form>
            </div>
        </div>
    </div>
    <style>
        body {
            background: #F16D30FF;
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
    <script>
        jQuery(document).ready(function () {
            jQuery('#telcell_form').submit();
        });
    </script>
@endsection


