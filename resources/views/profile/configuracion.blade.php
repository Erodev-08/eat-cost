<x-app-layout>

    <div class="py-2 px-6 bg-orange-500 flex item-center shadow-md shadow-xl/20">
        <button type="button" class="text-lg text-gray-200">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-3">
                <a href="#" class="text-gray-200 hover:text-gray-300 font-medium">Configuración</a>
            </li>
        </ul>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-300 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
