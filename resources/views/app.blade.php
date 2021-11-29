<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <title>Document</title>
</head>
<body data-theme="light">
    @livewire('todo-list')


    @livewireScripts
</body>
</html>