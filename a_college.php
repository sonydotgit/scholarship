<!-- a_college.php

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

	$c_code = $c_password = $c_name = '';
	$errors = array('c_code' => '', 'c_password' => '', 'c_name' => '', 'query' => '');

	// if pressed Delete
	if(isset($_POST['delete'])){

		// check c_code
		if(empty($_POST['c_code'])){
			$errors['c_code'] = 'College Code is required';
		} else {
			$c_code = $_POST['c_code'];
		}

		if(!(array_filter($errors))){
			// escape sql chars
			$c_code = mysqli_real_escape_string($conn, $_POST['c_code']);

			// query to delete
			$sql = "DELETE FROM college WHERE c_code='$c_code'";

			// check whether query executed successfully
			if(mysqli_query($conn, $sql)){
				// Do nothing for now
			} else{
				$errors['query'] = 'Unable to delete: ' . mysqli_error($conn);
			}
		}
	}

	// if pressed Add
	if(isset($_POST['add'])){

		// check c_code
		if(empty($_POST['c_code'])){
			$errors['c_code'] = 'College Code is required';
		} else {
			$c_code = $_POST['c_code'];
		}

		// check c_password
		if(empty($_POST['c_password'])){
			$errors['c_password'] = 'Password is required';
		} else {
			$c_password = $_POST['c_password'];
		}

		// check c_name
		if(empty($_POST['c_name'])){
			$errors['c_name'] = 'College Name is required';
		} else {
			$c_name = $_POST['c_name'];
		}

		// Check for errors
		if(array_filter($errors)){
			//print errors in the form
		} else {
			// escape sql chars
			$c_code = mysqli_real_escape_string($conn, $_POST['c_code']);
			$c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
			$c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

			// query to insert into college
			$sql = "INSERT INTO college VALUES ('$c_code','$c_name','$c_password')";

			// check whether the query executed without any error
			if(mysqli_query($conn, $sql)){
				// Do nothing
			} else{
				$errors['query'] = 'Unable to insert: ' . mysqli_error($conn);
			}
		}

	}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/logout.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Edit College</h4>

		<form class="white" action="a_college.php" method="POST">
			<label>College Code</label>
			<input type="text" name="c_code" value="<?php echo htmlspecialchars($c_code); ?>">
			<div class="red-text"><?php echo $errors['c_code']; ?></div>
			<label>Password</label>
			<input type="password" name="c_password" value="<?php echo htmlspecialchars($c_password); ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<label>College Name</label>
			<input type="text" name="c_name" value="<?php echo htmlspecialchars($c_name); ?>">
			<div class="red-text"><?php echo $errors['c_name']; ?></div>

			<div class="center">
				<input type="submit" name="add" value="Add" class="btn brand z-depth-0">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>