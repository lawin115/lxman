<script setup>
import { ref, computed, watch } from 'vue'
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
  // items => [{ id, name }]
  items: { type: Array, required: true },
  modelValue: [Number, String, null], // v-model ji bo ID
  query: { type: String, default: '' },
})

const emit = defineEmits(['update:modelValue', 'update:query']);


const localQuery = ref(props.query || '')

const selectedItem = computed({
  get: () => props.items.find(i => i.id === props.selectedId) || null,
  set: (item) => {
    emit('update:selectedId', item ? item.id : null)
    localQuery.value = item ? item.name : ''
  }
})

watch(localQuery, (newQuery) => {
  const q = (newQuery ?? '').trim().toLowerCase()
  emit('update:query', newQuery)
  // ئەگەر ناو لە لیستدا نەبوو → selectedId=null بمێنێت، ناو بپارێزرە
  if (!props.items.some(i => (i.name ?? '').trim().toLowerCase() === q)) {
    emit('update:selectedId', null)
  }
})

let filteredItems = computed(() =>
  props.query === ''
    ? props.items
    : props.items.filter((item) =>
        item.name.toLowerCase().includes(props.query.toLowerCase())
      )
);
</script>

<template>
 <Combobox v-model="selectedItem">
    <div class="relative mt-1">
      <div class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md">
        <ComboboxInput
          class="w-full ..."
        :value="query"
        @change="$emit('update:query', $event.target.value)"
        @focus="$event.target.select()"
      />
        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </ComboboxButton>
      </div>

      <TransitionRoot
        leave="transition ease-in duration-100"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <ComboboxOptions
          class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
          <div
            v-if="filteredItems.length === 0 && localQuery"
            class="relative cursor-default select-none px-4 py-2 text-gray-700">
            Tu tişt nehate dîtin — dikarî wekî nexweşê nû تۆمار بکەیت.
          </div>

          <ComboboxOption
            v-for="item in filteredItems"
            :key="item.id"
            :value="item"
            v-slot="{ selected, active }"
          >
            <li
              class="relative cursor-default select-none py-2 pl-10 pr-4"
              :class="{ 'bg-teal-600 text-white': active, 'text-gray-900': !active }"
            >
              <span class="block truncate" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                {{ item.name }}
              </span>
              <span
                v-if="selected"
                class="absolute inset-y-0 left-0 flex items-center pl-3"
                :class="{ 'text-white': active, 'text-teal-600': !active }"
              >
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ComboboxOption>
        </ComboboxOptions>
      </TransitionRoot>
    </div>
  </Combobox>
</template>
