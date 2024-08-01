<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizontal Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            background-color: #f19f39;
            padding: 10px 20px;
        }
        .header img {
            height: 40px;
            width: auto;
            margin-right: 20px;
        }
        .header h3 {
            color: white;
            margin: 0 20px 0 0;
            flex-shrink: 0;
        }
        .menu {
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
        }
        .menu a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .menu a:hover {
            background-color: #10a04a;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{asset('images/logo.png')}}" alt="Logo">
        <h3>Urban Planning Map</h3>
        <div class="menu">
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#about">About</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#contact">Contact</a>
            <a href="#blog">Blog</a>
        </div>
    </div>
</body>
</html>
