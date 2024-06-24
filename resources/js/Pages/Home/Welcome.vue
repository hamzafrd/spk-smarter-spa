<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from './partials/HomeLayout.vue';
import HomeNavBar from './partials/HomeNavBar.vue';
import HomeFooter from './partials/HomeFooter.vue';
import BlueHouseText from './Text/BlueHouseText.vue';
import HomeButton from './Button/HomeButton.vue'

</script>

<template>

  <Head title="BlueHouse" />
  <HomeLayout>
    <header>
      <HomeNavBar />
    </header>

    <main class="font-charter">
      <section id="jumbotron" class="flex w-screen max-h-svh overflow-hidden ]">
        <div class="w-1/2 p-5 flex flex-col items-start justify-center">
          <div class="md:text-heading1-bold text-body-bold">
            Dapatkan Tanah Perumahan Ideal Dengan
            <BlueHouseText />
          </div>
          <p>BlueHouse menyediakan beragam kriteria yang bisa anda pilih dan sesuaikan dengan sangat mudah.</p>
          <br>
          <HomeButton text="Coba Sekarang" />
        </div>

      </section>

      <section>

      </section>
    </main>

    <HomeFooter />
  </HomeLayout>
</template>
