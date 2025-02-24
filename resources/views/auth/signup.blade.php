<form action="{{ route('auth.signuppost') }}" method="POST">
    @csrf

    <label for="name">name</label>
    <input type="text" name="name" id="name" required>
    @error('name')
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror
    <label for="email">email</label>
    <input type="email" name="email" id="email" required>
    @error('email')
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror

    <label for="password">password</label>
    <input type="password" name="password" id="password" required>
    @error('password')
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror

    <label for="is_head">Family owner</label>
    <input type="checkbox" name="is_head" id="is_head">
    @error('is_head')
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror

    <button type="submit">Register</button>
</form>
