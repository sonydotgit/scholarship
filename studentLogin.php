<!-- studentLogin.php

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

	$app_id = $password = '';
	$errors = array('app_id' => '', 'password' => '');

	if(isset($_POST['submit'])){
		
		// check Phone Number
		if(empty($_POST['app_id'])){
			$errors['app_id'] = 'Application ID is required';
		} else{
			$app_id = $_POST['app_id'];
		}

		// check Password
		if(empty($_POST['password'])){
			$errors['password'] = 'Password is required';
		} else{
			$password = $_POST['password'];
		}


		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$app_id = mysqli_real_escape_string($conn, $_POST['app_id']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// create sql
			$sql = "SELECT S_password from student WHERE app_id='$app_id'";

			// get the query result
			$result = mysqli_query($conn, $sql);

			// fetch result in array format
			$pass = mysqli_fetch_assoc($result);	

			if ($pass['S_password'] == $password){
				session_start();
				$_SESSION['app_id'] = $app_id;
				header('Location: studetail.php');
			} else {
				$errors['password'] = 'Wrong Password';
			}


			mysqli_free_result($result);
			mysqli_close($conn);
		
			
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Student Login</h4>
		<form class="white" action="studentLogin.php" method="POST">
			<label>Application ID</label>
			<input type="text" name="app_id" value="<?php echo htmlspecialchars($app_id) ?>">
			<div class="red-text"><?php echo $errors['app_id']; ?></div>
			<label>Password</label>
			<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>