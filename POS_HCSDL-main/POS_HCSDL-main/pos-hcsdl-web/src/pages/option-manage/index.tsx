import { useState } from 'react';
import { Modal } from '@/components/modal';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

// ❗ Nhớ đổi sang API thật của bạn
import {
  type OptionResponseZodType,
  useCreateOption,
  useGetOptionsByRestaurant,
  useUpdateOptionById,
} from '@/api/pos';

const OptionManage = () => {
  const { restaurant } = useRestaurant();

  const [open, setOpen] = useState(false);
  const [name, setName] = useState('');
  const [required, setRequired] = useState(false);
  const [price, setPrice] = useState(0);
  const [optionSelected, setOptionSelected] = useState<OptionResponseZodType | null>(null);
  const { mutate } = useCreateOption({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { mutate: update } = useUpdateOptionById({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { data: options, refetch } = useGetOptionsByRestaurant(restaurant?.id as string);

  const handleCreate = () => {
    if (!name.trim()) return;
    if (optionSelected) {
      update({
        id: optionSelected.id as string,
        data: {
          name,
          required,
          price,
        },
      });
    } else {
      mutate({
        data: {
          name,
          required,
          price,
        },
      });
    }

    handleReset();
  };

  const handleReset = () => {
    setName('');
    setRequired(false);
    setPrice(0);
    setOpen(false);
    setOptionSelected(null);
  };

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý Option</h1>

      {/* Nút tạo option */}
      <button
        onClick={() => setOpen(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        {  'Tạo option Mới'}
      </button>

      {/* Danh sách options */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {options?.map(item => (
          <div
            onClick={() => {
              setOptionSelected(item);
              setOpen(true);
              setName(item.name as string);
              setPrice(item.price as number);
              setRequired(item.required as boolean);
            }}
            key={item.id}
            className="cursor-pointer rounded border border-indigo-300 bg-white p-4 shadow hover:shadow-md"
          >
            <h3 className="text-lg font-semibold text-indigo-700">{item.name}</h3>

            <p className="mt-2 text-gray-700">
              Bắt buộc:{' '}
              <b className={item.required ? 'text-green-600' : 'text-red-500'}>
                {item.required ? 'Có' : 'Không'}
              </b>
            </p>

            <p className="text-gray-700">
              Giá: <b>{item.price}đ</b>
            </p>
          </div>
        ))}

        {!options || options.length === 0 ? (
          <p className="col-span-full text-gray-500">Chưa có option nào.</p>
        ) : null}
      </div>

      {/* Modal tạo option */}
      <Modal isOpen={open} onClose={() => handleReset()} title=   {optionSelected ? 'Cập nhật option' : 'Tạo option Mới'}>
        <div className="">
          {/* Tên option */}
          <div className="flex flex-col gap-1">
            <label className="text-indigo-700">Tên Option</label>
            <input
              type="text"
              value={name}
              onChange={e => setName(e.target.value)}
              className="rounded border border-indigo-300 px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              placeholder="Nhập tên option"
            />
          </div>

          {/* Bắt buộc */}
          <div className="mt-4 flex items-center gap-2">
            <input
              type="checkbox"
              checked={required}
              onChange={e => setRequired(e.target.checked)}
              className="h-4 w-4"
            />
            <label className="text-gray-700">Bắt buộc</label>
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
              {optionSelected ? 'Cập nhật' : 'Tạo'}
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default OptionManage;
