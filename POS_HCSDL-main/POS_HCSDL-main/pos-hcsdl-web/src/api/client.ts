import axios, { type InternalAxiosRequestConfig } from 'axios';
import { api } from '@/api/baseApi.ts';
import type { RestaurantResponseZodType } from '@/api/pos';

api.interceptors.request.use(async (config: InternalAxiosRequestConfig) => {
  const restaurant: RestaurantResponseZodType = JSON.parse(localStorage.getItem('restaurant')!);
  if (restaurant) {
    config.headers['X-Restaurant-Id'] = restaurant.id;
  }
  return config;
});

api.interceptors.response.use(
  response => response,
  async err => {
    if (err?.response?.status === 401) {
      await axios.post('/auth/refresh');
    }
    return Promise.reject(err);
  }
);

export { api as http };
