import { useEffect, useState } from 'react';
import { Modal } from '@/components/modal';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

import {
  useCreateProduct,
  useGetMenusByRestaurant,
  useGetOptionsByRestaurant,
  useGetToppingsByRestaurant,
  useGetProductsByMenu,
} from '@/api/pos';

const ProductManage = () => {
  const { restaurant } = useRestaurant();
  const [open, setOpen] = useState(false);

  // Form
  const [name, setName] = useState('');
  const [description, setDescription] = useState('');
  const [tag, setTag] = useState('');
  const [imageUrl, setImageUrl] = useState('');
  const [price, setPrice] = useState(0);
  const [menuSelected, setMenuSelected] = useState<string | null>(null);
  const [selectedOptions, setSelectedOptions] = useState<string[]>([]);
  const [selectedToppings, setSelectedToppings] = useState<string[]>([]);

  const { data: menus } = useGetMenusByRestaurant(restaurant?.id || '');
  const { data: options } = useGetOptionsByRestaurant(restaurant?.id || '');
  const { data: toppings } = useGetToppingsByRestaurant(restaurant?.id || '');

  useEffect(() => {
    if (menus?.length) setMenuSelected(menus[0].id);
  }, [menus]);

  const { data: products, refetch: refetchProducts } = useGetProductsByMenu(menuSelected || '', {
    query: { enabled: !!menuSelected },
  });

  useEffect(() => {
    if (menuSelected) refetchProducts();
  }, [menuSelected]);

  const { mutate } = useCreateProduct({
    mutation: {
      onSuccess: () => {
        refetchProducts();
        resetForm();
        setOpen(false);
      },
    },
  });

  const toggleSelect = (arr: string[], setArr: (v: string[]) => void, id: string) => {
    setArr(arr.includes(id) ? arr.filter(x => x !== id) : [...arr, id]);
  };

  const resetForm = () => {
    setName('');
    setDescription('');
    setTag('');
    setImageUrl('');
    setPrice(0);
    setSelectedOptions([]);
    setSelectedToppings([]);
  };

  const handleCreate = () => {
    if (!name.trim() || !menuSelected) return;
    mutate({
      data: {
        name,
        description,
        tag,
        imageUrl,
        price,
        menuId: menuSelected,
        options: selectedOptions,
        toppings: selectedToppings,
      },
    });
  };

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý sản phẩm</h1>

      <button
        onClick={() => setOpen(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        Tạo sản phẩm mới
      </button>

      {/* Menu tabs */}
      <div className="mb-4 flex gap-3">
        {menus?.map(menu => (
          <button
            key={menu.id}
            onClick={() => setMenuSelected(menu.id)}
            className={`rounded border px-3 py-1 font-medium ${
              menuSelected === menu.id
                ? 'border-indigo-600 bg-indigo-600 text-white'
                : 'border-indigo-200 bg-indigo-100 text-indigo-700'
            }`}
          >
            {menu.name}
          </button>
        ))}
      </div>

      {/* Product list */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {products?.map(p => (
          <div
            key={p.id}
            className="cursor-pointer rounded border border-indigo-300 shadow hover:shadow-md"
          >
            <img src={p.imageUrl!} alt={p.name!} className="h-36 w-full rounded object-cover bg-slate-100" />
            <div className={'px-4 py-2'}>
              <h3 className="text-lg font-semibold text-indigo-700">{p.name}</h3>
              <p className="text-gray-600">{p.description}</p>
              <p className="text-gray-500">{p.tag}</p>
              <p className="mt-2 font-semibold">{p.price}₫</p>
            </div>
          </div>
        ))}
        {!products ||
          (products.length === 0 && (
            <p className="col-span-full text-gray-500">Chưa có sản phẩm nào.</p>
          ))}
      </div>

      <Modal isOpen={open} onClose={() => setOpen(false)} title="Tạo sản phẩm mới">
        <div className="grid grid-cols-2 gap-3">
          {/* Tên sản phẩm */}
          <div className="flex flex-col">
            <label className="mb-1 font-medium">Tên sản phẩm</label>
            <input
              type="text"
              placeholder="Tên sản phẩm"
              className="w-full rounded border border-indigo-300 px-3 py-1.5 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              value={name}
              onChange={e => setName(e.target.value)}
            />
          </div>

          {/* Giá */}
          <div className="flex flex-col">
            <label className="mb-1 font-medium">Giá</label>
            <input
              type="number"
              placeholder="0"
              className="w-full rounded border border-indigo-300 px-3 py-1.5 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              value={price}
              onChange={e => setPrice(Number(e.target.value))}
            />
          </div>

          {/* Mô tả */}
          <div className="col-span-2 flex flex-col">
            <label className="mb-1 font-medium">Mô tả</label>
            <textarea
              placeholder="Mô tả sản phẩm"
              className="w-full rounded border border-indigo-300 px-3 py-1.5 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              rows={2}
              value={description}
              onChange={e => setDescription(e.target.value)}
            />
          </div>

          {/* Tag */}
          <div className="flex flex-col">
            <label className="mb-1 font-medium">Tag</label>
            <input
              type="text"
              placeholder="Tag"
              className="w-full rounded border border-indigo-300 px-3 py-1.5 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              value={tag}
              onChange={e => setTag(e.target.value)}
            />
          </div>

          {/* Image URL */}
          <div className="flex flex-col">
            <label className="mb-1 font-medium">Image URL</label>
            <input
              type="text"
              placeholder="https://..."
              className="w-full rounded border border-indigo-300 px-3 py-1.5 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
              value={imageUrl}
              onChange={e => setImageUrl(e.target.value)}
            />
          </div>

          {/* Options */}
          <div className="col-span-2 flex flex-col">
            <label className="mb-1 font-medium">Options</label>
            <div className="flex flex-wrap gap-2">
              {options?.map(o => (
                <button
                  key={o.id}
                  onClick={() => toggleSelect(selectedOptions, setSelectedOptions, o.id)}
                  className={`rounded border px-3 py-1 text-sm ${
                    selectedOptions.includes(o.id)
                      ? 'bg-indigo-600 text-white'
                      : 'border-indigo-300 text-indigo-700'
                  }`}
                >
                  {o.name}
                </button>
              ))}
            </div>
          </div>

          {/* Toppings */}
          <div className="col-span-2 flex flex-col">
            <label className="mb-1 font-medium">Toppings</label>
            <div className="flex flex-wrap gap-2">
              {toppings?.map(t => (
                <button
                  key={t.id}
                  onClick={() => toggleSelect(selectedToppings, setSelectedToppings, t.id)}
                  className={`rounded border px-3 py-1 text-sm ${
                    selectedToppings.includes(t.id)
                      ? 'bg-green-500 text-white'
                      : 'border-green-300 text-green-700'
                  }`}
                >
                  {t.name}
                </button>
              ))}
            </div>
          </div>

          {/* Footer buttons */}
          <div className="col-span-2 mt-3 flex justify-end gap-2">
            <button
              onClick={() => setOpen(false)}
              className="rounded border border-indigo-300 px-4 py-1.5 text-sm hover:bg-indigo-50"
            >
              Hủy
            </button>
            <button
              onClick={handleCreate}
              className="rounded bg-indigo-600 px-4 py-1.5 text-sm text-white hover:bg-indigo-700"
            >
              Tạo
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default ProductManage;
