<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirect to merchant </title>
</head>
<body>
<form action="{{$callbackUrl}}" id="callbackUrl">
    <input type="hidden" name="transactionKey" value="{{$transactonKey}}">
    <input type="hidden" name="amount" value="{{$amount}}">
    <input type="hidden" name="resNumber" value="{{$resNumber}}">
    <input type="hidden" name="status" value="{{$status}}">
</form>
</body>
</html>