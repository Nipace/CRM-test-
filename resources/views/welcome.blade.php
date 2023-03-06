<!DOCTYPE html>
<html>
<head>
	<title>CRM</title>
	<style type="text/css">
		body {
			background-color: #F9FAFB;
			font-family: Arial, sans-serif;
			color: #333;
			text-align: center;
			margin-top: 100px;
		}
		h1 {
			font-size: 48px;
			margin-bottom: 20px;
		}
		.btn {
			display: inline-block;
			padding: 10px 20px;
			background-color: #007BFF;
			color: #FFF;
			border-radius: 5px;
			font-size: 18px;
			text-decoration: none;
			margin-top: 20px;
		}
		.btn:hover {
			background-color: #0069D9;
		}
	</style>
</head>
<body>
	<h1>Welcome to our CRM system</h1>
	<a href="{{ route('login') }}" class="btn">Login</a>
</body>
</html>