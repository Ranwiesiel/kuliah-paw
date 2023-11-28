<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
	<title>Homepage</title>

	<style>
		body {
			background-image: url('bg1.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
</head>

<body>
	<div class='container mt-5'>
		<div class='row'>
			<div class='col-4 mx-auto'>
				<h1 style="font-family: 'Playfair Display', serif; color: coral; text-shadow: 3px 3px 0 #000;"><b>DAIRW</b></h1>
				<div class="card">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form method="post" action="login_action.php?login">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="Username" class="form-control" id="username" autocomplete="off" name='username'>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name='password'>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name='submit'>Login</button>
                        </form>
                        <p class="card-text">Login sebagai <a href="login_action.php?guest">guest</a>!</p>
                    </div>
                </div>
			</div>
		</div>
	</div>
</body>

</html>