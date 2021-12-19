
<!DOCTYPE html>
<html>
<head>
  <title>khaled Kars </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="icon" href="https://khaled-cars.magdsoft.com/assets/img/brand/favicon.png" type="image/x-icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-top: 15px ">
        <div class="pull-left">
          <h2>khaled Kars Application - Your Order</h2>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="#" onclick="window.print()">Download PDF</a>
        </div>
      </div>
    </div><br>

    <table class="table table-bordered">
      <tr>
        <td>الاسم</td>
        <td>{{ $order->bidder->user->name }}</td>
      </tr>
      <tr>
        <td>رقم التليفون</td>
        <td>{{ $order->bidder->user->phone }}</td>
      </tr>
      <tr>
        <td>السيارة</td>
        <td>{{ $order->bidder->bidding->product->brand->name_ar }}</td>
      </tr>
      <tr>
        <td>موديل</td>
        <td>{{ $order->bidder->bidding->product->model->model }}</td>
      </tr>
      <tr>
        <td>سنة</td>
        <td>{{ $order->bidder->bidding->product->model_year->model_year }}</td>
      </tr>
      <tr>
        <td>السعر</td>
        <td>{{ $order->bidder->price }}</td>
      </tr>
      <tr>
        <td>تاريخ انتهاء المزاد</td>
        <td>{{ $order->bidder->bidding->end_at }}</td>
      </tr>
      <tr>
        <td>كود المزاد</td>
        <td>{{ $order->bidder->bidding->product->id * 97 }}</td>
      </tr>
    </table>
  </div>
</body>
</html>