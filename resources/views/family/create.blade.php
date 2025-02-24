<form action="{{route('family.store')}}" method="POST">
    @csrf
    <label for="name">name</label>
    <input type="text" name="name" id="name">

    <button>submit</button>

</form>
