<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="welcome-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="orders.php">
</head>
<body>
    <div id="mysidenav" class="sidenav">
        <div class="hat"><img src="image/hat.svg" style="width: 95px;height: 105px;"></div>
        <div class="eatit"><img src="image/Eatit.svg" style="width: 130px;height: 50px;"></div>
        <a href="welcome.php" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="#" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Customers</a>
        <a href="#" class="icon-a"><i class="fa fa-user-circle icons"></i>&nbsp;&nbsp;Accounts</a>
        <a href="categories.php" class="icon-a"><i class="fa fa-th-large icons"></i>&nbsp;&nbsp;Categories</a>
        <a href="products.php" class="icon-a"><i class="fa fa-list-alt icons"></i>&nbsp;&nbsp;Products</a>
        <a href="orders.php" class="icon-a"><i class="fa fa-shopping-bag icons"></i>&nbsp;&nbsp;Orders</a>
        <a href="#" class="icon-a"><i class="fa fa-credit-card icons"></i>&nbsp;&nbsp;Payment</a>
        <a href="#" class="icon-a"><i class="fa fa-cog icons"></i>&nbsp;&nbsp;Settings</a>
    </div>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size: 30px;cursor: pointer;color: white;" class="nav">&#9776;Dashboard</span>
                <span style="font-size: 30px;cursor: pointer;color: white;" class="nav2">&#9776;Dashboard</span>
            </div>
            <div class="col-div-6">
                <a href="#" class="accounts"><i class="fa fa-user-circle icons"></i>&nbsp;&nbsp;Accounts</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>Customers</p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box3">
                <a href="categories.php">
            <div class="box">
                <p>Categories</p>
                <i class="fa fa-th-large box-icon"></i>
            </div>
            </a>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box4">
                <a href="products.php">
            <div class="box">
                <p>Products</p>
                <i class="fa fa-list-alt box-icon"></i>
            </div>
            </a>
            </div>
        </div>
        <div class="col-div-3">
              <div class="box2">
                <a href="orders.php">
                <div class="box">
                <p>Orders</p>
                <i class="fa fa-table box-icon"></i>
                </div>
                </a>
                </div>
        </div>
        <div class="clearfix"></div>
        <div class="box1">
            <p>Total sale</p>
            <button class="btn">View all</button>
        </div>
    </div>
</body>
</html>
