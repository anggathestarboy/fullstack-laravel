<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-lg font-semibold">Library App</h1>
   <ul class="flex items-center gap-4 ml-auto list-none">
    @forelse ($menus as $menu)
        <li
            @class([
                'px-3 py-1 text-sm font-medium transition-all duration-300 rounded hover:bg-gray-200',
                'text-gray-600' => $loggedIn,
                'text-red-600' => !$loggedIn,
            ])
        >
            <a href="{{ $menu['href'] }}">{{ $menu['label'] }}</a>
        </li>
    @empty
        <p class="text-sm text-red-600">Your menus are still empty</p>
    @endforelse

   



        
       @if ($loggedIn === true)
   <li class="flex items-center gap-3 lg:ml-4">
    
    <p class="font-medium text-sm text-gray-500">Khen Cahyo</p>
    <div class="avatar placeholder">
        <div class="bg-gray-200 text-neutral-content rounded-full w-10 h-10 flex items-center justify-center">
            <span class="text-lg font-semibold text-gray-800">K</span>
        </div>
    </div>
</li>

@else
    <li class="mt-4 flex flex-col gap-4 md:flex-row md:items-center lg:mt-0 lg:ml-4">
        <button
            class="px-3 py-2 border border-gray-800 rounded text-xs font-medium block w-full transition-all duration-300 hover:bg-gray-800 hover:text-white lg:text-sm">Login</button>
        <button
            class="px-3 py-2 bg-gray-800 rounded text-xs font-medium text-white block w-full lg:text-sm">Register</button>
    </li>
@endif
      </div>
      <button class="md:hidden text-xl" id="navButton"><i class="fas fa-bars"></i></button>
    </div>
    <div class="hidden px-6 pb-4 flex-col gap-3 md:hidden" id="navMenu">
      <a href="#" class="block py-1 font-medium hover:text-blue-600">Home</a>
      <a href="#" class="block py-1 font-medium hover:text-blue-600">Books</a>
      <button class="px-4 py-1 border border-gray-800 rounded text-sm hover:bg-gray-800 hover:text-white transition">Login</button>
      <button class="px-4 py-1 mt-2 bg-gray-800 text-white rounded text-sm hover:bg-gray-700 transition">Register</button>
    </div>
  </nav>
