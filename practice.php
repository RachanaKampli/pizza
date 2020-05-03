<?php
	
	require 'db_connect.php';
	$sql='SELECT title,ingredients,id FROM pizzas ORDER BY created_at';

	$result= mysqli_query($connection,$sql);

	$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($connection);

?>

<!DOCTYPE html>
<html>

<?php include('header.php'); ?>


 <h4 class="center grey-text">Pizzas...</h4>
 <div class="container">
 	<div class="row">
 		<?php foreach ($pizzas as $pizza): ?>
 			<div class="col s6 md3">
 				<div class="card z-depth-0">
 					<div class="card-content center">
 						<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
 						<ul>
 							<?php foreach (explode(',', $pizza['ingredients']) as $ing): ?>
 								<li><?php echo htmlspecialchars($ing); ?></li>
 							<?php endforeach; ?>
 						</ul>
 					</div>
 					<div class="card-action right-align">
 						<a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
 					</div>
 				</div>
 			</div>


 		<?php endforeach; ?>
 		<?php if(count($pizzas)>=2): ?>
 			<p>there are 2 or more pizzas</p>
 		<?php else: ?>
 			<p>there are less than 2 pizzas</p>
 		<?php endif; ?>
 	</div>
 </div>

<?php include('footer.php'); ?>
	
</html>