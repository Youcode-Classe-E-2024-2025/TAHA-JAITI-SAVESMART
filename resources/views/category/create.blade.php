<form action="{{ route('category.store') }}" method="POST">
    @csrf

    <input type="text" name="name">

    <button type="submit">Create</button>
</form>
