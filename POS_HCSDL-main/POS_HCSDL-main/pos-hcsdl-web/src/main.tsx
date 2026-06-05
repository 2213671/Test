import { createRoot } from 'react-dom/client';
import './index.css';
import App from './App.tsx';
import { AuthProvider } from '@/contexts/AuthContext.tsx';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { RestaurantProvider } from '@/contexts/RestaurantContext.tsx';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 0,
    },
    mutations: {
      retry: 0
    }
  },
});

createRoot(document.getElementById('root')!).render(
  // <StrictMode>
  <QueryClientProvider client={queryClient}>
    <AuthProvider>
      <RestaurantProvider>
        <App />
      </RestaurantProvider>
    </AuthProvider>
  </QueryClientProvider>
  // </StrictMode>
);
