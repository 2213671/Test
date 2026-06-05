import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Modal } from '@/components/modal';

import { useRestaurant } from '@/contexts/RestaurantContext';
import {
  type TableResponseZodType,
  useGetTableByRestaurant,
} from '@/api/pos';

import { TableIcon } from '@/icons';
import { fmtCurrency } from '@/utils';

const TableOrder = () => {
  const { restaurant } = useRestaurant();
  const navigate = useNavigate();

  const { data: tables, isLoading } = useGetTableByRestaurant(
    restaurant?.id as string,
    {
      query: {
        enabled: !!restaurant?.id,
      },
    }
  );

  const [selectedTable, setSelectedTable] = useState<TableResponseZodType | null>(null);
  const [guestCount, setGuestCount] = useState(1);
  const [modalOpen, setModalOpen] = useState(false);

  const handleTableClick = (table: TableResponseZodType) => {
    if (table.status === 'INUSE') {
      navigate(`/payment/${table.orderId}`);
      return;
    }

    setSelectedTable(table);
    setGuestCount(1);
    setModalOpen(true);
  };

  const handleConfirm = () => {
    if (!selectedTable) return;

    setModalOpen(false);
    navigate(`/order/${selectedTable.id}`, {
      state: { guestCount },
    });
  };

  return (
    <div className="">
      <h1 className="mb-6 text-3xl font-semibold text-gray-800">Quản lý bàn</h1>

      {/* Loading */}
      {isLoading && <p className="text-center text-gray-500">Đang tải danh sách bàn...</p>}

      {/* Empty */}
      {!isLoading && tables?.length === 0 && (
        <p className="text-center text-gray-500">Không có bàn nào.</p>
      )}

      {/* List */}
      <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
        {tables?.map(table => {
          const isFree = table.status === 'BLANK';

          return (
            <div
              key={table.id}
              onClick={() => handleTableClick(table)}
              className={`
                flex cursor-pointer flex-col items-center justify-center rounded-2xl border p-5 shadow-md transition-all
                ${isFree ? 'border-green-600 bg-green-50 hover:bg-green-100' : 'border-red-600 bg-red-50 hover:bg-red-100'}
              `}
            >
              <div className={`mb-2 ${isFree ? 'text-green-600' : 'text-red-600'}`}>
                <TableIcon />
              </div>

              <p className="text-lg font-semibold text-gray-800">{table.name}</p>
              <p className={`mt-1 text-sm font-medium ${isFree ? 'text-green-700' : 'text-red-700'}`}>
                {isFree ? 'Trống' : 'Đang sử dụng'}
              </p>

              {!isFree && (
                <div className="mt-2 text-center text-sm text-gray-700">
                  <p>Số khách: {table.customerCount ?? 0}</p>
                  <p>Tổng tiền: {fmtCurrency(table.totalPrice ?? 0)}</p>
                </div>
              )}
            </div>
          );
        })}
      </div>

      {/* Modal – nhập số khách */}
      <Modal isOpen={modalOpen} onClose={() => setModalOpen(false)}
      title={`${selectedTable?.name} – Số khách`}>
        <div className="">
          <h2 className="mb-4 text-xl font-semibold text-gray-800">

          </h2>

          <label className="mb-2 block text-sm font-medium text-gray-700">
            Nhập số lượng khách
          </label>

          <input
            type="number"
            min={1}
            value={guestCount}
            onChange={e => setGuestCount(Number(e.target.value))}
            className="w-full rounded-lg border px-3 py-2 text-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
          />

          <div className="mt-5 flex justify-end gap-3">
            <button
              onClick={() => setModalOpen(false)}
              className="rounded-lg border px-4 py-2 text-gray-700 transition hover:bg-gray-100"
            >
              Hủy
            </button>

            <button
              onClick={handleConfirm}
              className="rounded-lg bg-indigo-600 px-4 py-2 font-medium text-white shadow hover:bg-indigo-700"
            >
              Xác nhận
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default TableOrder;
