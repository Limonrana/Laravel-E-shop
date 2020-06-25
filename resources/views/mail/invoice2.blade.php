<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<ul>
    <li>Order id = {{ $data['order']['method_order_id'] }}</li>
    <li>Total {{ $data['order']['order_amount'] }}</li>
    <li>Tarcking code {{ $data['order']['tracking_number'] }}</li>
</ul>
</body>
</html>
