<div id="navco" class="sticky top-0 z-40 flex py-3 shrink-0 items-center bg-base-100 gap-x-4 shadow shadow-base-300 shadow-sm sm:gap-x-6 px-4">
	<button id="open-mobile-menu" type="button" class="-m-2.5 p-2.5 lg:hidden">
		<span class="sr-only">Open sidebar</span>
		<svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
			<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
		</svg>
	</button>

	<!-- Separator -->
	<div class="h-6 w-px lg:hidden" aria-hidden="true"></div>

	<button id="sidebar-toggle-btn" type="button" class="-m-2.5 p-2.5 lg:block hidden hover:bg-base-300/60 transition-all duration-200 rounded-xl">
		<span class="sr-only">Open sidebar</span>
		<x-heroicon-o-bars-2 class="w-5" />
	</button>

	<div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
		<form class="grid flex-1 grid-cols-1" action="#" method="GET">
			<input autocomplete="off" type="search" name="search" aria-label="Buscar..." class="col-start-1 row-start-1 block size-full pl-8 outline-hidden placeholder sm:text-sm/6" placeholder="Buscar..." />
			<svg class="pointer-events-none col-start-1 row-start-1 size-5 self-center" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
				<path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
			</svg>
		</form>
		<div class="flex items-center gap-x-4 lg:gap-x-6">

			<button type="button" class="btn btn-primary btn-sm">
				Crear
			</button>

			<!-- Separator -->
			<div class="hidden lg:block lg:h-6 lg:w-px bg-base-content/15" aria-hidden="true"></div>

			<!-- Profile -->
			<button class="rounded-full bg-gray-50 overflow-hidden">
				<a href="{{ route('panel_ajustes') }}">
					<span class="sr-only">Open user menu</span>
					<img class="sm:size-9 size-9 object-cover" src="{{ Storage::url(auth()->user()->avatar) }}" alt="" />
				</a>
			</button>

		</div>
	</div>
</div>
