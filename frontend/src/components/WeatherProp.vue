<script lang="ts" setup>
    defineProps<{
        icon: string;
        title: string;
        value: string;
    }>();
</script>

<template>
    <div
            class="w-full flex items-center justify-between border-b py-2.5 border-gray-100"
    >
        <div class="flex items-center sm:gap-2">
            <div>
                <font-awesome-icon :icon="`fa-solid ${icon}`" />
            </div>
            <p class="truncate text-sm font-medium">{{ title }}</p>
        </div>
        <div class="">
            <p class="text-sm text-gray-900">{{ value }}</p>
        </div>
    </div>
</template>
