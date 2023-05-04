<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  
    <title>Item Cost Calculator</title>
</head>
<body>

<!-- Style sheet -->
<style> <?php include 'style.css'; ?> </style>

<div class="nav">
  <h1>Item Cost Calculator</h1>
</div>

<div class='main'>
<hr>
<form method="POST" action="site.php" class="form">
  <label for="item">Select an item:</label>
  <select name="item" id="item">
    <option value="1">Item 1</option>
    <option value="2">Item 2</option>
    <option value="3">Item 3</option>
    <option value="4">Item 4</option>
    <option value="5">Item 5</option>
  </select>
  <br>
  <label for="quantity">Enter quantity:</label>
  <input type="number" name="quantity" id="quantity" min="1" max="100" required>
  <br>
  <input type="submit" value="Calculate Cost">
</form>


<?php 
// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "7696157100Ii", "project");

// Retrieve the selected item and quantity from the request
$item = $_POST['item'] ?? NULL;
$quantity = $_POST['quantity'] ?? NULL;

// Retrieve the item's price and quantity from the database
$result = $mysqli->query("SELECT price,quantity FROM items WHERE id='$item'");
$row = $result->fetch_assoc();
$price = $row['price'] ?? NULL;
$available_quantity = $row['quantity'] ?? NULL;

$total_cost = $price * $quantity;


  if ($quantity > 25) {
    $total_cost *= 0.9; // Apply 10% discount
  }
  
  if ($quantity < 5) {
    echo "<hr>";
    echo "<p>Delivery Cost for Items Less than 5:  </p>";
    $total_cost += 50; // Add delivery charges
  }

  echo "<p class='cost'>&nbsp ₹$total_cost</p>";


  
$new_quantity = $available_quantity - $quantity;

$mysqli->query("UPDATE items SET quantity=$new_quantity WHERE name='$item'");

 
  ?>


</div>


</body>
</html>