<script lang="ts" setup>
    import type { UserWeatherReport, LoadingState } from "@/types";
    import Spinner from "@/components/Spinner.vue";
    import Avatar from "@/components/Avatar.vue";
    import WeatherProp from "@/components/WeatherProp.vue";
    import DailyReport from "@/components/DailyReport.vue";

    // takes in fetched data from the details page
    defineProps<{
        id: string | number;
        loading: LoadingState;
        userReport: UserWeatherReport | null;
        dailyReport?: UserWeatherReport | null;
    }>();

    const weatherProperties = [
        {
            title: "High / Low",
            value: "--/75",
            icon: "fa-temperature-low",
        },
        {
            title: "Wind",
            value: "10mph",
            icon: "fa-wind",
        },
        {
            title: "Humidity",
            value: "67",
            icon: "fa-droplet",
        },
        {
            title: "Dew Point",
            value: "78",
            icon: "fa-droplet",
        },
        {
            title: "Pressure",
            value: "29.87",
            icon: "fa-sort",
        },
        {
            title: "UV index",
            value: "2 of 10",
            icon: "fa-sun",
        },
    ];
</script>

<template>
    <div class="flex justify-center items-center py-3" v-if="loading.user">
        <Spinner />
    </div>
    <div
            v-if="!userReport && !loading.user"
            class="shadow-lg rounded-md flex justify-center items-center py-3"
    >
        <p class="py-3 px-2 text-sm text-gray-700">
            Cannot load user's report. Kindly retry in a few sec
        </p>
    </div>

    <div v-if="!loading.user && userReport" class="shadow-lg rounded-md">
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
            <div
                    class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap"
            >
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <Avatar :initials="userReport?.name" />
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">
                                {{ userReport?.name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                <a href="#">{{ userReport?.email }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-2 py-8">
                <div class="flex items-center">
                    <div>
                        <h2 class="text-5xl font-semibold leading-relaxed">{{ userReport?.weather?.temp }}&deg;C</h2>
                        <p class="text-gray-800">Feels like {{ userReport?.weather?.feels_like }}&deg;C</p>
                    </div>

                    <div class="mx-4">
            <span class="inline-block">
              {{ userReport?.weather?.weather?.description?.toUpperCase() }}
            </span>
                        <h5 class="font-semibold">{{ userReport?.weather?.timezone }}</h5>
                    </div>
                </div>
                <div>
                    <img
                            :src="userReport?.weather.weather.url"
                            :alt="userReport?.weather.weather.description"
                            class="w-20 h-20"
                    />
                </div>
            </div>

            <div class="w-full">
                <div class="flex items-center py-2">
                    <div
                            class="flex-1 px-4 md:grid md:grid-cols-2 md:justify-items-start md:place-items-center md:gap-x-8"
                    >
                        <WeatherProp
                                icon="fa-temperature-low"
                                title="Temperature"
                                :value="`${userReport?.weather.temp}`"
                        />
                        <WeatherProp
                                icon="fa-wind"
                                title="Wind"
                                :value="`${userReport?.weather.wind_speed}`"
                        />
                        <WeatherProp
                                icon="fa-sort"
                                title="Pressure"
                                :value="`${userReport?.weather.pressure}`"
                        />
                        <WeatherProp
                                icon="fa-eye"
                                title="Visibility"
                                :value="`${userReport?.weather.visibility}`"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- future forecasts -->
    <div class="sm:mt-8 space-y-6">
        <div class="flex">
            <h1 class="text-xl font-semibold leading-6 text-gray-900">
                Daily Forecast
            </h1>
        </div>
        <div class="shadow-lg rounded-md">
            <div class="flex justify-center items-center py-3" v-if="loading.daily">
                <Spinner />
            </div>
            <div
                    v-if="!loading.daily && !dailyReport"
                    class="shadow-lg rounded-md flex justify-center items-center py-3"
            >
                <p class="py-3 px-2 text-sm text-gray-700">
                    Unable to load daily forecast. Kindly retry in a few sec
                </p>
            </div>

            <ul
                    role="list"
                    v-if="!loading.daily && dailyReport"
                    class="divide-y divide-gray-200"
            >
                <DailyReport
                        day="monday"
                        :desc="dailyReport?.weather_for_all_days?.monday.weather.description"
                        :icon="dailyReport?.weather_for_all_days?.monday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.monday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.monday.feels_like"
                />
                <DailyReport
                        day="tuesday"
                        :desc="dailyReport?.weather_for_all_days?.tuesday.weather.description"
                        :icon="dailyReport?.weather_for_all_days?.tuesday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.tuesday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.tuesday.feels_like"
                />
                <DailyReport
                        day="wednesday"
                        :desc="
            dailyReport?.weather_for_all_days?.wednesday.weather.description
          "
                        :icon="dailyReport?.weather_for_all_days?.wednesday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.wednesday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.wednesday.feels_like"
                />
                <DailyReport
                        day="thursday"
                        :desc="
            dailyReport?.weather_for_all_days?.thursday.weather.description
          "
                        :icon="dailyReport?.weather_for_all_days?.thursday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.thursday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.thursday.feels_like"
                />
                <DailyReport
                        day="friday"
                        :desc="dailyReport?.weather_for_all_days?.friday.weather.description"
                        :icon="dailyReport?.weather_for_all_days?.friday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.friday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.friday.feels_like"
                />
                <DailyReport
                        day="saturday"
                        :desc="
            dailyReport?.weather_for_all_days?.saturday.weather.description
          "
                        :icon="dailyReport?.weather_for_all_days?.saturday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.saturday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.saturday.feels_like"
                />
                <DailyReport
                        day="sunday"
                        :desc="dailyReport?.weather_for_all_days?.sunday.weather.description"
                        :icon="dailyReport?.weather_for_all_days?.sunday.weather.url"
                        :temp="dailyReport?.weather_for_all_days?.sunday.temp"
                        :feels-like="dailyReport?.weather_for_all_days?.sunday.feels_like"
                />
            </ul>
        </div>
    </div>
</template>
