import { useState } from 'react';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';
import {
  useCreatePaymentMethod,
  useGetPaymentMethodsByRestaurant,
  useUpdatePromotionById,
} from '@/api/pos';
import { Modal } from '@/components/modal';

// Helper chuyển string sang snake_case
const toSnakeCase = (str: string) =>
  str
    .trim()
    .toLowerCase()
    .replace(/\s+/g, '_')
    .replace(/[^\w_]/g, '');

export default function PaymentMethodManagement() {
  const { restaurant } = useRestaurant();
  const { data: methods, refetch } = useGetPaymentMethodsByRestaurant(restaurant?.id || '');
  const { mutate: createMethod } = useCreatePaymentMethod({
    mutation: { onSuccess: () => refetch() },
  });
  const [pmSelected, setPMSelected] = useState<string | null>(null);
  const { mutate: update } = useUpdatePromotionById({
    mutation: { onSuccess: () => refetch() },
  });

  const [creating, setCreating] = useState(false);
  const [name, setName] = useState('');

  const handleCreate = () => {
    if (!name.trim()) return;
    if (pmSelected) {
      update({
        id: pmSelected as string,
        data: {
          name: name.trim(),
          code: toSnakeCase(name),
        },
      });
    } else {
      createMethod({
        data: {
          name: name.trim(),
          code: toSnakeCase(name),
        },
      });
    }

    setName('');
    setCreating(false);
  };

  const handleReset = () => {
    setName('');
    setCreating(false);
    setPMSelected(null);
  };

  return (
    <div className=" ">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">
        Quản lý phương thức thanh toán
      </h1>

      <button
        onClick={() => setCreating(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        Tạo phương thức mới
      </button>

      {/* Danh sách phương thức */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {methods?.map(m => (
          <div
            onClick={() => {
              setName(m.name as string);
              setCreating(true);
            }}
            key={m.id}
            className="flex h-28 flex-col justify-center rounded border border-indigo-200 bg-white p-4 shadow transition-shadow hover:shadow-md"
          >
            <h3 className="text-lg font-semibold text-indigo-700">{m.name}</h3>
            <p className="text-sm text-gray-600">Code: {m.code}</p>
          </div>
        ))}
        {!methods ||
          (methods.length === 0 && (
            <p className="col-span-full text-gray-500">Chưa có phương thức thanh toán nào.</p>
          ))}
      </div>

      <Modal
        isOpen={creating}
        onClose={handleReset}
        title={pmSelected ? 'Cập nhật' : 'Tạo phương thức mới'}
      >
        <div className="space-y-3">
          <input
            type="text"
            placeholder="Tên phương thức"
            className="w-full rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200"
            value={name}
            onChange={e => setName(e.target.value)}
          />
          <p className="text-sm text-gray-500">
            Code tự động: <b>{toSnakeCase(name)}</b>
          </p>
        </div>

        <div className="mt-5 flex justify-end gap-3">
          <button
            className="rounded border border-indigo-300 px-4 py-2 hover:bg-indigo-50"
            onClick={handleReset}
          >
            Hủy
          </button>
          <button
            className="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
            onClick={handleCreate}
          >
            {pmSelected ? 'Cập nhật' : 'Tạo'}
          </button>
        </div>
      </Modal>
    </div>
  );
}
