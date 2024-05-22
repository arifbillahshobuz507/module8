<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Persone create</title>
</head>
<body>
    <h1>Create New Persone</h1>
    <form action="{{ route('person') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required><br>
        <label for="image">image</label>
        <input type="file" name="image" id="image" required><br>
        <button type="submit">Create Persone</button>

</body>
</html>
