<?php session_start();
require('includes/config.php');
	if(isset($_GET['nm']) and isset($_GET['cat']) and isset($_GET['rate']))
	{
		//add item
		$_SESSION['cart'][] = array("nm"=>$_GET['nm'],"cat"=>$_GET['cat'],"rate"=>$_GET['rate'],"qty"=>"1");
		$name=$_SESSION['unm'];
		$book=$_GET['nm'];

		$query="select b_rating from book where b_nm = '$book'";
		$res=mysqli_query($conn,$query) or die("Can't Execute Query...");
        $data=$res->fetch_assoc();
        $rating=$data['b_rating'];

        $query="select * from orders where user = '$name' AND book = '$book' AND rating = '$rating'";
		$res=mysqli_query($conn,$query) or die("Can't Execute Query book select");
        if($res->num_rows==0)
        {
        $query="insert into orders (user,book,rating) values('$name','$book','$rating')";
		$res=mysqli_query($conn,$query) or die("Can't Execute Query...");
     	}

		header("location: viewcart.php");
	}
	else if(isset($_GET['id']))
	{
		//del a item
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);
		header("location: viewcart.php");
	}
	else if(!empty($_POST))
	{
		//update qty
		foreach($_POST as $id=>$val)
		{
			$_SESSION['cart'][$id]['qty']=$val;
			header("location: viewcart.php");
		}
	}


?>