<!-- c_verify.php

MIT License

Copyright (c) 2022 Sohan Jain

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. 
-->

<?php 
	include('config/db_connect.php');

	if(isset($_POST['decline'])){

		$id_to_update = mysqli_real_escape_string($conn, $_POST['status_id']);

		// query
		$sql_dec = "UPDATE application SET status='declined' WHERE app_id='$id_to_update'";

		if(mysqli_query($conn, $sql_dec)){
			header('Location: c_app.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}


	}

	if(isset($_POST['verify'])){

		$id_to_update = mysqli_real_escape_string($conn, $_POST['status_id']);

		$sql_ver = "UPDATE application SET status='verified' WHERE app_id='$id_to_update'";

		if(mysqli_query($conn, $sql_ver)){
			header('Location: c_app.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}

	if(isset($_POST['app_id'])){

		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_POST['app_id']);

		// make sql
		$sql = "SELECT a.app_id, a.s_name, a.c_code, a.aadhar, a.reg_no, a.prev_year_perc, a.status, b.ifsc, b.acc_no, b.b_name FROM application a, bank_detail b WHERE a.app_id=b.app_id AND b.app_id='$id'";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$app = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}



?>

<!DOCTYPE html>
<html>

	<?php include('templates/logout.php'); ?>

	<div class="container center white">
		<?php if($app): ?>
			<h4>Application ID&#58;<?php echo $app['app_id']; ?></h4>
			<p>Name&#58; <?php echo $app['s_name']; ?></p>
			<p>College Code&#58; <?php echo $app['c_code']; ?></p>
			<p>Aadhar&#58; <?php echo $app['aadhar']; ?></p>
			<p>USN&#58; <?php echo $app['reg_no']; ?></p>
			<p>Previous Year&#37;&#58; <?php echo $app['prev_year_perc']; ?></p>
			<p>Bank Name&#58; <?php echo $app['b_name']; ?></p>
			<p>IFSC&#58; <?php echo $app['ifsc']; ?></p>
			<p>Account Number&#58; <?php echo $app['acc_no']; ?></p>
			<h5>Status&#58; <?php echo $app['status']; ?></h5>

		<?php else: ?>
			<h5>No such student exists.</h5>
		<?php endif ?>
	</div>

	<div class="container center">
		<form action="verify.php" method="POST">
				<input type="hidden" name="status_id" value="<?php echo $app['app_id']; ?>">
				<input type="submit" name="decline" value="Decline" class="btn brand z-depth-0">
				<input type="submit" name="verify" value="Verify" class="btn brand z-depth-0">
		</form>
	</div>

	<?php include('templates/footer.php'); ?>

</html>