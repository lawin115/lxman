<!-- resources/js/Pages/Offers.vue -->
<template>
  <AppLayout title="ئۆفەر">
    <section class="pt-32 pb-24 bg-gray-800">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-5xl font-extrabold mb-4">
          ئۆفەر و <span class="text-yellow-400">داشکاندنێن</span> مە
        </h2>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-16">
          ئەڤان دەلیڤەیێن زێرین ژ دەست خۆ نەدە و خزمەتگوزاریێن مە ب بهایێن تایبət وەربگرە.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          <div
            v-for="offer in offers"
            :key="offer.id"
            class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg border border-transparent hover:border-yellow-500/50 transform hover:-translate-y-2 transition duration-500 flex flex-col"
            v-animate-on-scroll
          >
            <div class="relative">
              <img :src="offer.image_url" :alt="offer.title" class="w-full h-64 object-cover" />
              <span class="absolute top-4 right-4 bg-yellow-400 text-gray-900 font-bold text-sm py-1 px-3 rounded-full">
                {{ offer.badge }}
              </span>
            </div>
            <div class="p-6 flex flex-col flex-grow text-left">
              <h3 class="text-2xl font-bold text-yellow-400 mb-3">{{ offer.title }}</h3>
              <p class="text-gray-300 mb-6 flex-grow">{{ offer.description }}</p>
              <div class="flex items-center justify-between mt-auto">
                <div>
                  <span class="text-3xl font-bold">${{ offer.new_price }}</span>
                  <span class="text-lg text-gray-400 line-through ml-2">${{ offer.original_price }}</span>
                </div>
                <a href="#contact" class="bg-gray-700 text-white font-bold py-2 px-5 rounded-full hover:bg-yellow-400 hover:text-gray-900 transition">
                  حجز بکە
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'; // Bikaranîna Layout

// Props ji Controller tên
defineProps({
  offers: Array,
});

// Anîmasyona skrolê
const vAnimateOnScroll = {
  mounted: (el) => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            el.classList.add("is-visible");
            observer.unobserve(el);
          }
        });
      }, { threshold: 0.1 }
    );
    observer.observe(el);
  },
};
</script>