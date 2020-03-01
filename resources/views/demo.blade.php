<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <div>

            <h1>My Site</h1>

            @can ('edit_lead')
                <li>
                    <a href="#">Edit Lead</a>
                </li>
            @endcan

            @can ('register_user')
                <li>
                    <a href="#">Register User</a>
                </li>
            @endcan

        </div>
    </body>
</html>
