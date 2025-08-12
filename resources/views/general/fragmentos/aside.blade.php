<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div id="mobile-menu-container" class="relative z-50 lg:hidden hidden" role="dialog" aria-modal="true">
	<div id="mobile-menu-backdrop" class="fixed inset-0 bg-base-300/80 opacity-0 transition-opacity ease-linear duration-300"></div>
	<div class="fixed inset-0 flex">
		<div id="mobile-menu-panel" class="relative mr-16 flex w-full max-w-xs flex-1 -translate-x-full transition-transform ease-in-out duration-300">

			<div class="absolute top-0 left-full flex w-16 justify-center pt-5">
				<button id="close-mobile-menu" type="button" class="-m-2.5 p-2.5 text-white">
					<span class="sr-only">Close sidebar</span>
					<svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
					</svg>
				</button>
			</div>

			<!-- Sidebar component, swap this element with another sidebar if you like -->
			<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-base-100 px-6 pb-4 ring-1 ring-white/10">
				<div class="flex h-16 shrink-0 items-center">
					<img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company" />
				</div>
				<nav class="flex flex-1 flex-col">
					<ul role="list" class="flex flex-1 flex-col gap-y-2 pb-7">
						<li>
							<ul role="list" class="-mx-2 space-y-1">
								<li>
									<a href="{{ route('panel') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel') ? 'bg-base-200' : '' }}">
										<x-heroicon-s-home class="w-5" />
										<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Inicio</span>
									</a>
								</li>

								<li>
									<a href="{{ route('panel_iglesias') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_iglesias') ? 'bg-base-200' : '' }}">
										<x-heroicon-s-home-modern class="w-5" />
										<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Iglesias</span>
									</a>
								</li>

								<li>
									<a href="{{ route('panel_personas') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_personas') ? 'bg-base-200' : '' }}">
										<x-heroicon-s-user class="w-5" />
										<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Personas</span>
									</a>
								</li>

								<li>
									<a href="{{ route('panel_grupos') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_grupos') ? 'bg-base-200' : '' }}">
										<x-heroicon-s-user-group class="w-5" />
										<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Grupos</span>
									</a>
								</li>

								<li>
									<a href="{{ route('panel_seguimientos') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_seguimientos') ? 'bg-base-200' : '' }}">
										<x-heroicon-s-chat-bubble-left class="w-5" />
										<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Seguimientos</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="mt-auto">
							<a href="{{ route('panel_ajustes') }}" class="group flex gap-x-3 p-2 text-lg font-normal duration-100 transition-all rounded-md hover:bg-base-200/70 {{ request()->routeIs('panel_ajustes') ? 'items-center bg-base-200' : '' }}">
								<x-heroicon-s-wrench class="w-5" />
								Ajustes
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Static sidebar for desktop -->
<div id="desktop_aside" class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:flex-col shadow-r shadow-base-300 shadow-sm lg:w-64 group-[.sidebar-plegado]:lg:w-17 transition-all duration-500">
	<div class="bg-base-100 flex grow flex-col gap-y-5 overflow-y-auto px-6 group-[.sidebar-plegado]:px-5 pb-4">
		<div class="flex h-16 shrink-0 items-center">
			<img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company" />
		</div>
		<nav class="flex flex-1 flex-col">
			<ul role="list" class="flex flex-1 flex-col gap-y-7">
				<li>
					<ul role="list" class="-mx-2 space-y-1">
						<li>
							<a href="{{ route('panel') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-home class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Inicio</span>
							</a>
						</li>

						<li>
							<a href="{{ route('panel_iglesias') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_iglesias') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-home-modern class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Iglesias</span>
							</a>
						</li>

						<li>
							<a href="{{ route('panel_personas') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_personas') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-user class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Personas</span>
							</a>
						</li>

						<li>
							<a href="{{ route('panel_grupos') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_grupos') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-user-group class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Grupos</span>
							</a>
						</li>

						<li>
							<a href="{{ route('panel_seguimientos') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_seguimientos') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-chat-bubble-left class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Seguimientos</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="mt-auto">
					<ul role="list" class="-mx-2 space-y-1">
						<li>
							<a href="{{ route('panel_ajustes') }}" class="group-[.sidebar-plegado]:justify-center group-[.sidebar-plegado]:px-2.5 group-[.sidebar-plegado]:w-fit group-[.sidebar-plegado]:gap-x-0 group grid grid-cols-[auto_1fr] items-center gap-x-3 p-2 text-sm/6 font-normal rounded-md transition-all duration-300 hover:bg-base-300 group-[.sidebar-plegado]:grid-cols-[auto,0fr] {{ request()->routeIs('panel_ajustes') ? 'bg-base-200' : '' }}">
								<x-heroicon-s-wrench class="w-5" />
								<span class="opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.sidebar-plegado]:opacity-0">Ajustes</span>
							</a>
						</li>
					</ul>

				</li>
			</ul>
		</nav>
	</div>
</div>
