<template>
  <AppLayout title="سەرەکی">
    <!-- Preloader -->
    <Transition name="fade">
      <div
        v-if="isLoading"
        class="fixed inset-0 bg-gray-900 z-[100] flex items-center justify-center"
      >
        <h1
          class="text-5xl font-extrabold bg-gradient-to-r from-yellow-400 to-yellow-200 text-transparent bg-clip-text tracking-wide animate-pulse"
        >
          LXMAN
        </h1>
      </div>
    </Transition>

    <main>
      <!-- Hero Section -->
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
          <p
            class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto mb-8 animate-on-load delay-1"
          >
            ئێمە ل ڤێرێ نە دا کو باشترین خزمەتگوزاریێن سەرتراشین، ڕێکخستنا ڕهـ و
            گرنگیدان ب ستایلێ تە پێشکێش بکەین.
          </p>
          <a
            href="#services"
            class="bg-yellow-400 text-gray-900 font-bold py-3 px-10 rounded-full text-lg shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition animate-on-load delay-2"
          >
            خزمەتێن مە ببینە
          </a>
        </div>
      </section>

      <!-- Services -->
      <section id="services" class="py-24 bg-gray-800">
        <div class="container mx-auto px-6 text-center" v-animate-on-scroll>
          <h2 class="text-4xl font-extrabold mb-4">خزمەتگوزاریێن شاهانە</h2>
          <p class="text-gray-300 max-w-2xl mx-auto mb-12">
            ژ سەرتاشینێ بگرە هەتا ئارامکرنا گیانێ تە، مە هەمی تشت بۆ تە ئامادە کرینە.
          </p>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
              v-for="(service, index) in services"
              :key="service.id"
              class="bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-yellow-500/40 transform hover:-translate-y-2 transition duration-500 flex flex-col"
              :style="{ 'transition-delay': `${index * 100}ms` }"
              v-animate-on-scroll
            >
              <img
                :src="service.image_url"
                :alt="service.name"
                class="w-full h-64 object-cover"
              />
              <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-2xl font-bold text-yellow-400 mb-2">
                  {{ service.name }}
                </h3>
                <p class="text-gray-300 mb-4 flex-grow">
                  {{ service.description }}
                </p>
                <span class="text-2xl font-bold mt-auto">${{ service.price }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Discounts (Parallax) -->
      <section
        id="discounts"
        ref="parallaxSection"
        class="relative py-24 bg-gray-900 overflow-hidden"
        :style="{ '--parallax-offset': parallaxOffset + 'px' }"
      >
        <div class="parallax-bg"></div>
        <div class="absolute inset-0 bg-black/80"></div>

        <div
          class="relative container mx-auto px-6 text-center z-10"
          v-animate-on-scroll
        >
          <h2 class="text-4xl font-extrabold mb-4">
            ئۆفەرا <span class="text-yellow-400">تایبەت</span> ببینە
          </h2>
          <p class="text-gray-200 text-xl mb-8">
            مە هەمیشە داشکاندن و پاکێجێن تایبەتی بۆ تۆ ئامادە دەکەین.
          </p>
          <div
            class="bg-gray-900/50 backdrop-blur-sm max-w-md mx-auto p-8 rounded-2xl border border-yellow-500/30"
          >
            <p class="text-2xl text-gray-300 mb-2">داشکاندنا حەفتیێ</p>
            <p class="text-7xl font-bold text-yellow-400 mb-6">25%</p>
            <Link
              :href="route('offers')"
              class="bg-yellow-400 text-gray-900 font-bold py-3 px-10 rounded-full text-lg shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition"
            >
              هەمی ئۆفەران ببینە
            </Link>
          </div>
        </div>
      </section>

      <!-- Gallery -->
      <section id="gallery" class="py-24 bg-gray-900">
        <div class="container mx-auto px-6 text-center" v-animate-on-scroll>
          <h2 class="text-4xl font-extrabold mb-12">پێشانگەها کارێن مە</h2>
          <div
            class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6"
          >
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

      <!-- Contact -->
      <section id="contact" class="py-24 bg-gray-800">
        <div
          class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center"
          v-animate-on-scroll
        >
          <div>
            <h2 class="text-4xl font-extrabold mb-6">پەیوەندیێ ب مە بکە</h2>
            <p class="text-gray-300 mb-8">
              بۆ هەر پرسیارەکێ یان حجزکرنێ، فۆڕمێ تژی بکە یان پەیوەندیێ ب ژمارا مە
              بکە.
            </p>
            <form class="space-y-6">
              <input
                type="text"
                placeholder="ناڤێ تە یێ تەمام"
                class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition"
              />
              <input
                type="email"
                placeholder="ئیمێلێ تە"
                class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition"
              />
              <input
                type="tel"
                placeholder="ژمارەی تەلەفۆن"
                class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition"
              />
              <textarea
                rows="5"
                placeholder="ناما خۆ ل ڤێرێ بنڤیسە..."
                class="w-full px-4 py-3 rounded-lg bg-gray-900 border border-gray-700 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition"
              ></textarea>
              <button
                type="submit"
                class="bg-yellow-400 text-gray-900 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-yellow-300 hover:scale-105 transform transition"
              >
                نامێ بهنێرە
              </button>
            </form>
          </div>
          <div class="rounded-xl overflow-hidden shadow-lg h-[450px]">
            <iframe
              src="https://maps.google.com/maps?q=Zakho%20Iraq&t=&z=13&ieUTF8&iwloc=&output=embed"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </section>
    </main>
  </AppLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const isLoading = ref(true);
onMounted(() => {
  setTimeout(() => {
    isLoading.value = false;
  }, 2000);
});

// Parallax
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

// Animate on scroll
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

// Hero
const heroImages = [
  "https://images.pexels.com/photos/897262/pexels-photo-897262.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/2061820/pexels-photo-2061820.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/897271/pexels-photo-897271.jpeg?auto=compress&cs=tinysrgb&w=1600",
];
const currentHero = ref(0);

// Services
const services = [
  {
    id: 1,
    name: "سەرتاشین و ستایل",
    description: "Sertraşîn û şûştin bi şêwazên nûjen, li gorî daxwaza te.",
    price: 15,
    image_url:
      "https://istanbulvacationtips.com/wp-content/uploads/2019/10/what-to-expect-turkish-hamam-istanbul-vacation-tips.jpg",
  },
  {
    id: 2,
    name: "مەساجا ئارامکرنێ",
    description: "Mesajeka profesyonel ji bo pişta te û milên te.",
    price: 40,
    image_url:
      "https://manvsclock.com/wp-content/uploads/Turkish-bath-male-experience-1.jpg",
  },
  {
    id: 3,
    name: "پاککرنا دەموچاڤا",
    description: "Paqijkirina çermê rûyê û rakirina xalên reş.",
    price: 15,
    image_url:
      "https://images.pexels.com/photos/3985361/pexels-photo-3985361.jpeg?auto=compress&cs=tinysrgb&w=800",
  },
];

// Gallery
const galleryImages = [
  "https://images.pexels.com/photos/2076930/pexels-photo-2076930.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/1805600/pexels-photo-1805600.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/2076931/pexels-photo-2076931.jpeg?auto=compress&cs=tinysrgb&w=800",
  "https://images.pexels.com/photos/897271/pexels-photo-897271.jpeg?auto=compress&cs=tinysrgb&w=800",
];
</script>

<style>
/* Preloader */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Animate on scroll */
[v-animate-on-scroll] {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}
[v-animate-on-scroll].is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Hero text */
.animate-on-load {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeIn-up 1s ease-out forwards;
}
.animate-on-load.delay-1 {
  animation-delay: 0.3s;
}
.animate-on-load.delay-2 {
  animation-delay: 0.6s;
}
@keyframes fadeIn-up {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Parallax */
.parallax-bg {
  position: absolute;
  left: -10%;
  top: -20%;
  width: 120%;
  height: 140%;
  z-index: -1;
  background-image: url("https://images.pexels.com/photos/3998414/pexels-photo-3998414.jpeg?auto=compress&cs=tinysrgb&w=1600");
  background-size: cover;
  background-position: center;
  transform: translateY(var(--parallax-offset));
  transition: transform 0.1s linear;
}
</style>
