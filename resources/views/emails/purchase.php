<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Gfood order confirmation</h1>
<p>Hi <?= customer()->firstname . ' ' . customer()->surname ?>,</p>
<p>Your order with order no #<?= $data['order_id'] ?> has been recieved. Below are the contents of the order you requested</p>
<p><?= customer()->email; ?></p>
<table class="table">
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($data['product'] as $item) : ?>
    <tr>
      <th scope="row"><?= $item['name']; ?></th>
      <td><?= $item['quantity']; ?></td>
      <td><?= $item['unit_price']; ?></td>
      <td><?= $item['total']; ?></td>
    </tr>
      <?php endforeach; ?>
      <h4>Total : <?= $data['total']; ?></h4>
      <h4>Delivery fee : <?= $data['delivery_fee']; ?></h4>
      <h4>Grand Total : <?= $data['grand_total']; ?></h4>
  </tbody>
</table>

</body>
</html>
