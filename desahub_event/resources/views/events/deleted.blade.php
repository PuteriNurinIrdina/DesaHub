<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Deleted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin: 50px 0;
        }

        .message-container {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            margin: 0 20px;
            border-radius: 8px;
            text-align: center;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Event Deleted</h1>

    <div class="message-container">
        <p>The event has been successfully deleted.</p>
        <a href="{{ route('events.index') }}">Go back to Event List</a>
    </div>

</body>
</html>
