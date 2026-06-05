import { useState } from 'react';
import {
  type RestaurantRequestZodType,
  useCreateRestaurant,
  useGetRestaurantList,
  useGetSummary,
} from '@/api/pos';
import { format } from 'date-fns';

const RestaurantManagement = () => {
  const { data: restaurants, refetch } = useGetRestaurantList();
  const [openPopup, setOpenPopup] = useState(false);

  const { data: summary, refetch: refetchSummary } = useGetSummary(); // Summary data
  const { mutate } = useCreateRestaurant({
    mutation: {
      onSuccess: () => {
        refetch();
        refetchSummary();
      },
      onError: (error) => {
        alert(error.response?.data?.error)
      }
    },
  });
  const [newRestaurant, setNewRestaurant] = useState<RestaurantRequestZodType>({
    name: '',
    username: '',
    description: '',
    address: '',
    phone: '',
    email: '',
    imageUrl: '',
    password: '',
  });

  const handleAddRestaurant = async () => {
    mutate({ data: newRestaurant });
    setNewRestaurant({
      name: '',
      username: '',
      description: '',
      address: '',
      phone: '',
      email: '',
      imageUrl: '',
      password: '',
    });
    setOpenPopup(false);
  };

  return (
    <div className="p-6">
      {/* Header */}
      <div className="mb-6 flex items-center justify-between">
        <h1 className="text-2xl font-bold text-gray-800">Quản lý Nhà hàng</h1>
        <button
          className="rounded bg-indigo-600 px-5 py-2 text-white transition hover:bg-indigo-700"
          onClick={() => setOpenPopup(true)}
        >
          Thêm nhà hàng
        </button>
      </div>

      {/* Summary */}
      {summary && (
        <div className="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-4">
          <div className="flex flex-col items-center rounded-lg bg-white p-4 shadow">
            <div className="text-sm text-gray-500">Số nhà hàng</div>
            <div className="text-xl font-semibold text-gray-800">{summary.numRestaurant}</div>
          </div>
          <div className="flex flex-col items-center rounded-lg bg-white p-4 shadow">
            <div className="text-sm text-gray-500">Số khách hàng</div>
            <div className="text-xl font-semibold text-gray-800">{summary.customerCount}</div>
          </div>
          <div className="flex flex-col items-center rounded-lg bg-white p-4 shadow">
            <div className="text-sm text-gray-500">Tổng món</div>
            <div className="text-xl font-semibold text-gray-800">{summary.totalItem}</div>
          </div>
          <div className="flex flex-col items-center rounded-lg bg-white p-4 shadow">
            <div className="text-sm text-gray-500">Doanh thu</div>
            <div className="text-xl font-semibold text-gray-800">
              {new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(
                summary.finalAmount
              )}
            </div>
          </div>
        </div>
      )}

      {/* Restaurant List */}
      <div className="flex flex-col divide-y divide-gray-200 overflow-hidden rounded bg-white shadow">
        {restaurants?.map(r => (
          <div key={r.id} className="flex items-center gap-4 px-4 py-3 transition hover:bg-gray-50">
            <img
              src={r.imageUrl || 'https://via.placeholder.com/50'}
              alt={r.name}
              className="h-12 w-12 rounded-full border object-cover"
            />
            <div className="flex-1">
              <h2 className="text-lg font-semibold text-gray-800">{r.name}</h2>
              <p className="text-sm text-gray-500">{r.description || 'Chưa có mô tả'}</p>
              <p className="text-sm text-gray-500">
                Địa chỉ: {r.address || '-'} • Điện thoại: {r.phone || '-'} • Email: {r.email || '-'}
              </p>
            </div>
            <div className="text-sm whitespace-nowrap text-gray-400">
              {r.createdAt ? format(new Date(r.createdAt), 'dd/MM/yyyy HH:mm') : '-'}
            </div>
          </div>
        ))}
      </div>

      {/* Popup thêm nhà hàng */}
      {openPopup && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/30">
          <div className="animate-fadeIn flex w-full max-w-md flex-col gap-3 rounded-lg bg-white p-6 shadow-lg">
            <h2 className="text-xl font-semibold text-gray-800">Thêm Nhà hàng</h2>

            <input
              type="text"
              placeholder="Tên nhà hàng"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.name}
              onChange={e => setNewRestaurant(prev => ({ ...prev, name: e.target.value }))}
            />
            <input
              type="text"
              placeholder="Mô tả"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.description}
              onChange={e => setNewRestaurant(prev => ({ ...prev, description: e.target.value }))}
            />
            <input
              type="text"
              placeholder="Địa chỉ"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.address}
              onChange={e => setNewRestaurant(prev => ({ ...prev, address: e.target.value }))}
            />
            <input
              type="text"
              placeholder="Điện thoại"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.phone}
              onChange={e => setNewRestaurant(prev => ({ ...prev, phone: e.target.value }))}
            />
            <input
              type="email"
              placeholder="Email"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.email}
              onChange={e => setNewRestaurant(prev => ({ ...prev, email: e.target.value }))}
            />
            <input
              type="text"
              placeholder="Image URL"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.imageUrl}
              onChange={e => setNewRestaurant(prev => ({ ...prev, imageUrl: e.target.value }))}
            />
            <input
              type="text"
              placeholder="Tài khoản"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.username}
              onChange={e => setNewRestaurant(prev => ({ ...prev, username: e.target.value }))}
            />
            <input
              type="password"
              placeholder="Password"
              className="w-full rounded-lg border border-gray-300 p-2 transition outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200"
              value={newRestaurant.password}
              onChange={e => setNewRestaurant(prev => ({ ...prev, password: e.target.value }))}
            />

            <div className="mt-3 flex justify-end gap-2">
              <button
                className="rounded-lg border border-gray-300 px-4 py-2 transition hover:bg-gray-50"
                onClick={() => setOpenPopup(false)}
              >
                Hủy
              </button>
              <button
                className="rounded-lg bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700"
                onClick={handleAddRestaurant}
              >
                Thêm
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default RestaurantManagement;
