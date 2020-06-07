<?php
require('includes/config.php');
$totalq="SELECT user,book,rating from orders GROUP by user";
  $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
  $t=$totalres->num_rows;
   $data_book=array();
  while($t)
  {
   $data=mysqli_fetch_assoc($totalres);
    $name=$data['user'];
    $final=array();
         $totalq="SELECT book,rating from orders where user='$name'";
         $u=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
         $ut=$u->num_rows;
                  while($ut)
                  {
                    $data1=$u->fetch_assoc();
                     $temp=array($data1['book']=>$data1['rating']);
                     $final=array_merge($temp,$final);
                  $ut--;
                  }
   //print_r( $final);
   $data_temp=array($name=>$final);
  // print_r( $data_temp);
   $data_book=array_merge($data_temp,$data_book);
   $t--;
  }
  
 // print_r($data_book);

?>