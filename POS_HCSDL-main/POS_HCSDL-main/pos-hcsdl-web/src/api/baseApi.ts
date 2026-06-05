import axios from 'axios';

const BASE_URL = 'http://localhost:9001';

const api = axios.create({
  baseURL: BASE_URL,
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
  timeout: 1000 * 60,
});

export { api };
