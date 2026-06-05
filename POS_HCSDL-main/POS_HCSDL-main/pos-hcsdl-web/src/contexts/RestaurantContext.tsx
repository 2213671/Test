import {
  createContext,
  type Dispatch,
  type PropsWithChildren,
  type SetStateAction,
  useContext,
  useEffect,
  useState,
} from 'react';
import {
  type CurrentShiftZodType,
  type RestaurantResponseZodType,
  type RestaurantSelectZodType,
  useCurrentShift,
  useGetRestaurantById,
} from '@/api/pos';
import { useAuth } from '@/contexts/AuthContext.tsx';

interface RestaurantContextType {
  restaurant: RestaurantResponseZodType | null;
  shift: CurrentShiftZodType | null;
  setShift: Dispatch<SetStateAction<CurrentShiftZodType | null>>;
  reloadShift: () => void;
  handleSelectRestaurant: (res: RestaurantResponseZodType) => void;
}

const RestaurantContext = createContext<RestaurantContextType | undefined>(undefined);

const RestaurantProvider = ({ children }: PropsWithChildren) => {
  const [restaurantList,setRestaurantList] = useState<RestaurantSelectZodType[]>([])
  const [restaurant, setRestaurant] = useState<RestaurantResponseZodType | null>(null);
  const [shift, setShift] = useState<CurrentShiftZodType | null>(null);
  const { user } = useAuth();

  const { data, refetch: reloadRestaurant } = useGetRestaurantById(user?.restaurantId as string, {
    query: {
      enabled: !!user?.restaurantId && user?.roleName !== 'ADMIN',
    },
  });

  const { data: currentShift, refetch } = useCurrentShift({
    query: {
      enabled: !!restaurant && user?.roleName !== 'ADMIN' && !!user,
    },
  });

  useEffect(() => {
    if (currentShift) {
      setShift(currentShift);
    }
  }, [currentShift]);

  useEffect(() => {
    if (restaurant && user?.roleName !== 'ADMIN' && !!user) {
      console.log('vao day');
      refetch();
    }
  }, [restaurant, user]);

  useEffect(() => {
    if (user && user.roleName !== 'ADMIN' && user) {
      reloadRestaurant();
    } else {
      setRestaurant(null);
      setShift(null);
    }
  }, [user]);

  const handleSelectRestaurant = (res : RestaurantResponseZodType) => {
    setRestaurant(res);
    localStorage.setItem('restaurant', JSON.stringify(res));
  }

  useEffect(() => {
    if (data) {
      handleSelectRestaurant(data)
    }
  }, [data]);

  const value: RestaurantContextType = {
    restaurant,
    handleSelectRestaurant,
    shift,
    setShift,
    reloadShift: refetch,
  };

  return <RestaurantContext.Provider value={value}>{children}</RestaurantContext.Provider>;
};

const useRestaurant = () => {
  const context = useContext(RestaurantContext);
  if (!context) {
    throw new Error('useRestaurant must be used within a RestaurantProvider');
  }
  return context;
};

// eslint-disable-next-line react-refresh/only-export-components
export { RestaurantProvider, useRestaurant };
