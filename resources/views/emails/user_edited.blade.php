<DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <p>Hi {{$user['name']}}, your Coverage Center account details have been edited. Following are your new account details: <br></p>
    <h5>Name:</h5>
    <p>{{$user['name']}}</p>
    <h5>Email:</h5>
    <p>{{$user['email']}}</p>
    <h5>Roles:</h5>
    <p>
        @foreach ($user['roles'] as $role)
            {{$role['label']}}@if (!$loop->last),@endif
        @endforeach
    </p>
    @if ($user['city'])
        <h5>City:</h5>
        <p>{{$user['city']}}</p>
    @endif
    @if ($user['state'])
        <h5>Country:</h5>
        <p>{{$user['state']}}</p>
    @endif
    @if ($user['phone'])
        <h5>Phone:</h5>
        <p>{{$user['phone']}}</p>
    @endif
</body>
</html>