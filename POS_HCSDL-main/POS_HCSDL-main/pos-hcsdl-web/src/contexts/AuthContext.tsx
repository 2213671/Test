import {
  createContext,
  type PropsWithChildren,
  useContext,
  useEffect,
  useRef,
  useState,
} from 'react';
import {
  type CurrentUserZodType,
  type LoginRequestZodType,
  useGetCurrentUser,
  useLogin,
} from '@/api/pos';
import { useQueryClient } from '@tanstack/react-query';

type AuthContextType = {
  user: CurrentUserZodType | null;
  isAuthenticated: boolean;
  isLoadingAuth?: boolean;
  isLoadingLogin?: boolean;
  login: (loginData: LoginRequestZodType) => Promise<void>;
  logout: () => Promise<void>;
};

const AuthContext = createContext<AuthContextType | undefined>(undefined);

const AuthProvider = ({ children }: PropsWithChildren) => {
  const {mutateAsync: handleLogin, error: errorLogin} = useLogin();
  const { refetch, error: errorCurrentUser} = useGetCurrentUser({
      query: {
          enabled: false
      }
  });
  const queryClient = useQueryClient();
  const [user, setUser] = useState<CurrentUserZodType | null>(null);
  const [isLoadingAuth, setIsLoadingAuth] = useState(true);
  const [isLoadingLogin, setIsLoadingLogin] = useState(false);
  const [isAuthenticated, setIsAuthenticated] = useState(false);

  const refreshUser = async () => {
    try {
        setIsLoadingAuth(true);
    const {data: current} = await refetch();
      console.log(current);
    if (current) {
        setUser(current);
        setIsAuthenticated(true)
        setIsLoadingLogin(false);
    }

    } catch (error) {
        console.log(errorCurrentUser?.response?.data)
    } finally {
        setIsLoadingAuth(false);
    }
  };

  const initRef = useRef(false);

  useEffect(() => {
    if (!initRef.current) {
      initRef.current = true;
      refreshUser().then();
    }
  }, []);
  
  const login = async (loginData: LoginRequestZodType) => {
      try {

          setIsLoadingLogin(true)
          await handleLogin({data: loginData});
          await refreshUser();
          setIsAuthenticated(true);
      } catch (error) {
          console.log(errorLogin?.response?.data)
      } finally {
          setIsLoadingLogin(false);
      }
  }
  

  const logout = async () => {

    document.cookie = "accessToken=; Max-Age=0; path=/; domain=localhost; SameSite=Lax";
    document.cookie = "refreshToken=; Max-Age=0; path=/; domain=localhost; SameSite=Lax";
    document.cookie = "sub=; Max-Age=0; path=/; domain=localhost; SameSite=Lax";

    localStorage.removeItem('restaurant');
    queryClient.clear();

    setUser(null);
    setIsAuthenticated(false);
  };

  const authValue: AuthContextType = {
    user,
    isAuthenticated,
    isLoadingAuth,
    isLoadingLogin,
    login,
    logout,
  };

  return <AuthContext value={authValue}>{children}</AuthContext>;
};

const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};

// eslint-disable-next-line react-refresh/only-export-components
export { AuthProvider, useAuth };
