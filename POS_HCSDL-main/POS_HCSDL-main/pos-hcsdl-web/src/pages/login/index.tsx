import { useAuth } from '@/contexts/AuthContext.tsx';
import { useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';
import { paths } from '@/router/nav.tsx';

const Login = () => {
  const { login, isAuthenticated, isLoadingAuth } = useAuth();
  const navigate = useNavigate();

  const [username, setUsername] = useState('hoanphat');
  const [password, setPassword] = useState('123123');

  useEffect(() => {
    if (!isLoadingAuth && isAuthenticated) {
      navigate(paths.home, { replace: true });
    }
  }, [isLoadingAuth, isAuthenticated, navigate]);

  const handleLogin = () => {
    login({ username, password });
  };

  return (
    <div className="flex h-screen w-full items-center justify-center bg-indigo-50">
      <div className="w-full max-w-md rounded-2xl border border-indigo-100 bg-white p-8 shadow-xl">
        <h2 className="mb-6 text-center text-3xl font-bold text-indigo-700">POS DBS</h2>
        <p className="mb-6 text-center text-gray-500">Login to your account</p>

        <div className="mb-4">
          <label className="mb-2 block text-sm font-medium text-indigo-700">Username</label>
          <input
            type="text"
            value={username}
            onChange={e => setUsername(e.target.value)}
            className="w-full rounded-xl border border-indigo-200 px-4 py-2 text-gray-800 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 focus:outline-none"
          />
        </div>

        <div className="mb-6">
          <label className="mb-2 block text-sm font-medium text-indigo-700">Password</label>
          <input
            type="password"
            value={password}
            onChange={e => setPassword(e.target.value)}
            className="w-full rounded-xl border border-indigo-200 px-4 py-2 text-gray-800 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 focus:outline-none"
          />
        </div>

        <button
          onClick={handleLogin}
          className="w-full rounded-xl bg-indigo-600 py-3 font-medium text-white shadow-md transition hover:bg-indigo-700"
        >
          {isLoadingAuth ? 'Loading...' : 'Login'}
        </button>

        <div className="mt-6 text-center">
          <p className="text-sm text-gray-500">
            Powered by <span className="font-semibold text-indigo-600">DBS POS</span>
          </p>
        </div>
      </div>
    </div>
  );
};

export default Login;
