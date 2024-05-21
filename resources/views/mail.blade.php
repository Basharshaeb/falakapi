<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
    <style>
        h1 {
            text-align: center;
            direction: rtl;
        }

        .code {
            color: red;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1><span>{{ $messageContent }} </span> :<span class="code"> {{ $verifyCode }}</span></h1>
</body>
</html>
