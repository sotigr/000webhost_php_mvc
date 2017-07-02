<?php
include 'mysql.php';

function login()
{
	session_start();
	$username = $_GET["username"];
	$password = $_GET["password"];
	try
	{
		if (trim($username) == "")
		{
			echo "Invalid username.";
			return;
		}

		if (trim($password) == "")
		{
			echo "Invalid password.";
			return;
		}

		if (array_key_exists('userid', $_SESSION))
		{
			echo "Already logged in.";
			return;
		}

		$ifres = query("select upassword from clients where uname = '" . $username . "';");
		if (is_array($ifres) && !empty($ifres))
		{
			if ($ifres[0]["upassword"] == $password)
			{
				$res = query("select * from clients where uname = '" . $username . "';");
				if (is_array($res) && !empty($res))
				{
					$_SESSION["userid"] = $res[0]["id"];
                    $_SESSION["useremail"] = $res[0]["uemail"];
                    $_SESSION["userimage"] = $res[0]["uimage"];
                    $_SESSION["username"] = $res[0]["uname"];  
					echo "1";
				}
				else
				{
					echo "0";
				}
			}
			else
			{
				echo "Wrong username or password.";
			}
		}
		else
		{
			echo "Wrong username or password.";
		}
	}

	catch(Exception $e)
	{
		echo "Wrong username or password.";
	}
}

login();
?>
