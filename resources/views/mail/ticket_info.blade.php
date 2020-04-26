<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Information</title>
</head>
<body>
    <p>Title: {{ $ticket->subject }}</p>
    <p>Message: {{ $ticket->message }}</p>
    <p>Status: {{ $ticket->status }}</p>
</body>
</html>
