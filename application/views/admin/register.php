<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration Page</title>
    <link rel="stylesheet" href="<?php base_url('assets/css/style.css')?>">
</head>
<body>
    <h2>Admin Registration</h2>
    <form action="" method="post">
        <input type="text" name="name" placeholder="enter admim name:" required><br>
        <input type="email" name="email" placeholder="enter email:" required><br>
        <input type="password" name="password" placeholder="enter password:" required><br>
        <button type="submit" value="submit">Submit</button>
    </form>
</body>
</html>