<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    This is index page
    <div>
        Store
        <div>
            <form action="/post" method="post">
                <input type="text" placeholder="value" name="title">
                <input type="submit">
            </form>
        </div>
    </div>
    this is title
    <div>
        <?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
        }
        ?>
    </div>
</body>
</html>