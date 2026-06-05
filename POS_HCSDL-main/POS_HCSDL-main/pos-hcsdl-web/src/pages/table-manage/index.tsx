import { Modal } from '@/components/modal';
import { useState } from 'react';
import {
  type TableResponseZodType,
  useCreateTable,
  useGetTableByRestaurant,
  useUpdateTableById,
} from '@/api/pos';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

const TableManage = () => {
  const { restaurant } = useRestaurant();

  const [open, setOpen] = useState(false);
  const [tableName, setTableName] = useState('');
  const [tableSelected, setTableSelected] = useState<TableResponseZodType | null>(null);
  const { mutate } = useCreateTable({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { mutate: update } = useUpdateTableById({
    mutation: {
      onSuccess: async () => {
        await refetch();
      },
    },
  });

  const { data: tables, refetch } = useGetTableByRestaurant(restaurant?.id as string);

  const handleCreateTable = () => {
    if (!tableName.trim()) return;

    if (tableSelected) {
      update({ id: tableSelected?.id as string, data: { name: tableName } });
    } else {
      mutate({ data: { name: tableName } });
    }
    setTableSelected(null)
    setTableName('');
    setOpen(false);
  };

  const handleReset = () => {
    setOpen(false);
    setTableName('');
    setTableSelected(null);
  }

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý Bàn</h1>

      {/* Nút tạo bàn */}
      <button
        onClick={() => setOpen(true)}
        className="mb-6 rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
      >
        { 'Tạo bàn Mới'}
      </button>

      {/* Danh sách bàn */}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {tables?.map(table => {
          // Chọn màu theo status
          let statusColor = '';
          let statusText = '';

          switch (table.status) {
            case 'INUSE':
              statusColor = 'bg-green-200 text-green-800';
              statusText = 'Đang sử dụng';
              break;
            case 'BLACK':
              statusColor = 'bg-black text-white';
              statusText = 'Đen';
              break;
            case 'DISABLE':
              statusColor = 'bg-gray-200 text-gray-800';
              statusText = 'Vô hiệu hóa';
              break;
            default:
              statusColor = 'bg-gray-100 text-gray-800';
              statusText = 'Chưa xác định';
          }

          return (
            <div
              key={table.id}
              onClick={() => {
                setTableSelected(table);
                setOpen(true);
                setTableName(table.name);
              }}
              className="flex h-36 flex-col justify-between rounded border border-indigo-300 bg-white p-4 shadow transition-shadow hover:shadow-md"
            >
              <h3 className="text-lg font-semibold text-indigo-700">{table.name}</h3>
              <span className={`inline-block rounded px-2 py-1 text-sm font-medium ${statusColor}`}>
                {statusText}
              </span>
            </div>
          );
        })}

        {!tables || tables.length === 0 ? (
          <p className="col-span-full text-gray-500">Chưa có bàn nào.</p>
        ) : null}
      </div>

      {/* Modal tạo bàn */}
      <Modal
        isOpen={open}
        onClose={handleReset}
        title= {tableSelected ? 'Cập nhật bàn' : 'Tạo bàn Mới'}
      >
        <div className="flex flex-col gap-2">
          <label className="text-indigo-700">Tên Bàn</label>
          <input
            type="text"
            value={tableName}
            onChange={e => setTableName(e.target.value)}
            className="rounded border border-indigo-300 px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:outline-none"
            placeholder="Nhập tên bàn"
          />
          <div className="mt-4 flex justify-end gap-2">
            <button
              onClick={handleReset}
              className="rounded border border-indigo-300 px-4 py-2 hover:bg-indigo-50"
            >
              Hủy
            </button>
            <button
              onClick={handleCreateTable}
              className="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
            >
              {tableSelected ? 'Cập nhật' : 'Tạo'}
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default TableManage;
