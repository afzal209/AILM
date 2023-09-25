<?php 



if(isset($_SESSION['user'])!=null){
 
  if (!isset($_SESSION['page_load_time'])) {
    $_SESSION['page_load_time'] = time(); // Store the current timestamp
}
  include_once('connection.php');
  include_once('function.php');
  $user_id = $_SESSION['user']['id'];
  
  // $check = add_daily_earning($con,$user_id);
  // echo $check;
  // exit;
  // add_daily_earning($con,$user_id);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>InterBank | <?php 
  if(isset($header_name))
  {echo $header_name;} 
  else{ echo 'add header';} 
  
  ?>
  </title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
    </style>
  <?php include('css.php'); ?>
  
</head>
<body class="<?php if (isset($body_class)) {echo $body_class;} else{ echo 'Add body class';}  ?>">
<div class="<?php if (isset($main_div)) {echo $main_div;} else{ echo 'Add main div class';} ?>"> 