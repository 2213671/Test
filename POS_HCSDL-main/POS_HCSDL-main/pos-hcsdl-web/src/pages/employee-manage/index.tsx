import { useState } from 'react';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';
import { useCreateUser, useGetStaffs } from '@/api/pos';
import { Modal } from '@/components/modal';

export default function EmployeeManagement() {
  const { restaurant } = useRestaurant();
  const [open, setOpen] = useState(false);

  // Form states
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [email, setEmail] = useState('');
  const [address, setAddress] = useState('');
  const [phone, setPhone] = useState('');
  const [imageUrl, setImageUrl] = useState('');

  // API hooks
  const { data: employees, refetch } = useGetStaffs(restaurant?.id as string);
  const { mutate } = useCreateUser({
    mutation: {
      onSuccess: () => {
        refetch();
        resetForm();
        setOpen(false);
      },
    },
  });

  const resetForm = () => {
    setUsername('');
    setPassword('');
    setEmail('');
    setAddress('');
    setPhone('');
    setImageUrl('');
  };

  const handleCreate = () => {
    if (!username.trim() || !password.trim()) return;
    mutate({
      data: {
        username,
        password,
        email,
        address,
        phone,
        imageUrl,
      },
    });
  };

  return (
    <div className="">
      <h1 className="text-2xl font-semibold text-indigo-700 mb-4">Quản lý nhân viên</h1>

      <button
        onClick={() => setOpen(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        Tạo nhân viên mới
      </button>

      {/* Employee List */}
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        {employees?.length ? (
          employees.map(emp => (
            <div key={emp.id} className="rounded border bg-white p-4 shadow hover:shadow-md transition-shadow border-indigo-300">

              <div className={'flex gap-3 items-center '}>
                <img
                  src={emp.imageUrl || 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg'}
                  alt={emp.username!}
                  className="mb-2 size-18 aspect-square rounded object-cover"
                />
                <div>
                  <h3 className="flex-1 text-lg font-semibold text-indigo-700">{emp.username}</h3>
                  <div className={`mt-3 px-2 py-1 text-sm w-max  border rounded-full ${emp.roleName === 'STAFF' ? 'bg-orange-100 border-orange-300': 'bg-indigo-100 border-indigo-300'}`}>
                    {emp.roleName}
                  </div>
                </div>
              </div>

              <p className="text-gray-600">{emp.email}</p>
              <p className="text-gray-600">{emp.phone}</p>
              <p className="text-gray-600">{emp.address}</p>
            </div>
          ))
        ) : (
          <p className="col-span-full text-gray-500">Chưa có nhân viên nào trong nhà hàng.</p>
        )}
      </div>

      {/* Modal Create Employee */}
      <Modal
        isOpen={open}
        onClose={() => setOpen(false)}
        title="Tạo nhân viên mới"
      >
        <div className="flex flex-col gap-3">
          <input
            type="text"
            placeholder="Username"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={username}
            onChange={e => setUsername(e.target.value)}
          />
          <input
            type="password"
            placeholder="Password"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={password}
            onChange={e => setPassword(e.target.value)}
          />
          <input
            type="email"
            placeholder="Email"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={email}
            onChange={e => setEmail(e.target.value)}
          />
          <input
            type="text"
            placeholder="Địa chỉ"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={address}
            onChange={e => setAddress(e.target.value)}
          />
          <input
            type="text"
            placeholder="Số điện thoại"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={phone}
            onChange={e => setPhone(e.target.value)}
          />
          <input
            type="text"
            placeholder="Image URL"
            className="w-full rounded border border-indigo-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            value={imageUrl}
            onChange={e => setImageUrl(e.target.value)}
          />

          <div className="flex justify-end gap-2 mt-4">
            <button
              onClick={() => setOpen(false)}
              className="rounded border border-indigo-300 px-4 py-2 hover:bg-indigo-50"
            >
              Hủy
            </button>
            <button
              onClick={handleCreate}
              className="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
            >
              Tạo
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
}
