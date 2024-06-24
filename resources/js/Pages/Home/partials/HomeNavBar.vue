<script setup>

$(document).ready(function () {
  const navHeight = $('nav').outerHeight();

  $('main').css('paddingTop', navHeight)
})
</script>

<template>
  <nav class="dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-black dark:border-white ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <div class="flex max-md:order-2 order-3 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <div class="flex gap-4 items-center">
          <div>
            <ul class="flex gap-5">
              <li>
                <a href="#" class="block py-2 px-3   text-blue-700 md:p-0 md:dark:text-blue-500"
                  aria-current="page">Home</a>
              </li>
              <li>
                <a href="#"
                  class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                  Sign In
                </a>
              </li>
            </ul>
          </div>
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Coba Sekarang
          </button>
        </div>

      </div>

      <div class="order-1">
        <h1 class="text-primary-500 text-body-bold text-2xl"><span class="text-primary-800">Blue</span>House.</h1>
      </div>

    </div>
  </nav>
</template>
