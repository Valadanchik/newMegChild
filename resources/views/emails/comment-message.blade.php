<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        .checkButtonStyle {
            padding: 10px 15px;
            background: green;
            border: none;
            border-radius: 3px;
            color: white;
            font-family: system-ui;
            text-decoration: none;
        }
        .activeButtonStyle {
            padding: 10px 15px;
            background: #008bc3;
            border: none;
            border-radius: 3px;
            color: white;
            font-family: system-ui;
            text-decoration: none;
        }

    </style>
</head>
<body style="margin:0;padding:0;">
<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <table role="presentation"
           style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
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
                                    <h3 style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;" align="center"><strong>Մեկնաբանության տեղեկություն</strong></h3>
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;" align="center"><strong>Մեկնաբանությունը ավելացրել է՝</strong>  {{ $comment->full_name }}</p>
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;" align="center"><strong>Էլեկտրոնային հասցե` </strong> {{ $comment->email }}</p>
                                    <p style="mso-line-height-rule: exactly; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Arial,'Karla'; font-size: 16px; line-height: 26px; font-weight: 400; color: #666363; margin: 13px 0;" align="center"><strong>Մեկնաբանություն` </strong> {{ $comment->comment }}</p>
                                    <br>
                                    <br>
                                    <div>
                                        <a href="{{ url('http://newmag.test/fs-admin/comment/view/' . $comment['id'] ) }}" class="checkButtonStyle" >Տեսնել Կայքում</a>
                                        <a href="{{ url('http://newmag.test/fs-admin/comment/view/' . $comment['id'] ) .'?immediately_activate=1' }} " class="activeButtonStyle">Անհապաղ ակտիվացնել</a>
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </table>
</table>
</body>
</html>
