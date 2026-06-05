import { type PropsWithChildren, useEffect } from 'react';
import { useAuth } from '@/contexts/AuthContext.tsx';
import { useNavigate } from 'react-router-dom';
import { paths } from '@/router/nav.tsx';

export const ProtectedRouter = ({ children }: PropsWithChildren) => {
  const navigate = useNavigate();
  const { isAuthenticated, isLoadingAuth } = useAuth();
  useEffect(() => {
    if (!isLoadingAuth && !isAuthenticated) {
      navigate(paths.login, { replace: true });
    }
  }, [isAuthenticated, isLoadingAuth]);

  if (isLoadingAuth) return <div>Loading...</div>;

  return children;
};
