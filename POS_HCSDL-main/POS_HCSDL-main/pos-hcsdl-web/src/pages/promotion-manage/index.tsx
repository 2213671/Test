import { useState } from 'react';
import {
  type PromotionRequestZodType,
  type PromotionResponseZodType,
  useCreatePromotion,
  useGetMenusByRestaurant,
  useGetPromotionsByRestaurant,
  useUpdatePromotionById,
} from '@/api/pos';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

export default function PromotionManagement() {
  const { restaurant } = useRestaurant();
  const { data: promotions, refetch } = useGetPromotionsByRestaurant(restaurant?.id as string);
  const { mutate: createPromotion } = useCreatePromotion({
    mutation: { onSuccess: () => refetch() },
  });
  const { mutate: update } = useUpdatePromotionById({ mutation: { onSuccess: () => refetch() } });

  const { data: menus } = useGetMenusByRestaurant(restaurant?.id as string);
  const [promotionSelected, setPromotionSelected] = useState<PromotionResponseZodType | null>(null);
  const [creating, setCreating] = useState(false);
  const [form, setForm] = useState<PromotionRequestZodType>({
    name: '',
    type: 'VALUE',
    applyType: 'ORDER',
    value: 0,
    startDate: '',
    endDate: '',
    startHour: '',
    endHour: '',
    menus: [],
  });

  const updateField = (key: string, value: any) => setForm({ ...form, [key]: value });

  const handleCreate = () => {
    if (promotionSelected) {
      update({
        id: promotionSelected.id as string,
        data: {
          ...form,
          startDate: new Date(form.startDate!).toISOString(),
          endDate: new Date(form.endDate!).toISOString(),
        },
      });
    } else {
      createPromotion({
        data: {
          ...form,
          startDate: new Date(form.startDate!).toISOString(),
          endDate: new Date(form.endDate!).toISOString(),
        },
      });
    }

    setCreating(false);
  };

  const handleReset = () => {
    setForm({
      name: '',
      type: 'VALUE',
      applyType: 'ORDER',
      value: 0,
      startDate: '',
      endDate: '',
      startHour: '',
      endHour: '',
      menus: [],
    });
    setCreating(false);
    setPromotionSelected(null);
  };

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý khuyến mãi</h1>

      <button
        onClick={() => setCreating(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        { 'Tạo khuyến mãi'}
      </button>

      {/* Danh sách khuyến mãi */}
      <div className="space-y-3">
        {promotions?.map(p => (
          <div
            onClick={() => {
              setPromotionSelected(p);
              setCreating(true);
              const { id, restaurantId, status, ...data } = p;
              setForm({
                ...data,
                startDate: new Date(data.startDate!).toISOString().split('T')[0],
                endDate: new Date(data.endDate!).toISOString().split('T')[0],
              });
            }}
            key={p.id}
            className="rounded-lg border border-indigo-200 bg-white p-4 shadow-sm"
          >
            <div className="flex items-center justify-between">
              <div>
                <div className="text-lg font-medium text-indigo-700">{p.name}</div>
                <div className="text-sm text-gray-600">
                  {p.type === 'VALUE' ? 'Giá trị cố định' : 'Phần trăm'} —{' '}
                  {p.applyType === 'ORDER' ? 'Đơn hàng' : 'Món ăn'}
                </div>
              </div>
              <span
                className={`rounded px-2 py-1 text-xs font-medium ${
                  p.status === 'ACTIVE'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-gray-200 text-gray-700'
                }`}
              >
                {p.status === 'ACTIVE' ? 'Đang hoạt động' : 'Ngưng hoạt động'}
              </span>
            </div>
            <div className="mt-2 text-sm text-gray-600">
              Thời gian: {p.startDate} → {p.endDate}
            </div>
          </div>
        ))}

        {!promotions ||
          (promotions.length === 0 && <p className="text-gray-500">Chưa có khuyến mãi nào.</p>)}
      </div>

      {/* Modal tạo khuyến mãi */}
      {creating && (
        <div className="fixed inset-0 flex items-center justify-center bg-black/40 p-4">
          <div className="w-full max-w-md rounded-xl bg-white p-6 shadow-lg">
            <h2 className="mb-4 text-xl font-semibold text-indigo-700">    {promotionSelected ? 'Cập nhật khuyến mãi' : 'Tạo khuyến mãi'}</h2>

            <div className="space-y-3">
              {/* Tên */}
              <input
                type="text"
                placeholder="Tên khuyến mãi"
                className="w-full rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                value={form.name!}
                onChange={e => updateField('name', e.target.value)}
              />

              {/* Loại & áp dụng */}
              <div className="grid grid-cols-2 gap-2">
                <select
                  className="w-full rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.type!}
                  onChange={e => updateField('type', e.target.value)}
                >
                  <option value="VALUE">Giá trị cố định</option>
                  <option value="PERCENT">Phần trăm</option>
                </select>
                <select
                  className="w-full rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.applyType!}
                  onChange={e => updateField('applyType', e.target.value)}
                >
                  <option value="ORDER_ITEM">Món ăn</option>
                  <option value="ORDER">Đơn hàng</option>
                </select>
              </div>

              {/* Giá trị */}
              <input
                type="number"
                placeholder="Giá trị khuyến mãi"
                className="w-full rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                value={form.value!}
                onChange={e => updateField('value', Number(e.target.value))}
              />

              {/* Ngày & giờ */}
              <div className="grid grid-cols-2 gap-2">
                <input
                  type="date"
                  className="rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.startDate!}
                  onChange={e => updateField('startDate', e.target.value)}
                />
                <input
                  type="date"
                  className="rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.endDate!}
                  onChange={e => updateField('endDate', e.target.value)}
                />
              </div>
              <div className="grid grid-cols-2 gap-2">
                <input
                  type="time"
                  className="rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.startHour!}
                  onChange={e => updateField('startHour', e.target.value)}
                />
                <input
                  type="time"
                  className="rounded border border-indigo-300 p-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
                  value={form.endHour!}
                  onChange={e => updateField('endHour', e.target.value)}
                />
              </div>

              {/* Menus */}
              <div>
                <label className="mb-1 block text-sm font-medium">Menus áp dụng</label>
                <div className="max-h-28 space-y-1 overflow-y-auto rounded border border-indigo-300 p-2">
                  {menus?.map(m => (
                    <label key={m.id} className="flex items-center gap-2 text-sm">
                      <input
                        type="checkbox"
                        checked={form.menus?.includes(m.id!)}
                        onChange={e => {
                          if (e.target.checked) updateField('menus', [...form.menus!, m.id]);
                          else
                            updateField(
                              'menus',
                              form.menus?.filter(x => x !== m.id)
                            );
                        }}
                        className="h-4 w-4 accent-indigo-600"
                      />
                      {m.name}
                    </label>
                  ))}
                </div>
              </div>
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
                {promotionSelected ? 'Cập nhật' : 'Tạo'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
