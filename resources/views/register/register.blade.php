<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/register.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="/register" method="post">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

    <label for="inputName" class="sr-only">Name</label>
    <input type="text" id="inputName" class="form-control" placeholder="Your Name"
           name="name">

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address"
           name="email">

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password"
           name="password">

    <label for="inputPassword_confirmation" class="sr-only">Password</label>
    <input type="password" id="inputPassword_confirmation" class="form-control" placeholder="Password_confirmation"
           name="password_confirmation">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    @include('layout.error')
</form>
</body>
</html>
