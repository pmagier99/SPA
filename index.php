<?php 

include("login.php");

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

  <!-- Container div -->
  <div class="w-1/2 mx-auto">

  <!-- Welcome header -->
  <h1 class="text-3xl font-bold underline text-center">
    Login page
  </h1>

  <!-- Login form -->
  <form class="flex flex-col " action="index.php" method="POST">
    <input type="text" name="username" placeholder="Email" class="m-5"/>
    <input type="password" name="password" placeholder="Password" class="m-5"/>
    <input type="submit" name="login" value="Login" class="bg-blue-500 m-5"/>

  </form>
  </div>

</body>
</html>