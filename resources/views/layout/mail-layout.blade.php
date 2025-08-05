<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style type="text/css">
        .mail-wrap {
            background: #f7f7f7;
            padding: 20px;
            font-family: sans-serif;
        }

        .mail-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .mail-head {
            background: linear-gradient(117.04deg, #42C8DF 8.53%, #EE3678 88.82%);
            padding: 20px;
            text-align: center;
            color: white;
            font-weight: bold;
        }

        .mail-body {
            padding: 20px;
            background: #fff;
            border: 1px solid #eee;
        }

        .mail-footer {
            background: #000;
            padding: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
@yield('body')
</body>
</html>
