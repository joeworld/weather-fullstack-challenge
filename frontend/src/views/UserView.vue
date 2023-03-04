<script lang="ts" setup>
    import { ref, reactive, onMounted } from "vue";
    import User from "@/components/UserDetails.vue";
    import { storeToRefs } from "pinia";
    import { useWeatherStore } from "@/stores/weather";

    const props = defineProps<{
        id: number;
    }>();

    const store = useWeatherStore();
    // getters, destructed to retain reactivity
    const { getUserReport, getDailyReport, isFetching } = storeToRefs(store);
    // methods to call api
    const { getUserDetails, getDailyWeatherReports } = store;

    const mock_data = {
        id: 1,
        name: "Cassie Wisozk MD",
        email: "gzboncak@example.net",
        lat: "82.33844100",
        lon: "-24.04495400",
        weather: {
            day: "03, Mar",
            lat: 82.3384,
            lon: -24.045,
            temp: 237.22,
            feels_like: 230.22,
            pressure: 1030,
            clouds: 7,
            visibility: 10000,
            wind_speed: 3.32,
            wind_deg: 293,
            weather: {
                icon: "01n",
                url: "https://openweathermap.org/img/wn/01n@2x.png",
                main: "Clear",
                description: "clear sky",
            },
        },
        weather_for_all_days: null,
        created_at: "2023-03-03T05:27:59.000000Z",
        updated_at: "2023-03-03T05:27:59.000000Z",
    };

    const mock_dailyreports = {
        id: 1,
        name: "Cassie Wisozk MD",
        email: "gzboncak@example.net",
        lat: "82.33844100",
        lon: "-24.04495400",
        weather: null,
        weather_for_all_days: {
            monday: {
                day: "27, Feb",
                lat: 82.3384,
                lon: -24.045,
                temp: 252.79,
                feels_like: 245.79,
                pressure: 993,
                clouds: 99,
                visibility: 10000,
                wind_speed: 11.02,
                wind_deg: 288,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "overcast clouds",
                },
            },
            tuesday: {
                day: "28, Feb",
                lat: 82.3384,
                lon: -24.045,
                temp: 242.82,
                feels_like: 235.82,
                pressure: 1011,
                clouds: 100,
                visibility: 10000,
                wind_speed: 1.98,
                wind_deg: 317,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "overcast clouds",
                },
            },
            wednesday: {
                day: "01, Mar",
                lat: 82.3384,
                lon: -24.045,
                temp: 249.94,
                feels_like: 249.94,
                pressure: 996,
                clouds: 92,
                visibility: 10000,
                wind_speed: 0.47,
                wind_deg: 42,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "overcast clouds",
                },
            },
            thursday: {
                day: "02, Mar",
                lat: 82.3384,
                lon: -24.045,
                temp: 243.66,
                feels_like: 243.66,
                pressure: 1016,
                clouds: 74,
                visibility: 5213,
                wind_speed: 0.94,
                wind_deg: 85,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "broken clouds",
                },
            },
            friday: {
                day: "03, Mar",
                lat: 82.3384,
                lon: -24.045,
                temp: 237.22,
                feels_like: 230.22,
                pressure: 1030,
                clouds: 7,
                visibility: 10000,
                wind_speed: 3.32,
                wind_deg: 293,
                weather: {
                    icon: "01n",
                    url: "https://openweathermap.org/img/wn/01n@2x.png",
                    main: "Clear",
                    description: "clear sky",
                },
            },
            saturday: {
                day: "04, Mar",
                lat: 82.3384,
                lon: -24.045,
                temp: 244.88,
                feels_like: 237.88,
                pressure: 1027,
                clouds: 69,
                visibility: 10000,
                wind_speed: 3.5,
                wind_deg: 285,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "broken clouds",
                },
            },
            sunday: {
                day: "05, Mar",
                lat: 82.3384,
                lon: -24.045,
                temp: 239.87,
                feels_like: 232.87,
                pressure: 1038,
                clouds: 84,
                visibility: 8854,
                wind_speed: 1.73,
                wind_deg: 307,
                weather: {
                    icon: "04n",
                    url: "https://openweathermap.org/img/wn/04n@2x.png",
                    main: "Clouds",
                    description: "broken clouds",
                },
            },
        },
        created_at: "2023-03-03T05:27:59.000000Z",
        updated_at: "2023-03-03T05:27:59.000000Z",
    };

    // call function when component mounts
    onMounted(() => {
        getUserDetails(props.id), getDailyWeatherReports(props.id);
    });
</script>

<template>
    <section class="w-full sm:max-w-6xl sm:mx-auto">
        <User
                :id="id"
                :user-report="getUserReport"
                :daily-report="getDailyReport"
                :loading="isFetching"
        />
    </section>
</template>
