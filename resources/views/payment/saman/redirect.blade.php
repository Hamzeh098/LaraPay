<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<body>
<form action="https://sep.shaparak.ir/Payment.aspx" id="samanForm" method="post">
    <input type="hidden" name="Amount" value="{{ $samanData['amount'] }}">
    <input type="hidden" name="MID" value="{{ $samanData['merchant'] }}">
    <input type="hidden" name="ResNum" value="{{ $samanData['res_num'] }}">
    <input type="hidden" name="RedirectURL" value="{{ $samanData['callback'] }}">
</form>
<script>
    document.getElementById('samanForm').submit();
</script>
</body>
</html>