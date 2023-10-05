<div class="relative min-h-screen lg:grid lg:grid-cols-[82px,auto] ">
    <aside class="fixed bg-white border-t lg:border-r lg:relative lg:border-none shadow-lg bottom-0 z-[51] flex justify-center w-full py-2 lg:flex-col lg:items-center lg:justify-center lg:col-start-1 lg:row-start-1 px-3">
        <nav class="flex justify-center lg:flex-col gap-4 items-center">
            <li class="border w-fit rounded-xl list-none hover:bg-slate-200 ease duration-150 hover:cursor-pointer">
                <a href='/' class="block p-3 lg:p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </li>
            <li class="border w-fit rounded-xl list-none hover:bg-slate-200 ease duration-150 hover:cursor-pointer">
                <a href='/create' class="block p-3 lg:p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 lg:w-6 lg:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>  
                </a>
            </li>
        </nav>
    </aside>

    <aside class="lg:col-start-2 lg:p-8 ">
        <x-layouts.app>
    
            @livewire('create-rating')
        
        
        </x-layouts.app>
    </aside>
</div>


