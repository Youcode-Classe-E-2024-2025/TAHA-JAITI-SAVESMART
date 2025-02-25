<!-- Top Bar -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="text-gray-400">Here's your financial overview</p>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{route('trans.create')}}" class="px-4 py-2 rounded-full bg-lime-400 text-black hover:bg-yellow-400 transition-colors">
            Add Transaction
        </a>
        <div
            id="user-menu"
            class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center cursor-pointer hover:bg-gray-600 transition-colors">
            <i class="fa-solid fa-user"></i>
        </div>
    </div>
</div>


<script>
    const userMenu = document.getElementById('user-menu');

    userMenu.addEventListener('click', () => {
        console.log('clicked');
    });

</script>
