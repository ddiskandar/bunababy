<div>
    <!-- User Profile -->
  <div class="md:flex md:space-x-5">
    <!-- User Profile Info -->
    <div class="text-center md:flex-none md:w-1/3 md:text-left">
      <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
        <svg class="inline-block w-5 h-5 text-pink-500 hi-solid hi-user-circle" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
        <span>User Profile</span>
      </h3>
      <p class="mb-5 text-sm text-gray-500">
        Your account’s vital info. Only your username and photo will be publicly visible.
      </p>
    </div>
    <!-- END User Profile Info -->

    <!-- Card: User Profile -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
      <!-- Card Body: User Profile -->
      <div class="w-full p-5 lg:p-6 grow">
        <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">
          <div class="space-y-1">
            <label class="font-medium">Photo</label>
            <div class="space-y-4 sm:flex sm:items-center sm:space-x-4 sm:space-y-0">
              <div class="inline-flex items-center justify-center w-16 h-16 text-gray-300 bg-gray-100 rounded-full">
                <svg class="inline-block w-8 h-8 hi-solid hi-user" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
              </div>
              <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" type="file" id="photo" name="photo">
              </label>
            </div>
          </div>
          <div class="space-y-1">
            <label for="name" class="font-medium">Name</label>
            <input wire:model="state.name" class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="text" id="name" name="name" placeholder="John Doe">
          </div>
          <div class="space-y-1">
            <label for="email" class="font-medium">Email</label>
            <input class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="email" id="email" name="email" placeholder="john.doe@example.com">
          </div>
          <div class="space-y-1">
            <label for="title" class="font-medium">Job Title</label>
            <input class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="text" id="title" name="title" placeholder="Product Manager">
          </div>
          <div class="space-y-1">
            <label for="company" class="font-medium">Company</label>
            <input class="block w-full px-3 py-2 leading-6 border border-gray-200 rounded focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" type="text" id="company" name="company" placeholder="@company">
          </div>
          <button type="submit" class="inline-flex items-center justify-center px-3 py-2 space-x-2 text-sm font-semibold leading-5 text-white bg-pink-700 border border-pink-700 rounded focus:outline-none hover:text-white hover:bg-pink-800 hover:border-pink-800 focus:ring focus:ring-pink-500 focus:ring-opacity-50 active:bg-pink-700 active:border-pink-700">
            Update Profile
          </button>
        </form>
      </div>
      <!-- Card Body: User Profile -->
    </div>
    <!-- Card: User Profile -->
  </div>
  <!-- END User Profile -->
</div>
