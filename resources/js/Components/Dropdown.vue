<script setup>
import { ref, onMounted, onBeforeUnmount, computed, nextTick, watch } from 'vue'

const props = defineProps({
  align: { type: String, default: 'right' },           // left | right
  width: { type: [String, Number], default: '48' },    // 48 | 56 | 64 | 72 | 80 ...
  contentClasses: {
    type: [String, Array, Object],
    default: () => ['py-1','bg-white','dark:bg-gray-900','ring-1','ring-black/5','rounded-md','shadow-lg']
  },
  direction: { type: String, default: 'down' },        // down | up  (نوێ)
  autoFlip: { type: Boolean, default: true },          // نزیک بە کۆنەکان => سەرەوە پێکانەوە (نوێ)
})

const open = ref(false)
const wrapper = ref(null)
const panel = ref(null)
const actualDirection = ref(props.direction)

const widthClass = computed(() => ({
  '48':'w-48','56':'w-56','64':'w-64','72':'w-72','80':'w-80'
})[String(props.width)] ?? 'w-48')

const alignClass = computed(() => props.align === 'left' ? 'left-0' : 'right-0')

const dirClass = computed(() =>
  actualDirection.value === 'up'
    ? [ 'bottom-full','mb-2', props.align==='left' ? 'origin-bottom-left' : 'origin-bottom-right' ]
    : [ 'top-full','mt-2',    props.align==='left' ? 'origin-top-left'    : 'origin-top-right'  ]
)

function closeOnEscape(e){ if(e.key === 'Escape') open.value = false }
function closeOnOutside(e){ if (wrapper.value && !wrapper.value.contains(e.target)) open.value = false }

onMounted(() => { document.addEventListener('keydown', closeOnEscape); document.addEventListener('click', closeOnOutside) })
onBeforeUnmount(() => { document.removeEventListener('keydown', closeOnEscape); document.removeEventListener('click', closeOnOutside) })

watch(open, async (v) => {
  if (v && props.autoFlip) {
    await nextTick()
    const wr = wrapper.value?.getBoundingClientRect?.()
    const menuH = panel.value?.offsetHeight ?? 240
    if (wr) {
      const spaceBelow = window.innerHeight - wr.bottom
      const spaceAbove = wr.top
      actualDirection.value = (spaceBelow < menuH && spaceAbove > spaceBelow) ? 'up' : 'down'
    }
  } else {
    actualDirection.value = props.direction
  }
})
</script>

<template>
  <div class="relative" ref="wrapper">
    <div @click.stop="open = !open">
      <slot name="trigger" />
    </div>

    <!-- backdrop بۆ مۆبایل -->
    <div v-show="open" class="fixed inset-0 z-40 lg:hidden" @click="open=false"></div>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95">
      <div v-show="open" ref="panel" class="absolute z-50" :class="[alignClass, widthClass, dirClass]">
        <div :class="contentClasses">
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>
