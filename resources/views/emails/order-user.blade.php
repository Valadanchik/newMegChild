<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>

    <![endif]-->
    <style>
        table, td, div, h1, p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
        <td align="center" style="padding:0;">
            <table role="presentation"
                   style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                <tr>
                    <td align="center" style="padding:40px 0 30px 0;background:#70bbd9;">
                        <a href="{{ LaravelLocalization::localizeUrl('/') }}">
                            <img width="300px" src="{{ URL::to('/images/logo.png') }}" alt="logo images">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:36px 30px 42px 30px;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <!-- BEGIN SECTION: Introduction -->
                            <tr id="section-1468267" class="section introduction">
                                <th style="mso-line-height-rule: exactly; padding: 13px 52px;" bgcolor="#ffffff">
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 0 0 13px;" align="center">
                                        <span data-key="1468267_greeting_text"
                                              style="text-align: center; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363;">
                                          Hey
                                        </span>
                                        {{ $order->name . ' ' . $order->lastname }},
                                    </p>

                                    <p data-key="1468267_introduction_text" class="text"
                                       style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;"
                                       align="center">
                                    </p>
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;"
                                       align="center">We've got your order!</p>
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;"
                                       align="center">We'll ship it out to you as soon as possible.</p>
                                </th>
                            </tr>
                            <!-- END SECTION: Introduction -->

                            <!-- BEGIN SECTION: Order Number And Date -->
                            <tr id="section-1468270" class="section order_number_and_date">
                                <th style="mso-line-height-rule: exactly; padding: 13px 52px;"
                                    bgcolor="#ffffff">
                                    <h2 style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; color: #4b4b4b; font-size: 20px; line-height: 26px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0;"
                                        align="center">
                                                            <span
                                                                data-key="1468270_order_number">Order No.</span> {{$order->id}}
                                    </h2>
                                    <p class="muted"
                                       style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 14px; line-height: 26px; font-weight: normal; color: #bdbdbd; margin: 0;"
                                       align="center">{{$order->created_at->addHours(4)}}</p>
                                </th>
                            </tr>
                            <!-- END SECTION: Order Number And Date -->
                            <tr>
                                <td style="padding:0;">
                                    {{--                                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">--}}
                                    <table cellspacing="0" cellpadding="0" border="0"
                                           width="100%" style="min-width: 100%;"
                                           role="presentation">
                                        <tbody>

                                        <tr>
                                            <th colspan="2" class="product-table-h3-wrapper"
                                                style="mso-line-height-rule: exactly;"
                                                bgcolor="#ffffff" valign="top">
                                                <h3 data-key="1468271_item"
                                                    style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; color: #bdbdbd; font-size: 16px; line-height: 52px; font-weight: 700; text-transform: uppercase; border-bottom-width: 2px; border-bottom-color: #dadada; border-bottom-style: solid; letter-spacing: 1px; margin: 0;"
                                                    align="left">Items ordered</h3>
                                            </th>
                                        </tr>

                                        @foreach($order->books as $book)
                                            <tr class="row-border-bottom">
                                                <th class="table-stack product-image-wrapper stack-column-center"
                                                    width="1"
                                                    style="mso-line-height-rule: exactly; border-bottom-width: 2px; border-bottom-color: #dadada; border-bottom-style: solid; padding: 13px 13px 13px 0;"
                                                    bgcolor="#ffffff" valign="middle">
                                                    <img width="170px"
                                                         src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                                </th>
                                                <th class="product-details-wrapper table-stack stack-column"
                                                    style="mso-line-height-rule: exactly; padding-top: 13px; padding-bottom: 13px; border-bottom-width: 2px; border-bottom-color: #dadada; border-bottom-style: solid;"
                                                    bgcolor="#ffffff" valign="middle">
                                                    <table cellspacing="0" cellpadding="0"
                                                           border="0" width="100%"
                                                           style="min-width: 100%;"
                                                           role="presentation">
                                                        <tbody>
                                                        <tr>

                                                            <th class="line-item-description"
                                                                style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; padding: 13px 6px 13px 0;"
                                                                align="left"
                                                                bgcolor="#ffffff"
                                                                valign="top">
                                                                <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 0;"
                                                                   align="left">
                                                                    {{$book['title_' . app()->getLocale()]}}
                                                                    <br>
                                                                    <span class="muted"
                                                                          style="text-align: center; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 14px; line-height: 26px; font-weight: normal; color: #bdbdbd; word-break: break-all;">

                                                                      </span>
                                                                </p>
                                                            </th>

                                                            <th style="mso-line-height-rule: exactly;"
                                                                bgcolor="#ffffff"
                                                                valign="top"></th>

                                                            <th class="right line-item-qty"
                                                                width="1"
                                                                style="mso-line-height-rule: exactly; white-space: nowrap; padding: 13px 0 13px 13px;"
                                                                align="right"
                                                                bgcolor="#ffffff"
                                                                valign="top">
                                                                <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 0;"
                                                                   align="right">
                                                                    ×&nbsp;{{ $book->pivot->quantity }}
                                                                </p>
                                                            </th>
                                                            <th class="right line-item-line-price"
                                                                width="1"
                                                                style="mso-line-height-rule: exactly; white-space: nowrap; padding: 13px 0 13px 26px;"
                                                                align="right"
                                                                bgcolor="#ffffff"
                                                                valign="top">
                                                                <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 0;"
                                                                   align="right">
                                                                    {{ $book->pivot->price }}
                                                                    &nbsp; AMD
                                                                </p>
                                                            </th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </th>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="pricing-table"
                                                style="mso-line-height-rule: exactly; padding: 13px 0;"
                                                bgcolor="#ffffff" valign="top">
                                                <table cellspacing="0" cellpadding="0" border="0"
                                                       width="100%" style="min-width: 100%;"
                                                       role="presentation">

                                                    <tbody>

                                                    <tr>
                                                        <th class="table-title"
                                                            data-key="1468271_subtotal"
                                                            style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: bold; color: #666363; width: 65%; padding: 6px 0;"
                                                            align="left" bgcolor="#ffffff" valign="top">
                                                            Total Price
                                                        </th>
                                                        <th class="table-text"
                                                            style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; width: 35%; padding: 6px 0;"
                                                            align="right" bgcolor="#ffffff"
                                                            valign="middle">{{$order->total_price}}&nbsp
                                                        <td>AMD</td>
                                            </th>
                                        </tr>

                                        @if($order->total_price_with_discount)
                                            <tr>
                                                <th class="table-title"
                                                    data-key="1468271_subtotal"
                                                    style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: bold; color: #666363; width: 65%; padding: 6px 0;"
                                                    align="left" bgcolor="#ffffff" valign="top">
                                                    Total Price With Discount
                                                </th>
                                                <th class="table-text"
                                                    style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; width: 35%; padding: 6px 0;"
                                                    align="right" bgcolor="#ffffff"
                                                    valign="middle">
                                                    {{$order->total_price_with_discount}}&nbsp
                                                <td>AMD</td>
                                                </th>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th class="table-title"
                                                style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: bold; color: #666363; width: 65%; padding: 6px 0;"
                                                align="left" bgcolor="#ffffff" valign="top">
                                                <table cellspacing="0" cellpadding="0" border="0"
                                                       width="100%"
                                                       style="min-width: 100%; font-weight: bold;"
                                                       role="presentation">
                                                    <tbody>
                                                    <tr style="font-weight: bold;">
                                                        <th width="40"
                                                            style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: bold; color: #666363; padding: 8px 10px 8px 0;"
                                                            align="left" bgcolor="#ffffff"
                                                            valign="middle">
                                                            <img width="40"
                                                                 style="width: 40px; vertical-align: middle; height: auto !important; font-weight: bold;"
                                                                 alt="Mastercard Icon"
                                                                 src="{{asset('images/payment_methods/'.$order->payment_method.'.png')}}">
                                                        </th>
                                                        <th style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: bold; color: #666363; padding: 8px 0;"
                                                            align="left" bgcolor="#ffffff"
                                                            valign="middle">
                                                            @if($order->payment_method === \App\Models\Order::PAYMENT_METHOD_BANK)
                                                                <span>Bank Card</span>
                                                            @elseif($order->payment_method === \App\Models\Order::PAYMENT_METHOD_IDRAM)
                                                                <span>Idram</span>
                                                            @elseif($order->payment_method === \App\Models\Order::PAYMENT_METHOD_TELCELL)
                                                                <span>Telcell</span>
                                                            @endif
                                                        </th>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:30px;background:#ee4c50;">
            <table role="presentation"
                   style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                    <td style="padding:0;width:50%;" align="left">
                        <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                            &reg; Newmag © 2011-2023
                        </p>
                    </td>
                    <td style="padding:0;width:50%;" align="right">
                        <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="padding:0 0 0 10px;width:38px;">
                                    <a href="http://www.twitter.com/" style="color:#ffffff;"><img
                                            src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38"
                                            style="height:auto;display:block;border:0;"/></a>
                                </td>
                                <td style="padding:0 0 0 10px;width:38px;">
                                    <a href="http://www.facebook.com/" style="color:#ffffff;"><img
                                            src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38"
                                            style="height:auto;display:block;border:0;"/></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
