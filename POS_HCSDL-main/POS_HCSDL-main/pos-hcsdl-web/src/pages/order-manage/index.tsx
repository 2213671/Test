import { useState } from 'react';
import { type OrderResponseZodType, useGetOrderLookup, useGetSummaryRestaurant } from '@/api/pos';
import Datepicker from 'react-tailwindcss-datepicker';
import { format } from 'date-fns';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';

export default function OrderManagement() {
  const {restaurant}  = useRestaurant();
  const [statusFilter, setStatusFilter] = useState('ALL');
  const [page, setPage] = useState(0);
  const [pageSize] = useState(10);
  const [selectedOrder, setSelectedOrder] = useState<OrderResponseZodType | null>(null);
  const [dateRange, setDateRange] = useState({ startDate: new Date(), endDate: new Date() });

  const handleDateChange = (newVal) => {
    if (newVal && typeof newVal === 'object') {
      setDateRange({ startDate: newVal.startDate || null, endDate: newVal.endDate || null });
      setPage(0); // reset page khi đổi date
    }
  };

  const {data: summary} = useGetSummaryRestaurant(restaurant?.id as string)

  const {
    data: orderLookup,
    fetchNextPage,
    hasNextPage,
    isFetching,
    fetchPreviousPage,
    hasPreviousPage,
  } = useGetOrderLookup(
    {
      orderStatus: statusFilter,
      pageNo: page,
      pageSize,
      startDate: format(dateRange.startDate, 'yyyy-MM-dd'),
      endDate: format(dateRange.endDate, 'yyyy-MM-dd'),
    },
    {
      query: {
        queryKey: ['order-lookup', dateRange, page, pageSize, statusFilter, restaurant],
        getNextPageParam:  (lastPage) => {
          if (lastPage?.pageNo! + 1 < lastPage.totalPages!) {
            return lastPage?.pageNo! + 1;
          }
          return undefined; // không còn page
        },
        getPreviousPageParam: (previousPage) => {
          if (previousPage?.pageNo! - 1 >= 0) {
            return previousPage?.pageNo! - 1
          }
          return undefined;
        }
      },
    }
  );

  function formatMoney(v) {
    return v != null ? v.toLocaleString('vi-VN') + ' ₫' : '-';
  }

  const pageContent =( orderLookup as any)?.pages.flatMap(page => page.content) ?? [];
  const totalPages = (orderLookup as any)?.pages?.[0].totalPages || 1;

  return (
    <div className="min-h-screen bg-gray-50 p-6">
      {/* Summary */}
      {summary && (
        <div className="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
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
      <header className="mb-6 flex items-center justify-between">
        <h1 className="text-2xl font-semibold text-indigo-700">Quản lý Orders</h1>
        <div className="flex items-center gap-3">
          <div className="w-64 date-picker">
            <Datepicker value={dateRange} onChange={handleDateChange} primaryColor="indigo" />
          </div>
          <select
            value={statusFilter}
            onChange={(e) => { setStatusFilter(e.target.value); setPage(0); }}
            className="rounded-md border px-3 py-2"
          >
            <option value="ALL">Tất cả</option>
            <option value="COMPLETED">COMPLETED</option>
            <option value="IN_PROGRESS">IN_PROGRESS</option>
          </select>
        </div>
      </header>

      <main>
        <div className="overflow-x-auto bg-white rounded-lg shadow">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-indigo-50">
            <tr>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Mã</th>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Bàn</th>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Nhân viên</th>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Tổng (₫)</th>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Trạng thái</th>
              <th className="px-4 py-3 text-left text-sm font-medium text-indigo-700">Thời gian</th>
              <th className="px-4 py-3 text-right text-sm font-medium text-indigo-700">Hành động</th>
            </tr>
            </thead>
            <tbody className="divide-y divide-gray-100">
            {pageContent.length > 0 ? (
              pageContent.map((o) => (
                <tr key={o.id} className="hover:bg-indigo-50">
                  <td className="px-4 py-3 text-sm font-medium text-gray-800">{o.code}</td>
                  <td className="px-4 py-3 text-sm text-gray-600">{o.tableName}</td>
                  <td className="px-4 py-3 text-sm text-gray-600">{o.creatorName}</td>
                  <td className="px-4 py-3 text-sm text-gray-800">{formatMoney(o.finalAmount)}</td>
                  <td className="px-4 py-3 text-sm">
                      <span className="inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold bg-indigo-100 text-indigo-800">
                        {o.orderStatus}
                      </span>
                  </td>
                  <td className="px-4 py-3 text-sm text-gray-500">{o.createdAt ? new Date(o.createdAt).toLocaleString() : '-'}</td>
                  <td className="px-4 py-3 text-right text-sm">
                    <button
                      onClick={() => setSelectedOrder(o)}
                      className="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm"
                    >
                      Xem
                    </button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan={7} className="px-4 py-6 text-center text-gray-500">
                  Không có order nào
                </td>
              </tr>
            )}
            </tbody>
          </table>
        </div>

        {/* Pagination */}
        <div className="mt-4 flex items-center justify-between">
          <div className="text-sm text-gray-600">Tổng {pageContent.length || 0} kết quả</div>
          <div className="flex items-center gap-2">
            <button
              onClick={() => { if (hasPreviousPage) { setPage((p) => p - 1); fetchPreviousPage?.(); } }}
              className="rounded border px-3 py-1"
              disabled={!hasPreviousPage}
            >
              Trước
            </button>
            <div className="rounded border px-3 py-1">
              {page + 1} / {totalPages}
            </div>
            <button
              onClick={() => { if (hasNextPage) { setPage((p) => p + 1); fetchNextPage?.(); } }}
              className="rounded border px-3 py-1"
              disabled={!hasNextPage}
            >
              Sau
            </button>
          </div>
        </div>
        {/* Drawer / Detail */}
        {selectedOrder && (
          <div className="fixed inset-0 z-50 flex">
            {/* Overlay */}
            <div
              className="flex-1 bg-black/20"
              onClick={() => setSelectedOrder(null)}
            />

            {/* Drawer */}
            <div className="w-full max-w-2xl bg-white shadow-xl p-6 overflow-auto flex flex-col gap-6">

              {/* --- Thông tin order --- */}
              <section className="flex items-start justify-between">
                <div className="flex-1 flex flex-col gap-1">
                  <h2 className="text-xl font-semibold text-indigo-700">
                    Order {selectedOrder.code}
                  </h2>
                  <div className="text-sm text-gray-600">Bàn: {selectedOrder.tableName}</div>
                  <div className="text-sm text-gray-600">Nhân viên: {selectedOrder.creatorName}</div>
                  <div className="text-sm text-gray-600">SL khách: {selectedOrder.customerCount}</div>
                  <div className="text-sm text-gray-500">Trạng thái: {selectedOrder.orderStatus}</div>
                  <div className="text-sm text-gray-500">
                    Tạo lúc: {new Date(selectedOrder.createdAt).toLocaleString()}
                  </div>
                </div>
                <button
                  onClick={() => setSelectedOrder(null)}
                  className="text-gray-500"
                >
                  Đóng
                </button>
              </section>

              {/* --- Món ăn --- */}
              <section>
                <h3 className="text-sm font-medium text-gray-700 mb-2">Món</h3>
                <ul className="divide-y divide-gray-100">
                  {selectedOrder?.orderItems?.map((it) => {
                    const options = it.subItems?.filter(s => s.itemType === "OPTION") || [];
                    const toppings = it.subItems?.filter(s => s.itemType === "TOPPING") || [];

                    return (
                      <li key={it.id} className="py-3 flex gap-4 items-start">
                        <img
                          src={it.imageUrl}
                          alt={it.name}
                          className="w-16 h-16 rounded-md object-cover border"
                        />
                        <div className="flex-1 flex flex-col gap-1">
                          <div className="font-medium text-gray-800">{it.name}</div>
                          <div className="text-sm text-gray-600">SL: {it.quantity}</div>

                          {/* Giá hiển thị */}
                          <div className="text-sm text-gray-700">
                            {it.discountValue > 0 ? (
                              <>
                                <span className="line-through text-gray-400">{formatMoney(it.price)}</span>{" "}
                                <span className="font-semibold">{formatMoney(it.discountedPrice)}</span>
                              </>
                            ) : (
                              <span className="font-semibold">{formatMoney(it.price)}</span>
                            )}
                          </div>

                          {/* Options */}
                          {options.length > 0 && (
                            <div className="mt-1 text-sm text-gray-600">
                              + Option: {options.map(s => `${s.name} (${formatMoney(s.price)})`).join(', ')}
                            </div>
                          )}

                          {/* Toppings */}
                          {toppings.length > 0 && (
                            <div className="mt-1 text-sm text-gray-600">
                              + Topping: {toppings.map(s => `${s.name} (${formatMoney(s.price)})`).join(', ')}
                            </div>
                          )}
                        </div>
                      </li>
                    )
                  })}
                </ul>
              </section>

              {/* --- Tổng quan thanh toán --- */}
              <section className="grid grid-cols-1 gap-2">
                <div className="bg-gray-50 p-3 rounded">
                  <div className="text-sm text-gray-600">Tổng tiền</div>
                  <div className="text-lg font-semibold text-gray-800">{formatMoney(selectedOrder.totalPrice)}</div>
                </div>
                <div className="bg-gray-50 p-3 rounded flex flex-col gap-1">
                  <div className="text-sm text-gray-600">Thanh toán</div>
                  <div className="text-lg font-semibold text-gray-800">{formatMoney(selectedOrder.finalAmount)}</div>
                  {selectedOrder.orderStatus === "COMPLETED" && (
                    <div className="text-sm text-gray-500">
                      Nhận từ khách: {formatMoney(selectedOrder.amountReceivedFromCustomer)} • Trả lại: {formatMoney(selectedOrder.amountChangeGivenToCustomer)}
                    </div>
                  )}
                </div>
              </section>

              {/* --- Khuyến mãi --- */}
              {selectedOrder.promotion && (
                <section className="p-3 rounded bg-indigo-50 border-l-4 border-indigo-200">
                  <div className="text-sm font-medium text-indigo-700">
                    Khuyến mãi: {selectedOrder.promotion.promotionName}
                  </div>
                  <div className="text-sm text-gray-600 mt-1">
                    Loại: {selectedOrder.promotion.promotionType} • Giá trị: {selectedOrder.promotion.promotionValue}
                  </div>
                  <div className="text-sm text-gray-500 mt-1">
                    Áp dụng lúc: {new Date(selectedOrder.promotion.applyAt).toLocaleString()}
                  </div>
                  <div className="text-sm text-gray-500 mt-1">
                    Số tiền trước KM: {formatMoney(selectedOrder.promotion.amountBeforePromotion)} • Sau KM: {formatMoney(selectedOrder.promotion.amountAfterPromotion)}
                  </div>
                </section>
              )}

              {/* --- Action buttons --- */}
              <section className="flex justify-end gap-2">
                <button className="px-4 py-2 rounded border">In hoá đơn</button>
                <button className="px-4 py-2 rounded bg-indigo-600 text-white">Đánh dấu hoàn tất</button>
              </section>
            </div>
          </div>
        )}


      </main>
    </div>
  );
}
