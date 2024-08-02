<!DOCTYPE html>
<html>
<head>
    <title>Create Contact</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>
<h1>Create Contact</h1>

<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Phone:</label>
    <input type="text" name="phone"><br>
    <label>Address:</label>
    <input type="text" name="address"><br>
    <button type="submit">Create</button>
</form>

<a href="{{ route('contacts.index') }}">Back to Contacts List</a>


</body>
</html>
