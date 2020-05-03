<?php 

include('db_connect.php');

if(isset($_POST['delete'])) {
	
	$id_to_delete = mysqli_real_escape_string($connection,$_POST['id_to_delete']);
	echo $id_to_delete;

	
	$sql = "DELETE FROM pizza WHERE id = $id_to_delete";
	
	if (mysqli_query($connection,$sql)) {
		header('Location: practice.php');
	}else{
		echo 'query error: '.mysqli_error($connection);
	}
}

if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($connection,$_GET['id']);

	$sql="SELECT * FROM pizzas WHERE id=$id";

	$result=mysqli_query($connection,$sql);

	$pizza=mysqli_fetch_assoc($result);


	mysqli_free_result($result);
	mysqli_close($connection);
	


}




 ?>

 <!DOCTYPE html>
 <html>
 <?php include('header.php') ;?>

<div class="container center">
	<?php if($pizza): ?>
		<h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
		<p>created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
		<p><?php echo date($pizza['created_at']); ?></p>
		<h5>Ingredients:</h5>
		<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
		<!--DELETE FORM-->
		<form action="details.php" method="POST">
			<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
			<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
		</form>
	<?php else: ?>
		<h5>NO SUCH PIZZA EXISTS!!!!</h5>

	<?php endif; ?>
		

</div>

 <?php include('footer.php') ;?>

 </html>