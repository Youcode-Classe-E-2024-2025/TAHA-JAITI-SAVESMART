<form action="{{ route('auth.loginpost') }}" method="POST">
    @csrf

    @if (session('status'))
        <p class="mt-1 text-sm text-green-400">{{ session('status') }}</p>
    @endif

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

    <button type="submit">Login</button>
</form>
