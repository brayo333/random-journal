<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" href="/favicon.ico" />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="A website where you can share journal entries anonymously with other users." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400;0,600;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/js/app.js'])
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
