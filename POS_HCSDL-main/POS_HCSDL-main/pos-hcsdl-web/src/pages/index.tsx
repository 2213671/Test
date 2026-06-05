import { Outlet, useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';
import { useAuth } from '@/contexts/AuthContext.tsx';
import { SettingsIcon } from '@/icons';
import { useGetRestaurantById, useSelectRestaurantList } from '@/api/pos';
import { nav } from '@/router/nav.tsx';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

export const Root = () => {
  const { user, logout } = useAuth();
  const { handleSelectRestaurant } = useRestaurant();
  const navigate = useNavigate();
  const [openNotification, setOpenNotification] = useState(false);
  const [selectedRestaurant, setSelectedRestaurant] = useState<string | null>(null);

  const { data: restaurants } = useSelectRestaurantList({
    query: {
      enabled: user?.roleName === 'ADMIN',
    },
  });

  const { data: res } = useGetRestaurantById(selectedRestaurant!, {
    query: {
      enabled: !!selectedRestaurant,
      queryKey: ['GetRestaurant', selectedRestaurant],
    },
  });

  useEffect(() => {
    if (res) {
      handleSelectRestaurant(res)
    }
  }, [res]);

  useEffect(() => {
    if (restaurants) {
      const resData: any = JSON.parse(localStorage.getItem('restaurant'));
      if (!resData) {
        setSelectedRestaurant(restaurants?.[0]?.id);
      } else {
        setSelectedRestaurant(resData?.id);
      }
    }
  }, [restaurants]);
  return (
    <div className={'flex min-h-screen w-full bg-gray-50'}>
      {/* Header */}
      <div className="fixed top-0 left-0 z-50 flex h-[60px] w-full items-center gap-4 border-b border-gray-200 bg-white ps-2 pe-4">
        <div className="flex-1">
          <span className="text-xl font-bold text-indigo-700">POS</span>
        </div>

        {/* Select Restaurant chỉ với ADMIN */}
        {user?.roleName === 'ADMIN' && restaurants && (
          <select
            value={selectedRestaurant || ''}
            onChange={e => setSelectedRestaurant(e.target.value)}
            className="rounded border px-2 py-1 text-sm"
          >
            <option value="">Chọn nhà hàng</option>
            {restaurants.map(r => (
              <option key={r.id} value={r.id!}>
                {r.name}
              </option>
            ))}
          </select>
        )}

        <div>{user?.username}</div>

        {/* Notification */}
        <div
          className="relative flex size-8 items-center justify-center rounded-full bg-slate-200"
          onClick={() => setOpenNotification(!openNotification)}
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth="1.5"
            stroke="currentColor"
            className="size-6"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
            />
          </svg>
        </div>

        <img
          src={
            user?.imageUrl ||
            'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg'
          }
          alt={user?.username as string}
          onClick={logout}
          className="size-10 rounded-full bg-slate-500"
        />
      </div>

      {/* Sidebar */}
      <div className="fixed top-[60px] flex h-[calc(100vh-60px)] w-[60px] flex-col border-r border-gray-200 bg-white">
        <div className="flex h-full w-full flex-1 flex-col items-center gap-3 overflow-y-auto py-4">
          {nav.map(
            (item, i) =>
              item.accessibleRoles?.includes(user?.roleName as string) && (
                <div
                  onClick={() => navigate(item.path)}
                  key={i}
                  className="cursor-pointer rounded-md bg-slate-100 p-3 hover:bg-sky-100"
                >
                  {item.icon}
                </div>
              )
          )}
        </div>
        <div className="mb-3 flex items-center justify-center">
          <div className="cursor-pointer rounded-md bg-slate-100 p-3 hover:bg-sky-100">
            <SettingsIcon />
          </div>
        </div>
      </div>

      {/* Outlet */}
      <div className="mt-[60px] ml-[60px] min-h-[calc(100vh-60px)] flex-1 p-4">
        <Outlet context={{ selectedRestaurant }} />
      </div>
    </div>
  );
};
