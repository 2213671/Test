import { useState } from 'react';
import { Modal } from '@/components/modal';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

// ❗ Nhớ đổi sang API thật của bạn
import {
  type ToppingResponseZodType,
  useCreateTopping,
  useGetToppingsByRestaurant,
  useUpdateToppingById,
} from '@/api/pos';
import { Counter } from '@/components/counter';
import { fmtCurrency } from '@/utils';

const ToppingManage = () => {
  const { restaurant } = useRestaurant();

  const [open, setOpen] = useState(false);
  const [name, setName] = useState('');
  const [maxQuantity, setMaxQuantity] = useState(0);
  const [price, setPrice] = useState(0);
  const [toppingSelected, setToppingSelected] = useState<ToppingResponseZodType | null>(null);
  // TẠO TOPPING
  const { mutate } = useCreateTopping({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { mutate: update } = useUpdateToppingById({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  // LẤY DANH SÁCH TOPPING
  const { data: toppings, refetch } = useGetToppingsByRestaurant(restaurant?.id as string);

  const handleCreate = () => {
    if (!name.trim()) return;
    if (toppingSelected) {
      update({
        id: toppingSelected.id as string,
        data: {
          name,
          maxQuantity,
          price,
        },
      });
    }
    else {
      mutate({
        data: {
          name,
          maxQuantity,
          price,
        },
      });
    }

    setToppingSelected(null)
    handleReset();
  };

  const handleReset = () => {
    setName('');
    setMaxQuantity(0);
    setPrice(0);
    setOpen(false);
  };

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý Topping</h1>

      {/* Nút tạo topping */}
      <button
        onClick={() => setOpen(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        {  'Tạo topping Mới'}
      </button>

      {/* Danh sách toppings */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {toppings?.map(item => (
          <div
            onClick={() => {
              setName(item.name as string);
              setPrice(item.price);
              setMaxQuantity(item.maxQuantity);
              setOpen(true);
              setToppingSelected(item);
            }}
            key={item.id}
            className="cursor-pointer rounded border border-indigo-300 bg-white p-4 shadow hover:shadow-md"
          >
            <h3 className="text-lg font-semibold text-indigo-700">{item.name}</h3>

            <p className="mt-2 text-gray-600">
              Số lượng tối đa: <b>{item.maxQuantity}</b>
            </p>

            <p className="mt-1 text-gray-600">
              Giá: <b>{fmtCurrency(item.price)}</b>
            </p>
          </div>
        ))}

        {!toppings || toppings.length === 0 ? (
          <p className="col-span-full text-gray-500">Chưa có topping nào.</p>
        ) : null}
      </div>

      {/* Modal tạo topping */}
      <Modal
        isOpen={open}
        onClose={handleReset}
        title= {toppingSelected ? 'Cập nhật topping' : 'Tạo topping Mới'}
      >
        <div className="">
          {/* Tên topping */}
          <div className="flex flex-col gap-1">
            <label className="text-indigo-700">Tên Topping</label>
            <input
              type="text"
              value={name}
              onChange={e => setName(e.target.value)}
              className="rounded border border-indigo-300 px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              placeholder="Nhập tên topping"
            />
          </div>

          {/* Số lượng tối đa */}
          <div className="mt-4 flex items-center justify-between gap-1">
            <span>Số lượng tối đa</span>
            <Counter
              value={maxQuantity}
              increment={() => setMaxQuantity(prev => prev + 1)}
              decrement={() => setMaxQuantity(prev => Math.max(1, prev - 1))}
            />
          </div>

          {/* Giá */}
          <div className="mt-4 flex flex-col gap-1">
            <label className="font-medium text-indigo-700">Giá</label>
            <input
              type="number"
              value={price}
              min={0}
              onChange={e => setPrice(Number(e.target.value))}
              className="w-full rounded border border-indigo-300 px-3 py-2 text-indigo-700 focus:ring-2 focus:ring-indigo-300 focus:outline-none"
              placeholder="Nhập giá"
            />
          </div>

          {/* Nút Hủy / Tạo */}
          <div className="mt-4 flex justify-end gap-2">
            <button
              onClick={() => handleReset()}
              className="rounded border border-indigo-300 px-4 py-2 text-indigo-700 hover:bg-indigo-50"
            >
              Hủy
            </button>
            <button
              onClick={handleCreate}
              className="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
            >
              {toppingSelected ? 'Cập nhật' : 'Tạo'}
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default ToppingManage;
