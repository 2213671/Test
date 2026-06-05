import { useState } from 'react';
import { Modal } from '@/components/modal';
import {
  type MenuResponseZodType,
  useCreateMenu,
  useGetMenusByRestaurant,
  useUpdateMenuById,
} from '@/api/pos';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

const MenuManage = () => {
  const { restaurant } = useRestaurant();
  const [open, setOpen] = useState(false);
  const [menuName, setMenuName] = useState('');
  const [menuDesc, setMenuDesc] = useState('');
  const [menuSelected, setMenuSelected] = useState<MenuResponseZodType | null>(null);
  const { mutate } = useCreateMenu({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { mutate: update } = useUpdateMenuById({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { data: menus, refetch } = useGetMenusByRestaurant(restaurant?.id as string);

  const handleCreateMenu = () => {
    if (!menuName.trim()) return;
    if (menuSelected) {
      update({ id: menuSelected.id as string, data: { name: menuName, description: menuDesc } });
    } else {
      mutate({
        data: { name: menuName, description: menuDesc },
      });
    }

    setMenuName('');
    setMenuDesc('');
    setMenuSelected(null);
    setOpen(false);
  };


  const handleReset = () => {
    setMenuName('');
    setMenuDesc('');
    setMenuSelected(null);
    setOpen(false);
  }
  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý Menu</h1>

      {/* Nút tạo menu */}
      <button
        onClick={() => {
          setOpen(true);
        }}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        {   'Tạo menu mới'}
      </button>

      {/* Danh sách menu */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {menus?.map(menu => (
          <div
            key={menu.id}
            onClick={() => {
              setMenuSelected(menu);
              setOpen(true);
              setMenuName(menu.name);
              setMenuDesc(menu.description);
            }}
            className="rounded border border-indigo-300 bg-white p-4 shadow transition-shadow hover:shadow-md"
          >
            <h3 className="text-lg font-semibold text-indigo-700">{menu.name}</h3>
            <p className="mt-2 text-gray-600">{menu.description}</p>
          </div>
        ))}

        {!menus || menus.length === 0 ? (
          <p className="col-span-full text-gray-500">Chưa có menu nào.</p>
        ) : null}
      </div>

      {/* Modal tạo menu */}
      <Modal isOpen={open} onClose={handleReset} title= {menuSelected ? 'Cập nhật menu' : 'Tạo menu mới'}>
        <div className="">
          <div className="flex flex-col gap-1">
            <label className="text-indigo-700">Tên Menu</label>
            <input
              type="text"
              value={menuName}
              onChange={e => setMenuName(e.target.value)}
              className="rounded border border-indigo-300 px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              placeholder="Nhập tên menu"
            />
          </div>
          <div className="mt-4 flex flex-col gap-1">
            <label className="text-indigo-700">Mô tả</label>
            <textarea
              value={menuDesc}
              onChange={e => setMenuDesc(e.target.value)}
              className="rounded border border-indigo-300 px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              placeholder="Nhập mô tả"
              rows={3}
            />
          </div>
          <div className="mt-4 flex justify-end gap-2">
            <button
              onClick={handleReset}
              className="rounded border border-indigo-300 px-4 py-2 hover:bg-indigo-50"
            >
              Hủy
            </button>
            <button
              onClick={handleCreateMenu}
              className="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
            >
              {menuSelected ? 'Cập nhật' : 'Tạo'}
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default MenuManage;
