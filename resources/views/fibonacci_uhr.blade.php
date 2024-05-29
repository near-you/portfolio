<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci Uhr</title>
    <style>
        .square {
            display: inline-block;
            margin: 2px;
        }
    </style>
</head>
<body>
<h1>Aktuelle Zeit: {{ $time['hours'] }}:{{ str_pad($time['minutes'], 2, '0', STR_PAD_LEFT) }}</h1>
<div style="display: flex; flex-wrap: wrap; width: 200px;">
    @foreach ([1, 1, 2, 3, 5] as $square)
        <div class="square" style="width: {{ $square * 20 }}px; height: {{ $square * 20 }}px; background-color: {{ $representation[$square] }};"></div>
    @endforeach
</div>
</body>
</html>