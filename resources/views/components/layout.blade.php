<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wrestling App</title>
    @vite(['resources/css/app.css'])
</head>
   
<body> 
   
    @include('modules.header.header')

    <main>
       {{$slot}}   
    </main>

</body>
</html>