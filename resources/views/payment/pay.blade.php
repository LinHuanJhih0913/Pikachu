<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=d evice-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/payment" method="post">
    @csrf
    <input type="hidden" name="tradeNo" value="{{ "Test" . time() }}">
    <input type="hidden" name="tradeDate" value="{{ date('Y/m/d H:i:s') }}">
    要donate多少錢：<input type="number" name="price">
    <input type="submit" value="送出">
</form>
</body>
</html>