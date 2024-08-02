<!DOCTYPE html>
<html>
<head>
    <title>Contacts</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="/contacts">Contact</a></li>
            <li><a href="/contacts/create">Create</a></li>
        </ul>
    </nav>
<h1>Contacts</h1>

<form action="{{ route('contacts.index') }}" method="GET">
    <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
    <button type="submit">Search</button>
    <select name="sort" onchange="this.form.submit()">
        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
    </select>
</form>

<ul>
    @foreach ($contacts as $contact)
        <li>
            <a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a>
            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

{{ $contacts->links() }}
</body>
</html>
