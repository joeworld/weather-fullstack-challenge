import { ref, reactive, computed } from "vue";
import { defineStore } from "pinia";
import type { UserWeatherReport, LoadingState, UsersList } from "@/types";

const url = import.meta.env.VITE_API_URL || "http://localhost";

// Define store
export const useWeatherStore = defineStore("weatherReport", () => {
    // STATE
    const users = ref<UsersList[]>([]);
    const data = ref<UserWeatherReport | null>(null);
    const dailyReports = ref<UserWeatherReport | null>(null);
    const isFetching: LoadingState = reactive({
        user: false,
        daily: false,
    });

    // GETTERS
    const getUsers = computed<UsersList[]>(() => users.value);
    const getUserReport = computed<UserWeatherReport | null>(() => data.value);
    const getDailyReport = computed<UserWeatherReport | null>(
        () => dailyReports.value
    );

    // ACTIONS

    async function fetchData() {
        const url = import.meta.env.VITE_API_URL || "http://localhost";
        const data = await (await fetch(`${url}/users`)).json();
        users.value = data.data;
    }

    // Get user details
    async function getUserDetails(id: number) {
        isFetching.user = true;
        const response = await fetch(`${url}/users/${id}`);
        if (response.ok) {
            isFetching.user = false;
            const result = await response.json();
            data.value = result.data;
        } else {
            isFetching.user = false;
            data.value = null;
        }
    }

    // Get daily weather reports

    async function getDailyWeatherReports(id: number) {
        isFetching.daily = true;
        const response = await fetch(`${url}/users/${id}/all-days`);
        if (response.ok) {
            isFetching.daily = false;
            const result = await response.json();
            dailyReports.value = result.data;
        } else {
            isFetching.daily = false;
            dailyReports.value = null;
        }
    }

    return {
        data,
        dailyReports,
        getUsers,
        getUserReport,
        getDailyReport,
        isFetching,
        fetchData,
        getUserDetails,
        getDailyWeatherReports,
    };
});
