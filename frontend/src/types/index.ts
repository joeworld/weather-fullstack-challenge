export type WeatherData = {
    day: string;
    lat: number;
    lon: number;
    timezone: string;
    temp: number;
    feels_like: number;
    pressure: number;
    clouds: number;
    visibility: number;
    wind_speed: number;
    wind_deg: number;
    weather: {
        icon: string;
        url: string;
        main: string;
        description: string;
    };
};

export type WeatherForAllDays = {
    monday: WeatherData;
    tuesday: WeatherData;
    wednesday: WeatherData;
    thursday: WeatherData;
    friday: WeatherData;
    saturday: WeatherData;
    sunday: WeatherData;
};

export interface UsersList {
    id: number;
    name: string;
    email: string;
    lat: string;
    lon: string;
    weather: null;
    weather_for_all_days: null;
    created_at: string;
    updated_at: string;
}

export interface UserWeatherReport {
    id: number;
    name: string;
    email: string;
    lat: string;
    lon: string;
    weather: WeatherData;
    weather_for_all_days: WeatherForAllDays;
    created_at: string;
    updated_at: string;
}

export interface LoadingState {
    user: boolean;
    daily: boolean;
}
