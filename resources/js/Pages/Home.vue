<template>
  <AppLayout title="سەرەکی">
    <!-- Anîmasyona Destpêkê -->
    <Transition name="fade">
      <div v-if="isLoading" class="fixed inset-0 bg-gray-900 z-[100] flex items-center justify-center">
        <h1
          class="text-5xl font-extrabold bg-gradient-to-r from-yellow-400 to-yellow-200 text-transparent bg-clip-text tracking-wide animate-pulse"
        >
          LXMAN
        </h1>
      </div>
    </Transition>

    <!-- Naveroka Serekî -->
    <main>
      <!-- Beşa Serekî (Hero) -->
      <section id="hero" class="relative h-screen">
        <div class="absolute inset-0">
            <div class="w-full h-full">
              <img
                v-for="(img, i) in heroImages"
                :key="i"
                :src="img"
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-[1500ms]"
                :class="currentHero === i ? 'opacity-100' : 'opacity-0'"
                alt="Wêneyê salona sertraşînê"
              />
            </div>
            <div class="absolute inset-0 bg-black/70"></div>
          </div>
          <div
            class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6"
          >
            <h2 class="text-5xl md:text-7xl font-extrabold mb-6 animate-on-load">
              ستایلێ خۆ <span class="text-yellow-400">نووژەن</span> بکە
            </h2>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto mb-8 animate-on-load delay-1">
              ئێمە ل ڤێرێ نە دا کو باشترین خزمەتگوزاریێن سەرتراشین، ڕێکخستنا ڕهـ و گرنگیدان ب ستایلێ تە پێشکێش بکەین.
            </p>
            <a
              href="#services"
              class="bg-yellow-400 text-gray-900 font-bold py-3 px-10 rounded-full text-lg shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition animate-on-load delay-2"
            >
              خزمەتێن مە ببینە
            </a>
          </div>
      </section>

      <!-- Beşa Xizmetguzarî -->
      <section id="services" class="py-24 bg-gray-800">
         <div class="container mx-auto px-6 text-center" v-animate-on-scroll>
            <h2 class="text-4xl font-extrabold mb-4">خزمەتگوزاریێن شاهانە</h2>
            <p class="text-gray-300 max-w-2xl mx-auto mb-12">
              ژ سەرتاشینێ bgrە heta aramkirina giyanê te, me hemî tişt bo te amade kirine.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <div
                v-for="(service, index) in services"
                :key="service.id"
                class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-yellow-500/40 transform hover:-translate-y-2 transition duration-500 flex flex-col"
                :style="{ 'transition-delay': `${index * 100}ms` }"
                v-animate-on-scroll
              >
                <img :src="service.image_url" :alt="service.name" class="w-full h-64 object-cover" />
                <div class="p-6 flex flex-col flex-grow">
                  <h3 class="text-2xl font-bold text-yellow-400 mb-2">{{ service.name }}</h3>
                  <p class="text-gray-300 mb-4 flex-grow">{{ service.description }}</p>
                  <span class="text-2xl font-bold mt-auto">${{ service.price }}</span>
                </div>
              </div>
            </div>
          </div>
      </section>
      
      <!-- Beşa Daşkandinê (RASTKIRÎ) -->
      <section 
        id="discounts"
        ref="parallaxSection"
        class="relative py-24 bg-gray-900 overflow-hidden"
        :style="{ 
          '--parallax-offset': parallaxOffset + 'px', 
          '--parallax-bg-url': `url(${parallaxImageUrl})` 
        }"
      >
        <div class="parallax-bg"></div>
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="relative container mx-auto px-6 text-center z-10" v-animate-on-scroll>
          <h2 class="text-4xl font-extrabold mb-4">ئۆفەرێن <span class="text-yellow-400">تایبەت</span> ببینە</h2>
          <p class="text-gray-200 text-xl mb-8">
            مە هەمیشە داشکاندن و پاکێجێن bêhempa ji bo we hene.
          </p>
          <div class="bg-gray-900/50 backdrop-blur-sm max-w-md mx-auto p-8 rounded-2xl border border-yellow-500/30">
            <p class="text-2xl text-gray-300 mb-2">داشکاندنا حەفتیێ</p>
            <p class="text-7xl font-bold text-yellow-400 mb-6">25%</p>
            <Link :href="route('offers')" class="bg-yellow-400 text-gray-900 font-bold py-3 px-10 rounded-full text-lg shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition">
              هەمی ئۆفەران ببینە
            </Link>
          </div>
        </div>
      </section>

      <!-- Beşa Pêşangehê (Galerî) -->
      <section id="gallery" class="py-24 bg-gray-900">
         <div class="container mx-auto px-6 text-center" v-animate-on-scroll>
            <h2 class="text-4xl font-extrabold mb-12">پێشانگەها کارێن مە</h2>
            <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
              <img
                v-for="(img, i) in galleryImages"
                :key="i"
                :src="img"
                class="w-full rounded-xl shadow-lg hover:scale-[1.03] transform transition duration-300"
                alt="Wêneyê karê me"
                v-animate-on-scroll
              />
            </div>
          </div>
      </section>

      <!-- Beşa Peywendî -->
      <section id="contact" class="py-24 bg-gray-800">
         <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center" v-animate-on-scroll>
            <!-- Form -->
            <div>
              <h2 class="text-4xl font-extrabold mb-6">پەیوەندیێ ب مە بکە</h2>
              <p class="text-gray-300 mb-8">
                Bۆ her pirsyarekê yan ḧiczkirinê, fۆrmê tijî bike yan peywendiyê bi jmara me bike.
              </p>
              <form class="space-y-6">
                <input type="text" placeholder="Navê te yê temam" class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition" />
                <input type="email" placeholder="Îmêlê te" class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition" />
                <textarea rows="5" placeholder="Nama xo l vîrê binvîse..." class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition"></textarea>
                <button type="submit" class="bg-yellow-400 text-gray-900 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition">
                  Namê bihnêre
                </button>
              </form>
            </div>
            <!-- Nexşe -->
            <div class="rounded-xl overflow-hidden shadow-lg h-[450px]">
              <iframe src="https://maps.google.com/maps?q=Zakho%20Iraq&t=&z=13&ieUTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
      </section>
    </main>
  </AppLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
