<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 12px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<div>
<p>User: {{ $user->name }}</p>
<p>Username: {{ $user->username }}</p>
<p>Email: {{ $user->email }}</p>
<p>Permission: {{ $permission }}</p>
<p><a alt="{{ __('alt.grant_access') }}" href="{{ url('/grant/' . $user->username . '/' . $permission . '/' . $user->permissions_token) }}">Grant Access</a></p>
<p><a alt="{{ __('alt.remove_access') }}" href="{{ url('/ungrant/' . $user->username . '/' . $permission . '/' . $user->permissions_token) }}">Remove Access</a></p>


</div>
</body>
</html>
