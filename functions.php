<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: login.php");
	die;

}

function update_profile($con, $user_id, $user_data)
{
	
    $firstname = mysqli_real_escape_string($con, $user_data['user_firstname']);
    $lastname = mysqli_real_escape_string($con, $user_data['user_lastname']);
    $phone = mysqli_real_escape_string($con, $user_data['user_phone']);
    $address = mysqli_real_escape_string($con, $user_data['user_address']);
    $dob = mysqli_real_escape_string($con, $user_data['user_dob']);
    $gender = mysqli_real_escape_string($con, $user_data['user_gender']);
    $email = mysqli_real_escape_string($con, $user_data['user_email']);
    $bio = mysqli_real_escape_string($con, $user_data['user_bio']);

    $query = "UPDATE users SET user_firstname = '$firstname', user_lastname = '$lastname', user_phone = '$phone', user_dob = '$dob', user_gender = '$gender', user_address = '$address', user_email = '$email', user_bio = '$bio' WHERE user_id = '$user_id'";

    return mysqli_query($con, $query);
}

function delete_profile($con, $user_id)
{
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    return mysqli_query($con, $query);
}