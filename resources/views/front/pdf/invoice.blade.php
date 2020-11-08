
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Suprme Sifu Invoice Mail</title>
    
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
        height: 140px;
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
            <tr class="top" style="background:#000;">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <div class="top-logo-cover">
                                    <img src="http://supreme.rsrenjith.com/front/assets/images/logo/logo_footer.png" style="width:60%; max-width:180px; margin-top: 55px;">
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="top-address-cover">  
                                    <div class="top-address-head">ADDRESS</div>
                                    <div class="top-address-body">
                                        26-G, Jalan Tiara 2D, 
                                        Bandar Baru Klang, 41150
                                        Klang, Selangor, Malaysia.
                                    </div>
                                    <div class="address-ul-cover">
                                        <span>Phone : </span> +60 11-1070 3163 <br>
                                        <span>Email : </span> support@supremesifu.com <br>
                                        <span>Web : </span> www.supremesifu.com
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="invoice-details">
                <td colspan="4">
                    <div class="invoice-details-cover">
                        <div class="invoice-id">INVOICE : {{$order->order_number}}</div>
                        <div class="invoice-date">Invoice Date - {{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
                    </div>
                </td>
            </tr>
            <tr class="address_section">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <div class="address-sec-cover">
                                    <div class="address-sec-title">BILLING ADDRESS</div>
                                    <div class="address-sec-body">
                                        <div class="address-sec-name">{{$order->billingAddress->first_name}} {{$order->billingAddress->last_name}}</div>
                                        <div class="address-sec-content">{{$order->billingAddress->address}}, {{$order->billingAddress->city}}, {{$order->billingAddress->postcode}} {{$order->billingAddress->zone->name}}, {{$order->billingAddress->country->name}}</div>
                                        <div class="address-ul-cover">
                                            <span>Phone : </span>{{$order->billingAddress->phoneCode->value}} {{$order->billingAddress->phone}}<br>
                                            <span>Email : </span>{{$order->billingAddress->email}}<br>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="address-sec-cover2">
                                    <div class="address-sec-title">SHIPPING ADDRESS</div>
                                    <div class="address-sec-body">
                                        <div class="address-sec-name">{{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}}</div>
                                        <div class="address-sec-content">{{$order->shippingAddress->address}}, {{$order->shippingAddress->city}}, {{$order->shippingAddress->postcode}} {{$order->shippingAddress->zone->name}}, {{$order->shippingAddress->country->name}}</div>
                                        <div class="address-ul-cover">
                                            <span>Phone : </span>{{$order->shippingAddress->phoneCode->value}} {{$order->shippingAddress->phone}} <br>
                                            <span>Email : </span>{{$order->shippingAddress->email}}<br>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="inv-items-table-cover">
                        <table>
                            <thead>
                                <tr class="invoice-head">
                                    <td><div class="head-item">#</div></td>
                                    <td><div class="head-item">Item</div></td>
                                    <td><div class="head-item">Price</div></td>
                                    <td><div class="head-item">Quantity</div></td>
                                    <td><div class="head-item">Total</div></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($order->items as $item)
                                <tr class="item body-item">
                                    <th scope="row">{{$count}}</th>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{sprintf('%0.2f',$item->price)}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{sprintf('%0.2f',$item->total_price)}}</td>
                                </tr>
                                <?php $count++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td colspan="4">
                    <div class="inv-total-cover">
                        <table cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td><div class="total-title">Sub Total ({{$order->item_count}} Items)</div></td>
                                    <td>-</td>
                                    <td><div class="total-amount">RM {{sprintf('%0.2f',$order->payment->grand_total)}}</div></td>
                                </tr>
                                <tr>
                                    <td><div class="total-title">Tax</div></td>
                                    <td>-</td>
                                    <td><div class="total-amount">RM 0.00</div></td>
                                </tr>
                                <tr>
                                    <td><div class="total-title">Shipping</div></td>
                                    <td>-</td>
                                    <td><div class="total-amount">RM 10.00</div></td>
                                </tr>
                                <tr style="border-top: 1px solid #dedcdc;">
                                    <td><div class="total-title">Grand Total</div></td>
                                    <td>-</td>
                                    <td><div class="total-amount tt-amt">RM {{sprintf('%0.2f',$order->payment->total)}}</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>      
        </table>
    </div>
</body>
</html>