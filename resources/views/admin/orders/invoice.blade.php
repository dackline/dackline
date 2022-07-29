<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dackline - {{ $type == 'order' ? 'Order' : 'Quotation' }} - {{ $item->id }}</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
            table-layout: fixed;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 25px 25px 50px 25px;
        }
        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            color: #676767;
            text-align: center;
            line-height: 35px;
            font-size: x-small;
        }
    </style>
</head>
<body>
    <footer>
        Dackline.se - Mörsaregatan 8 - 254 66 Helsingborg - +46 42 24 21 66
    </footer>
    <table width="100%">
        <tr>
            <td>
                <img src="{{ public_path('images/dackimage/dackline.png') }}" style="width: 300px; margin-top: 5px;"/>
            </td>
            <td align="right">
                <h1>{{ $type == 'order' ? 'Order' : 'Quotation' }}</h1>
                <ul style="list-style: none; padding: 0; margin: 0">
                    <li>
                        <strong>{{ $type == 'order' ? 'Order' : 'Quotation' }} Nr.:</strong> {{ $item->id }}
                    </li>
                    <li>
                        <strong>Date Created:</strong> {{ $item->created_at->format('Y-m-d') }}
                    </li>
                    @if($data->assignee)
                    <li>
                        <strong>Assignee:</strong> {{ $data->assignee->name }}
                    </li>
                    @endif
                </ul>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin: 15px 0">
        <tr>
            <td align="left">
                <div style="background-color: red; display: inline-block; width: 50px; height: 50px; text-align: center; vertical-align: top">
                    <img src="{{ public_path('images/dackimage/truck.png') }}" style="width: 40px; height: 40px;margin-top: 5px;"/>
                </div>
                <div style="margin-left: 5px; display: inline-block; vertical-align: top">
                    <h3 style="margin: 0 0 5px 0">Shipping</h3>
                    <div>
                        {{ $data->shipping_firstname }} {{ $data->shipping_lastname }}
                        @if($data->shipping_company)
                        ({{ $data->shipping_company }})
                        @endif
                        <br/>
                        {{ $data->shipping_address_1 }}<br/>
                        @if($data->shipping_address_2)
                            {{ $data->shipping_address_2 }}<br/>
                        @endif
                        {{ $data->shipping_zipcode }} - {{ $data->shipping_city }}<br />
                        @if($data->shipping_phone)
                            {{ $data->shipping_phone }}<br/>
                        @endif
                    </div>
                </div>
            </td>
            <td align="left">
                <div style="background-color: red; display: inline-block; width: 50px; height: 50px; text-align: center; vertical-align: top">
                    <img src="{{ public_path('images/dackimage/credit-card.png') }}" style="width: 40px; height: 40px;margin-top: 5px;"/>
                </div>
                <div style="margin-left: 5px; display: inline-block; vertical-align: top">
                    <h3 style="margin: 0 0 5px 0">Payment</h3>
                    <div>
                        {{ $data->payment_firstname }} {{ $data->payment_lastname }}
                        @if($data->payment_company)
                        ({{ $data->payment_company }})
                        @endif
                        <br/>
                        {{ $data->payment_address_1 }}<br/>
                        @if($data->payment_address_2)
                            {{ $data->payment_address_2 }}<br/>
                        @endif
                        {{ $data->payment_zipcode }} - {{ $data->payment_city }}<br />
                        @if($data->payment_phone)
                            {{ $data->payment_phone }}<br/>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>
                <strong>Customer ID:</strong> {{ $data->customer_id }} <br/>
                <strong>Contact:</strong> {{ $data->full_name_with_company }} <br/>
                <strong>Shipping Method:</strong> {{ $data->shipping_method }} <br/>
                <strong>Payment Method:</strong> {{ $data->payment_method }}
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin: 15px 0 5px 0">
        <tr>
            <td style="vertical-align: middle">
                <div style="background-color: red; display: inline-block; width: 50px; height: 50px; text-align: center; vertical-align: middle">
                    <img src="{{ public_path('images/dackimage/cart.png') }}" style="width: 40px; height: 40px;margin-top: 5px;"/>
                </div>
                <h3 style="display: inline-block; margin: 0 0 0 5px; vertical-align: middle">Articles</h3>
            </td>
        </tr>
    </table>
    <table width="100%" style="border-top: 3px solid #EA001E">
        <thead style="background-color: lightgray;">
            <tr>
                <th align="left">Article Name</th>
                <th align="left">Options</th>
                <th align="left">ART. NR</th>
                <th align="right">Qty.</th>
                <th align="right">Price</th>
                <th align="right">%</th>
                <th align="right">Price</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->products as $product)
            <tr>
                <td><strong>{{ $product->pivot->name }}</strong></td>
                <td>options</td>
                <td>{{ $product->pivot->article_nr }}</td>
                <td align="right"><strong>{{ $product->pivot->quantity }}</strong></td>
                <td align="right">{{ $product->pivot->price }}</td>
                <td align="right">{{ $product->pivot->discount_percent }}%</td>
                <td align="right">{{ $product->pivot->discount }}</td>
                <td align="right"><strong>{{ $product->pivot->total }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table width="100%" style="margin-top: 25px;">
        <tr>
            <td style="background-color: #E6E7E9; vertical-align: top; padding: 10px;">
                Description
            </td>
            <td style="background-color: #E6E7E9; border-top: 3px solid #EA001E">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <table style="margin-bottom: 20px;width: 100%;">
                                <tr>
                                    <td>Articles</td>
                                    <td align="right"><strong>{{ $data->products->count() }}</strong></td>
                                </tr>
                                @foreach ($totals as $total)
                                    <tr>
                                        <td>{{ $total['title'] }}</td>
                                        <td align="right"><strong>{{ number_format($total['value'], 2) }}kr</strong></td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td align="center">
                            <div><strong>To Pay: </strong></div>
                            <h1>{{  number_format($data->getTotal(), 2) }}kr</h1>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>
