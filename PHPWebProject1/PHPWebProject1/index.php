
<!DOCTYPE HTML>
<html>
<head>
	<style>
        .error {
            color: red;
        }
    </style>
	<title>Home</title>
</head>
<body>

	<?php
	// define variables and set to empty values
	$nameErr = $emailErr = $genderErr = $websiteErr = "";
	$name = $email = $gender = $comment = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		} else {
			$name = test_input($_POST["name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed";
			}
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else {
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
			}
		}

		if (empty($_POST["gender"])) {
			$genderErr = "Gender is required";
		} else {
			$gender = test_input($_POST["gender"]);
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    ?>

	<h2>PHP Form Validation Example</h2>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		
		Nome: <input type="text" name="name" value="<?php echo $name;?>" />
		<span class="error">
			* <?php echo $nameErr;?>
		</span><br /><br />

		E-mail:
		<input type="text" name="email" value="<?php echo $email;?>" />
			<span class="error">
				* <?php echo $emailErr;?>
			</span><br /><br />
		
		Gênero:
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Feminino") echo "checked";?> value="Feminino" />Feminino
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Masculino") echo "checked";?> value="Masculino" />Masculino
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Outro") echo "checked";?> value="Outro" />Outro
		<span class="error">
			* <?php echo $genderErr;?>
		</span><br /><br />

		<input type="submit" name="submit" value="Enviar" />
	</form>

	<?php
		echo "<h2>Suas respostas</h2>";
		echo $name;
		echo "<br>";
		echo $email;
		echo "<br>";
	?>

</body>
</html>