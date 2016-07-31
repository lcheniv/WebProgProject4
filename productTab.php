
<?php 

  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once 'dbConnect.php';

?>

<?php 
  // Run a select query to get my letest 6 items
  // Connect to the MySQL database  

  $dynamicList = "";
  $sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
  $productCount = mysql_num_rows($sql); // count the output amount

  if ($productCount > 0) {
    while($row = mysql_fetch_array($sql)){ 

        $id = $row["id"];
        $product_name = $row["product_name"];
        $price = $row["price"];
        $date_added = date_default_timezone_set('America/New_York');
        $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
          <tr>
            <td width="17%" valign="top"><a href="products.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
            <td width="83%" valign="top">' . $product_name . '<br />
              $' . $price . '<br />
              <a href="products.php?id=' . $id . '">View Product Details</a></td>
          </tr>
        </table>';
      }
    } else {
      $dynamicList = "We have no products listed in our store yet";
    }

  mysql_close();

?>

<!DOCTYPE>
<html>

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <title>Products | ORCA BOX</title>
      <p><?php echo $dynamicList; ?><br/>
        </p>
      <p><br/>
      </p>
      
      <link rel="stylesheet" href="products_style.css" type="text/css" />
      <script src="assets/jquery-1.11.3-jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
  </head>
  
  <body>

    <ul class="nav navbar-nav navbar-right">
              
        <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span>&nbsp;Your Account<?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>

                <ul class="dropdown-menu">
                    <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                </ul>

        </li>

      </ul>
  </body>
</html>