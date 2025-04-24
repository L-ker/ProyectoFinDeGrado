<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite ("resources/css/app.css")
</head>
<body class="flex flex-col min-h-screen">
    <x-layouts.header />
    <main class="h-75v flex items-center justify-center">
        {{$slot}}
    </main>
    <x-layouts.footer />
</body>
</html>
