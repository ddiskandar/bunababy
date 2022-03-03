<x-app-layout>
<!-- Card -->
<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <!-- Tabs -->
    <nav class="flex items-center border-b border-gray-200">
        <a href="javascript:void(0)" class="flex items-center px-3 py-4 -mb-px space-x-2 font-medium text-gray-500 border-b-2 border-transparent md:px-5 hover:text-indigo-500 active:text-gray-500">
            Profile
        </a>
        <a href="javascript:void(0)" class="flex items-center px-3 py-4 -mb-px space-x-2 font-medium text-indigo-500 border-b-2 border-indigo-500 md:px-5">
            Home
        </a>
        <a href="javascript:void(0)" class="flex items-center px-3 py-4 -mb-px space-x-2 font-medium text-gray-500 border-b-2 border-transparent md:px-5 hover:text-indigo-500 active:text-gray-500">
            Settings
        </a>
    </nav>
    <!-- END Tabs -->

    <!-- Card Body -->
    <div class="w-full p-5 lg:p-6 grow">
      <!-- Placeholder -->
      <div class="py-32 text-lg text-center text-gray-500 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">Content</div>
    </div>
    <!-- END Card Body -->
</div>
<!-- END Card -->
</x-app-layout>
