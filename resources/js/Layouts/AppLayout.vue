<!-- resources/js/Layouts/AppLayout.vue -->
<template>
  <div class="bg-gray-900 text-white font-inter">
    <!-- Header / Navîgasyon (Niha li vir e) -->
    <header
      id="navbar"
      class="fixed top-0 w-full z-50 transition-all duration-300"
      :class="{ 'bg-gray-900 shadow-lg py-2': isScrolled, 'bg-transparent py-4': !isScrolled }"
    >
      <nav class="container mx-auto px-6 flex justify-between items-center">
        <Link :href="route('home')">
            <h1 class="text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-yellow-400 to-yellow-200 text-transparent bg-clip-text tracking-wide">
                LXMAN
            </h1>
        </Link>
        <ul class="hidden md:flex space-x-8 items-center font-medium">
          <!-- Me lînk guhertin bo <Link> ya Inertia -->
          <li><Link :href="route('home')" class="hover:text-yellow-400 transition">سەرەکی</Link></li>
          <li><Link :href="route('offers')" class="hover:text-yellow-400 transition">ئۆفەر</Link></li>
          <li><a href="/#gallery" class="hover:text-yellow-400 transition">پێشانگەه</a></li>
          <li><a href="/#contact" class="hover:text-yellow-400 transition">پەیوەندی</a></li>
        </ul>
        <Link
          :href="route('home', { '#': 'contact' })"
          class="hidden md:block bg-yellow-400 text-gray-900 font-bold py-2 px-6 rounded-full hover:bg-yellow-300 transform hover:scale-105 transition"
        >
          حجز بکە
        </Link>
      </nav>
    </header>

    <!-- Naveroka her rûpelekê dê li vir xuya bibe -->
    <main>
      <slot />
    </main>

    <!-- Footer / Dawî (Niha li vir e) -->
    <footer class="bg-black py-10 text-center text-gray-400">
      <div class="container mx-auto px-6">
        <p>&copy; 2025 LXMAN. هەمی ماف پاراستی نە.</p>
        <p class="mt-2">دیزاین ب ❤️ و حەژێکرن هاتیە چێکرن</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3'; // Importkirina Link ji Inertia

const isScrolled = ref(false);
const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>