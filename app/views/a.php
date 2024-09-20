<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to LavaLust</title>
</head>

<body>
    <div class="header">A</div>
    <div class="main">
        <b>Error</b> is a <i>Lightweight PHP Framework</i> that uses MVC(Model View Controller) design pattern for
        people who are developing web applications using PHP. It helps you write code easily using Object-Oriented
        Approach. It also provides set of libraries for commonly needed tasks, as well as helper functions to minimize
        the amount of time coding.
        <p class="mt-4 text-center text-lg text-gray-700" style="color: white; font-size: 17px">
            Go to B? <a href="<?= site_url('b') ?>" style="color: aqua; text-decoration: underline">b</a>
        </p>
    </div>
</body>

</html>