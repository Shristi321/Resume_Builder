<?php


$con = mysqli_connect("localhost","shristic_prism","prism","shristic_ecommerce");

if (mysqli_connect_errno()){
	
	echo "Failed to connect to MYSQL:" . mysqli_connect_error();
	
}

// gettting the users' ip address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
 

//creating the shopping cart

function scart(){
	
	if(isset($_GET['add_scart'])){
		
		global $con;
		
		$ip = getIp();
	
		$pro_id = $_GET['add_scart'];
		
		$check_pro = "select * from scart where ip_addr='$ip' AND pr_id='$pro_id'";
		
		$run_check = mysqli_query($con, $check_pro);
		
			if(mysqli_num_rows($run_check)>0){
				
					echo "";
					
			}
			
			else {	
			
					$insert_pro = "insert into scart (pr_id,ip_addr) values ('$pro_id','$ip')"; 
					
					$run_pro = mysqli_query($con, $insert_pro);
					
					echo "<script>window.open('index.php','_self')</script>";
		
			}
	
	}

}


//getting the total added items

function total_items(){
	
	if (isset($_GET['add_scart'])){
		
		global $con;
		
		$ip = getIp();
		
		$get_items = "select * from scart where ip_addr='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
		
	}	
		
	else{
		
		global $con;
		
		$ip = getIp();
		
		$get_items = "select* from scart where ip_addr='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
	
	}
	
	echo $count_items;
	
}


//getting the total price of the total items in the cart

function total_price(){
	
		$total = 0;
		
		global $con;
		
		$ip = getIp();
		
		$sel_price = "select * from scart where ip_addr='$ip'";
		
		$run_price = mysqli_query($con, $sel_price);
		
			while($p_price=mysqli_fetch_array($run_price)){
				
				$pro_id = $p_price['pr_id'];
				
				$pro_price = "select * from products where product_id='$pro_id'";
				
				$run_pro_price = mysqli_query($con,$pro_price);
				
					while($pp_price = mysqli_fetch_array($run_pro_price)){
						
						$product_price = array($pp_price['product_price']);
						
						$values = array_sum($product_price);
						
						$total += $values;
						
					}
			
			}
	
			echo "$" . $total;
}


//getting the men categories

function getMen(){
	
	global $con;
	
	$get_men = "select * from men";
	
	$run_men = mysqli_query($con, $get_men);
	
		while ($row_men=mysqli_fetch_array($run_men)){
			
			$men_id = $row_men['men_id'];
			$men_title = $row_men['men_title'];
			
		echo "<li><a href='index.php?men=$men_id'>$men_title</a></li>";
			
		}


}

//getting the women categories

function getWomen(){
	
	global $con;
	
	$get_women = "select * from women";
	
	$run_women = mysqli_query($con, $get_women);
	
		while ($row_women=mysqli_fetch_array($run_women)){
			
			$women_id = $row_women['women_id'];
			$women_title = $row_women['women_title'];
			
		echo "<li><a href='index.php?women=$women_id'>$women_title</a></li>";
			
		}


}

//getting the kids categories

function getKids(){
	
	global $con;
	
	$get_kids = "select * from kids";
	
	$run_kids = mysqli_query($con, $get_kids);
	
		while ($row_kids=mysqli_fetch_array($run_kids)){
			
			$kids_id = $row_kids['kids_id'];
			$kids_title = $row_kids['kids_title'];
			
		echo "<li><a href='index.php?kids=$kids_id'>$kids_title</a></li>";
			
		}


}

