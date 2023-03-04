<script lang="ts" setup>
    defineProps<{
        icon: string;
        day: string;
        desc: string;
        value?: string;
        temp?: number;
        feelsLike?: number;
    }>();

    const getAbbrev = (value: string) => {
        const day_abbrev = value.slice(0, 3).toLocaleUpperCase();

        return day_abbrev;
    };
</script>

<template>
    <li>
        <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center">
                <div
                        class="min-w-0 flex-1 px-4 md:grid md:grid-cols-6 md:justify-items-start md:place-items-center md:gap-4"
                >
                    <div class="">{{ getAbbrev(day) }}</div>

                    <div class="col-span-4 flex items-center sm:gap-2">
                        <div>
                            <img :src="icon" alt="cloudy-icon" class="w-10 h-10" />
                        </div>
                        <p class="truncate text-sm font-medium">
                            {{ desc }}
                        </p>
                    </div>

                    <div class="w-full text-right">
                        <p class="text-sm text-gray-900">{{ temp }}&deg;C</p>
                        <p class="text-sm text-gray-900">{{ feelsLike }} &deg;C</p>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>