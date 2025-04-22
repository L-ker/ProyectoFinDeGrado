<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{$titulo ??""}}</title> --}}
    @vite ("resources/css/app.css")
</head>
<body class="flex flex-col min-h-screen h-65v">
<x-layouts.header />
<x-layouts.nav />
<main>
    {{$slot}}
</main>
<x-layouts.footer />
</body>
</html>
