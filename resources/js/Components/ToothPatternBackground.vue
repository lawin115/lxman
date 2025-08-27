<script setup>
/**
 * Reusable background pattern (tooth).
 * - Unique pattern id per instance to avoid collisions
 * - Customizable via props
 * NOTE: If you ever enable SSR, pass a fixed :id to avoid hydration mismatch.
 */
const props = defineProps({
  id: { type: String, default: null },
  size: { type: Number, default: 120 },
  translateX: { type: Number, default: 20 },
  translateY: { type: Number, default: 12 },
  strokeClass: { type: String, default: 'text-indigo-300 dark:text-indigo-800' },
  dotFillClass: { type: String, default: 'fill-teal-300/70 dark:fill-teal-800/70' },
});

/* generate a stable id per instance (ok for CSR apps) */
const patternId = props.id ?? `toothPattern-${Math.random().toString(36).slice(2)}`;
</script>

<template>
  <div class="pointer-events-none absolute inset-0 -z-10 h-full w-full overflow-hidden">
    <!-- Rengê bingehîn ê gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-sky-50 to-teal-50 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950"></div>

    <!-- Nîgara diranan (SVG Pattern) -->
    <svg class="absolute inset-0 h-full w-full opacity-20 dark:opacity-10" aria-hidden="true">
      <defs>
        <pattern :id="patternId" :width="size" :height="size" patternUnits="userSpaceOnUse">
          <g :transform="`translate(${translateX},${translateY})`">
            <path d="M40 10c8 0 18 6 18 20 0 16-10 20-14 32-2 6-8 6-10 0-4-12-14-16-14-32 0-14 10-20 20-20z"
                  fill="none" stroke="currentColor" stroke-width="1.2" 
                  :class="strokeClass" />
            <circle cx="45" cy="24" r="2" :class="dotFillClass" />
          </g>
        </pattern>
      </defs>
      <rect width="100%" height="100%" :fill="`url(#${patternId})`"></rect>
    </svg>

    <!-- Blobên nerm -->
    <div class="absolute -top-24 -left-24 h-[34rem] w-[34rem] rounded-full bg-teal-300/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 h-[34rem] w-[34rem] rounded-full bg-indigo-300/20 blur-3xl"></div>
  </div>
</template>