<?php
	
	require 'db_connect.php';
	$title=$email=$ingredients='';
	$errors = array('email' => '','title' =>'','ingredients'=>'');
 if(isset($_POST['submit'])){
	

	if(empty($_POST['email'])){
		$errors['email']= 'An Email is required <br />';
	}else{
		$email=$_POST['email'];
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$errors['email']= 'email must be valid email address';
		}
	}


	if(empty($_POST['title'])){
		$errors['title']= ' A title is required <br />';
	}else{
		$title=$_POST['title'];
		if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
			$errors['title']='Title must be spaces and letters only';
		}
	}


	if(empty($_POST['ingredients'])){
		$errors['ingredients']= 'Atleast one ingredient is required <br />';
	}else{
		$ingredients=$_POST['ingredients'];
		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
			$errors['ingredients']='Ingredients must be comma separated only';
		}
	}
	if (array_filter($errors)) {
 	//echo 'errors in the form';
	 }else{
 	//echo 'form is valid';
	 	$email=mysqli_real_escape_string($connection,$_POST["email"]);
	 	$title=mysqli_real_escape_string($connection,$_POST["title"]);
	 	$ingredients=mysqli_real_escape_string($connection,$_POST["ingredients"
	 ]);

	 	$sql="INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
 	

if (mysqli_query($connection, $sql)) {
	
	header('Location: practice.php');

}else{
	echo 'query error: '.mysqli_error($connection);
}

  }


}
 	

?>







  
<!DOCTYPE html>
<html>

<?php include('header.php') ?>
<section class="container grey-text">
	<h4 class="center">Add a Pizza</h4>
	<form class="white" action="add.php" method="POST">
		<label>Your Email:</label>
		<input type="text" name="email" value="<?php echo $email ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Pizza Title:</label>
		<input type="text" name="title" value="<?php echo $title ?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Ingredients(comma separated):</label>
		<input type="text" name="ingredients" value="<?php echo $ingredients ?>">
		<div class="red-text"><?php echo $errors['ingredients']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>

	</form>
</section>






<?php include('footer.php') ?>
	
</html>