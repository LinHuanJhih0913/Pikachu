<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/singin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="/u/{{$user['id']}}" method="post">
    @csrf
    @method('PUT')
    <h1 class="h3 mb-3 font-weight-normal">Edit Profile</h1>

    <label for="inputName" class="sr-only">Name</label>
    <input type="text" id="inputName" class="form-control" placeholder="Your Name"
           name="name" value="{{$user['name']}}">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
    @include('layout.error')
</form>
</body>
</html>
