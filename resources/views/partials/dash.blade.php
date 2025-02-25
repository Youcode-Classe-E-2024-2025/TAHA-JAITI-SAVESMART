<!-- Sidebar -->
<aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto glass">
        <div class="mb-8 ml-3">
            <h2 class="text-2xl font-bold tracking-tighter">
                <span class="gradient-text">7seb</span>Flosk
            </h2>
        </div>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('dashboard')}}" class="flex items-center p-2 rounded-lg text-white hover:bg-lime-400/20 group">
                    <svg class="w-5 h-5 text-lime-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4V1m0 3h18M3 4v13m0-13h4.5m-4.5 13h18V8H3m4.5-4v4"/>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.transactions')}}" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v12h12M4 9h12M9 4v12"/>
                    </svg>
                    <span class="ml-3">Transactions</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span class="ml-3">Goals</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3a6 6 0 0 1 6 6c0 3.314-2.686 6-6 6s-6-2.686-6-6 2.686-6 6-6Zm0 0v6m-3-3h6"/>
                    </svg>
                    <span class="ml-3">Family</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
