<div x-data="{visible: false}" class="relative inline-block text-left">

    {{-- Dropdown Button --}}
    <div>
      <button @click="visible = !visible" @click.outside="visible = false" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-[#fafafa] px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
        <svg class=" size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
          <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
  
    {{-- Dropdown Menu --}}
    <div x-show="visible" x-transition class="absolute left-0 z-10 mt-2 py-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none flex justify-center gap-12" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1 px-2" role="none">
            <h3 class="block px-4 py-2 rounded-md text-lg text-gray-700 font-semibold">Tipe</h3>
            <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
            <a href="{{ url('/seminar') }}" class="block px-4 py-2 rounded-md  text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1" id="menu-item-0">Seminar</a>
            <a href="{{ url('/workshop') }}" class="block px-4 py-2 rounded-md  text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1" id="menu-item-1">Workshop</a>
        </div>
        <div class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
            <h3 class="block px-4 py-2 rounded-md text-lg text-gray-700 font-semibold">Kategori</h3>
            <a href="" class="block px-4 py-2 rounded-md  text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1" id="menu-item-0">Teknologi</a>
            <a href="#" class="block px-4 py-2 rounded-md  text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1" id="menu-item-1">Seni Budaya</a>
            <a href="#" class="block px-4 py-2 rounded-md  text-sm text-gray-700 hover:bg-gray-50" role="menuitem" tabindex="-1" id="menu-item-1">Kesehatan</a>
        </div>
    </div>
</div>