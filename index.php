<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My market</title>
    <link rel="stylesheet" href="./css/bootstrap.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="./css/style.css" media="screen" title="no title" charset="utf-8">
    <script src="./js/jquery.js" charset="utf-8"></script>
    <script src="./js/custom.js" charset="utf-8"></script>
  </head>
  <body>
    <nav>
      <div class="container">
        <ul class="navbar-left">
          <li><a href="#">My Market</a></li>
        </ul> <!--end navbar-left -->

        <ul class="navbar-right">
          <li><a href="#" id="cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">3</span></a></li>
        </ul> <!--end navbar-right -->
      </div> <!--end container -->
    </nav>


    <div class="container">
      <div class="shopping-cart">
        <div class="shopping-cart-header">
          <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>
          <div class="shopping-cart-total">
            <span class="lighter-text">Total:</span>
            <span class="main-color-text">$2,229.97</span>
          </div>
        </div> <!--end shopping-cart-header -->

        <ul class="shopping-cart-items">
          <form method="post" action="invoice.php" />
          <li class="clearfix">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
            <span class="item-name">Sony DSC-RX100M III</span>
            <span class="item-price">$849.99</span>
            <span class="item-quantity">Quantity: 01</span>
            <input type="hidden" name="items[0]['name']" value="Sony DSC-RX100M III" />
            <input type="hidden" name="items[0]['quantity']" value="1" />
          </li>

          <li class="clearfix">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item2.jpg" alt="item1" />
            <span class="item-name">KS Automatic Mechanic...</span>
            <span class="item-price">$1,249.99</span>
            <span class="item-quantity">Quantity: 01</span>
            <input type="hidden" name="items[1]['name']" value="KS Automatic Mechanic" />
            <input type="hidden" name="items[1]['quantity']" value="1" />
          </li>

          <li class="clearfix">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item3.jpg" alt="item1" />
            <span class="item-name">Kindle, 6" Glare-Free To...</span>
            <span class="item-price">$129.99</span>
            <span class="item-quantity">Quantity: 01</span>
            <input type="hidden" name="items[2]['name']" value="Kindle, 6" />
            <input type="hidden" name="items[2]['quantity']" value="1" />
          </li>
        </ul>

        <input type="submit" class="button" value="Checkout" style="border:none;width:100%;">
      </div> <!--end shopping-cart -->
    </div> <!--end container -->
  </body>
</html>
