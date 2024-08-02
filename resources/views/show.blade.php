<!DOCTYPE html>
<html>
<head>
    <title>Contact Details</title><link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>
<h1>{{ $contact->name }}</h1>
<p>Email: {{ $contact->email }}</p>
<p>Phone: {{ $contact->phone }}</p>
<p>Address: {{ $contact->address }}</p>

<a href="{{ route('contacts.edit', $contact->id) }}">Edit</a>
<form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

<a href="{{ route('contacts.index') }}">Back to Contacts List</a>
</body>
</html>
