<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supreme Sifu Confirm Order</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        /* text-align: right; */
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .top-address-head{
        color: #c1903e;
        font-size: 14px;
        margin-bottom: 7px;
        font-weight: 700;
    }

    .top-address-cover{
        text-align: left;
        color: #fff;
        font-size: 13px;
        max-width: 210px;
        float: right;
        min-height: 140px;
    }

    .top-address-body{
        line-height: 17px;
    }

    .invoice-details-cover{
        padding: 15px 0px 15px 0px;
    }

    .invoice-id{
        font-weight: 700;
    }

    .invoice-date{
        font-size: 13px;
    }
    
    .address-sec-title{
        color: #c1903e;
        font-size: 14px;
        margin-bottom: 7px;
        font-weight: 700;
    }

    .address-sec-cover{
        max-width: 250px;
    }

    .address-sec-body{
        font-size: 13px;
        line-height: 20px;
        margin-bottom: 25px;    
    }

    .address-sec-cover2{
        max-width: 250px;
        float: right;
        text-align: left;
    }

    .address-ul-cover{
        margin-top: 15px;
        line-height: 18px;
    }

    .address-ul-cover span{
        font-weight: 700;
    }
    
    .top-logo-cover{
        height: 100px;
        text-align: center;
        background: #000;
    }

    .invoice-head{
        background: #000;
        color: #fff;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 1px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .head-item{
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .body-item{
        font-size: 14px;
    }

    .inv-items-table-cover table tr.item td {
        border-bottom: 1px solid #eee;
        padding-left: 10px;
    }

    .address-sec-name{
        font-weight: 700;
    }

    .inv-total-cover{
        font-size: 14px;
        /* line-height: 14px; */
        margin-top: 30px;
    }

    .inv-total-cover table tr{
        border-bottom: 1px #efefef;
    }

    .total-title{
        font-weight: 600;
    }

    .total-amount{
        letter-spacing: 1px;
    }

    .tt-amt{
        font-size: 15px;
        font-weight: bold;
    }

    .inv-total-cover{
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .total-title{
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .mail-heading{
        font-size: 20px;
        font-weight: 700;
        text-align: center;
        padding: 0px 0px 25px 0px;
        color: #000;
        letter-spacing: 1px;
    }

    .mail-bd-content{
        letter-spacing: 1px;
    }

    .mail-bd-name{
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .mail-bd-footer{
        padding: 40px 0px;
        text-align: center;
    }

    .mail-bd-footer a{
        color: #fff;
        background: #c1903e;
        padding: 15px 40px;
        text-decoration: none;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 800;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .total-title{
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top" >
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <div class="top-logo-cover">
                                    <img src="http://supreme.rsrenjith.com/front/assets/images/logo/logo_footer.png" style="width:60%; max-width:180px; margin-top: 20px;">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="invoice-details">
                <td colspan="4">
                    <div class="invoice-details-cover">
                        <div class="mail-heading">Yay, your order is confirmed.</div>
                        <div class="mail-body">
                            <div class="mail-bd-name">Hi {{$order->billingAddress->first_name}} {{$order->billingAddress->last_name}} ,</div>
                            <div class="mail-bd-content">
                                <p>Thank you for shopping on <strong>Supreme Sifu.</strong></p>
                                {{-- <p>We have received your Order <strong>{{$order->order_number}}</strong> on Saturday, 29 August, 2020 at 18:13:14. We're excited for you to receive your order and will notify you once it is on its way!</p> --}}
                                <p>We have received your Order <strong>{{$order->order_number}}</strong> on {{ Carbon\Carbon::parse($order->created_at)->format('l jS \\of F Y h:i:s A') }}. We're excited for you to receive your order and will notify you once it is on its way!</p>
                                <p>By the way, you may manage your order by clicking the 'Manage My Order' button below.</p>
                            </div>
                            <div class="mail-bd-footer">
                                <a class=mgod-button" href="#">Manage Order</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>     
        </table>
    </div>
</body>
</html>