function getPro() {
	
	if(!isset($_GET['men'])){
		if(!isset($_GET['women'])){
			if(!isset($_GET['kids'])){
	
	
	
	global $con;
	
	$get_pro = "select * from products order by RAND() LIMIT 0,12";
	
	$run_pro = mysqli_query($con, $get_pro);
	
	while($row_pro=mysqli_fetch_array($run_pro)){
		
		$pro_id = $row_pro['product_id'];
		$pro_men = $row_pro['product_men'];
		$pro_women = $row_pro['product_women'];
		$pro_kids = $row_pro['product_kids'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		
		echo "
		
			<div id='single_product'>
				
				<h3>$pro_title</h3>
				
				<img src='admin_area/product_images/$pro_image' width='180' height='180'/>
				
				<p><b> Price: $ $pro_price</b></p>
				
				<a href ='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
				<a href='index.php?add_scart=$pro_id'><button style='float:right'>Add to Cart</button></a>
			
			</div>
		";
	

	}
			}
		}
	}
}

function getMenPro() {
	
	if(isset($_GET['men'])){
		
		$men_id = $_GET['men'];
	
	global $con;
	
	$get_men_pro = "select * from products where product_men='$men_id'";
	
	$run_men_pro = mysqli_query($con, $get_men_pro);
	
	$count_men = mysqli_num_rows($run_men_pro);
	
	if($count_men==0){
	
		echo "<h2 style='padding:20px;'>There is no product available!</h2>";
	
	}
	
	while($row_men_pro=mysqli_fetch_array($run_men_pro)){
		
		$pro_id = $row_men_pro['product_id'];
		$pro_men = $row_men_pro['product_men'];
		$pro_women = $row_men_pro['product_women'];
		$pro_kids = $row_men_pro['product_kids'];
		$pro_title = $row_men_pro['product_title'];
		$pro_price = $row_men_pro['product_price'];
		$pro_image = $row_men_pro['product_image'];			
			
			echo "
		
				<div id='single_product'>
				
					<h3>$pro_title</h3>
				
					<img src='admin_area/product_images/$pro_image' width='180' height='180'/>
				
					<p><b>$ $pro_price</b></p>
				
					<a href ='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
			
				</div>
			";
	
			
	}
	
	}
}


function getWomenPro() {
	
	if(isset($_GET['women'])){
		
		$women_id = $_GET['women'];
	
	global $con;
	
	$get_women_pro = "select * from products where product_women='$women_id'";
	
	$run_women_pro = mysqli_query($con, $get_women_pro);
	
	$count_women = mysqli_num_rows($run_women_pro);
	
	if($count_women==0){
		
		echo "<h2 style='padding:20px;'>There is no product available!</h2>";
		
	}
	
	while($row_women_pro=mysqli_fetch_array($run_women_pro)){
		
		$pro_id = $row_women_pro['product_id'];
		$pro_men = $row_women_pro['product_men'];
		$pro_women = $row_women_pro['product_women'];
		$pro_kids = $row_women_pro['product_kids'];
		$pro_title = $row_women_pro['product_title'];
		$pro_price = $row_women_pro['product_price'];
		$pro_image = $row_women_pro['product_image'];
			
			echo "
		
				<div id='single_product'>
				
					<h3>$pro_title</h3>
				
					<img src='admin_area/product_images/$pro_image' width='180' height='180'/>
				
					<p><b>$ $pro_price</b></p>
				
					<a href ='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
			
				</div>
			";
	
			
	}
	
	}
}


function getKidsPro() {
	
	if(isset($_GET['kids'])){
		
		$kids_id = $_GET['kids'];
	
	global $con;
	
	$get_kids_pro = "select * from products where product_kids='$kids_id'";
	
	$run_kids_pro = mysqli_query($con, $get_kids_pro);
	
	$count_kids = mysqli_num_rows($run_kids_pro);
	
	if($count_kids==0){
		
		echo "<h2 style='padding:20px;'>There is no product available!</h2>";
		
	}
	
	while($row_kids_pro=mysqli_fetch_array($run_kids_pro)){
		
		$pro_id = $row_kids_pro['product_id'];
		$pro_men = $row_kids_pro['product_men'];
		$pro_women = $row_kids_pro['product_women'];
		$pro_kids = $row_kids_pro['product_kids'];
		$pro_title = $row_kids_pro['product_title'];
		$pro_price = $row_kids_pro['product_price'];
		$pro_image = $row_kids_pro['product_image'];
			
			echo "
		
				<div id='single_product'>
				
					<h3>$pro_title</h3>
				
					<img src='admin_area/product_images/$pro_image' width='180' height='180'/>
				
					<p><b>$ $pro_price</b></p>
				
					<a href ='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
			
				</div>
			";
	
			
	}
	
	}
}




?>