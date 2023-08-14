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

function delete_profile($con, $user_id)
{
    $delete_subjects_query = "DELETE FROM subjects WHERE user_id = '$user_id'";
    $delete_subjects_result = mysqli_query($con, $delete_subjects_query);
    
    $delete_profile_query = "DELETE FROM users WHERE user_id = '$user_id'";
    $delete_profile_result = mysqli_query($con, $delete_profile_query);

    return $delete_subjects_result && $delete_profile_result;
}
