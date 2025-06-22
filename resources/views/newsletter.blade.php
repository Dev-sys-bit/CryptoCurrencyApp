<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <style>
        .green {
            background-color: green;
        }
        .red {
            background-color: red;
        }
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;

        }
    </style>
</head>
<body>
    <h1>Cryptocurrency Newsletter</h1>
    <table >
        <thead>
            <tr>
                <th>Ticker</th>
                <th>Price (USD)</th>
                <th>1-hour Change (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cryptocurrencyData as $data)
                @if (in_array($data['symbol'], $tickers))
                    @php
                        $change = $data['percent_change_1h'];
                        $row_class = '';
                        if ($change >= $subscription->percentage_change_alert) {
                            $row_class = 'green';
                        } elseif ($change <= -$subscription->percentage_change_alert) {
                            $row_class = 'red';
                        }
                    @endphp
                    <tr class="{{ $row_class }}">
                        <td>{{ $data['symbol'] }}</td>
                        <td>{{ $data['price_usd'] }}</td>
                        <td>{{ $change }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <p>
        <a href="{{ url(route('unsubscribe', ['email' => $subscription->email])) }}">Unsubscribe</a>
    </p>
</body>
</html>
