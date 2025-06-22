<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign up for Crypto Newsletter</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Sign up for Crypto Newsletter</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <p>Newsletter frequency:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="frequency" id="minute" value="minute" {{ old('frequency') == 'minute' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="minute">Every minute</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="frequency" id="hour" value="hour" {{ old('frequency') == 'hour' ? 'checked' : '' }}>
                    <label class="form-check-label" for="hour">Every hour</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="frequency" id="midnight" value="midnight" {{ old('frequency') == 'midnight' ? 'checked' : '' }}>
                    <label class="form-check-label" for="midnight">Daily at midnight</label>
                </div>
            </div>
            <div class="mb-3">
                <p>Cryptocurrency tickers:</p>
                @foreach (['BTC', 'ETH', 'DOGE', 'XRP', 'LTC', 'ADA', 'DOT', 'LINK', 'BCH', 'BNB'] as $ticker)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cryptocurrency_tickers[]" id="{{ $ticker }}" value="{{ $ticker }}" {{ in_array($ticker, old('cryptocurrency_tickers', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $ticker }}">{{ $ticker }}</label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="percentage_change_alert" class="form-label">Percentage Change Alert:</label>
                <input type="text" name="percentage_change_alert" id="percentage_change_alert" class="form-control" value="{{ old('percentage_change_alert') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
