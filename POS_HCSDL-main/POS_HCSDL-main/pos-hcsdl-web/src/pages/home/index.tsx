import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '@/contexts/AuthContext.tsx';
import { paths } from '@/router/nav.tsx';

const Home = () => {
  const naviagte = useNavigate();
  const { user } = useAuth();
  useEffect(() => {
    naviagte(user?.roleName !== 'ADMIN' ? paths.tableOrder : paths.orderManage, { replace: true });
  }, []);
  return null;
};

export default Home;