// --- KODA NÛ: Wêneya Parallax li vir tê import kirin ---
import parallaxImageUrl from '@/assets/images/parallax-bg.jpg';

const isLoading = ref(true);
onMounted(() => {
  setTimeout(() => {
    isLoading.value = false;
  }, 2000);
});

// --- Koda Parallax ---
const parallaxSection = ref(null);
const parallaxOffset = ref(0);
const PARALLAX_SPEED = 0.3;

const handleParallaxScroll = () => {
  if (parallaxSection.value) {
    const rect = parallaxSection.value.getBoundingClientRect();
    if (rect.bottom >= 0 && rect.top <= window.innerHeight) {
      parallaxOffset.value = rect.top * PARALLAX_SPEED;
    }
  }
};

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
      },
      { threshold: 0.1 }
    );
    observer.observe(el);
  },
};

const heroImages = [
  "https://images.pexels.com/photos/897262/pexels-photo-897262.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/2061820/pexels-photo-2061820.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/897271/pexels-photo-897271.jpeg?auto=compress&cs=tinysrgb&w=1600",
];
const currentHero = ref(0);

const services = [
  { id: 1, name: "سەرتاشین و ستایل", description: "Sertraşîn û şûştin bi şêwazên nûjen, li gorî daxwaza te.", price: 15, image_url: "https://istanbulvacationtips.com/wp-content/uploads/2019/10/what-to-expect-turkish-hamam-istanbul-vacation-tips.jpg" },
  { id: 2, name: "مەساجا ئارامکرنێ", description: "Mesajeka profesyonel ji bo pişta te û milên te, ji bo rehetîyeke bêhempa.", price: 40, image_url: "https://manvsclock.com/wp-content/uploads/Turkish-bath-male-experience-1.jpg" },
  { id: 3, name: "پاککرنا دەموچاڤا", description: "Paqijkirina kûr a çermê rûyê te û rakirina xalên reş ji bo rûyekî geş.", price: 15, image_url: "https://images.pexels.com/photos/3985361/pexels-photo-3985361.jpeg?auto=compress&cs=tinysrgb&w=800" },
  { id: 4, name: "پاکێجا شاهانە یا زاڤای", description: "Hemû tiştên ku zava hewce dike! Ji sertraşînê bigire heta lênêrîna rû û masajê.", price: 150, image_url: "https://assets.usestyle.ai/496fa622-49b8-468b-b870-a80307da1859" },
  { id: 5, name: "شۆشتنا ترۆمبێلێ", description: "Paqijkirina hundir û derveyê trimbêla te bi awayekî profesyonel û bi baldarî.", price: 20, image_url: "https://images.pexels.com/photos/6870322/pexels-photo-6870322.jpeg?auto=compress&cs=tinysrgb&w=800" },
  { id: 6, name: "خەملاندنا ترۆمبێلا زاڤای", description: "Xemlandina trimbêla bûk û zava bi şêwazên herî nû û li gorî daxwaza te.", price: 100, image_url: "https://images.pexels.com/photos/3050703/pexels-photo-3050703.jpeg?auto=compress&cs=tinysrgb&w=800" }
];

const galleryImages = [
  "https://images.pexels.com/photos/2076930/pexels-photo-2076930.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/1805600/pexels-photo-1805600.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/2076931/pexels-photo-2076931.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/897271/pexels-photo-897271.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/2076932/pexels-photo-2076932.jpeg?auto=compress&cs=tinysrgb&w=800",
];

onMounted(() => {
  window.addEventListener("scroll", handleParallaxScroll);
  
  const heroInterval = setInterval(() => {
    currentHero.value = (currentHero.value + 1) % heroImages.length;
  }, 5000);

  onUnmounted(() => {
    window.removeEventListener("scroll", handleParallaxScroll);
    clearInterval(heroInterval);
  });
});
</script>

<style>
/* ... Stîlên din ên CSS wek berê dimînin ... */

/* --- STÎLÊN NÛ: Guherbara CSS ji bo Parallax tê bikaranîn --- */
.parallax-bg {
  position: absolute;
  left: -10%;
  top: -20%;
  width: 120%;
  height: 140%;
  z-index: -1;
  background-image: var(--parallax-bg-url); /* Wêne ji guherbara CSS tê */
  background-size: cover;
  background-position: center;
  transform: translateY(var(--parallax-offset));
  transition: transform 0.1s linear;
}
</style>
