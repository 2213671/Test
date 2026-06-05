import { useRestaurant } from '@/contexts/RestaurantContext.tsx';
import { useCloseShift, useGetShiftInfo, useOpenShift } from '@/api/pos';
import { useAuth } from '@/contexts/AuthContext.tsx';
import { fmtCurrency } from '@/utils';

export default function ShiftManagement() {
  const { user } = useAuth();
  const { shift: currentShift, reloadShift } = useRestaurant(); // giả sử context có 2 hàm mở/đóng ca

  const { mutate: open } = useOpenShift({
    mutation: {
      onSuccess: () => {
        reloadShift();
        refetch();
      },
    },
  });
  const { mutate: close } = useCloseShift({
    mutation: {
      onSuccess: () => {
        reloadShift();
        refetch();
      },
      onError: error => {
        alert(error.response?.data?.error);
      },
    },
  });

  const handleOpenShift = () => {
    open({
      data: {
        openerId: user?.id,
      },
    });
  };

  const handleCloseShift = () => {
    close({
      data: {
        closerId: user?.id,
      },
    });
  };

  const { data: shift, refetch } = useGetShiftInfo(currentShift?.id as string, {
    query: {
      enabled: !!currentShift?.id,
    },
  });

  const isCurrentOpen = shift?.openerId && !shift?.closerId;
  const isClosed = shift?.openerId && shift?.closerId;

  // if (!shift) {
  //   return <p className="text-gray-500">Chưa có ca nào trong nhà hàng.</p>;
  // }

  return (
    <div className="">
      <h1 className="mb-4 text-2xl font-semibold text-indigo-700">Quản lý ca</h1>

      <div className="space-y-5 rounded-lg border border-indigo-200 bg-white p-6">
        {shift && (
          <>
            {/* Thông tin ca */}
            <div className="flex flex-col justify-between gap-4 md:flex-row">
              <div className="space-y-1">
                <p className="font-medium">
                  Người mở ca: <span className="text-indigo-700">{shift.openerName}</span>
                </p>
                <p className="font-medium">
                  Thời gian mở: {new Date(shift.openAt!).toLocaleString()}
                </p>
                {shift.closerId && (
                  <p className="font-medium">
                    Người đóng ca: <span className="text-indigo-700">{shift.closerName}</span>
                  </p>
                )}
                {shift.closeAt && (
                  <p className="font-medium">
                    Thời gian đóng: {new Date(shift.closeAt).toLocaleString()}
                  </p>
                )}
              </div>
              <div className="flex items-start">
                <span
                  className={`rounded px-3 py-1 font-medium text-white ${
                    isCurrentOpen ? 'bg-green-500' : 'bg-gray-400'
                  }`}
                >
                  {isCurrentOpen ? 'Đang mở' : isClosed ? 'Đã đóng' : 'Chưa mở ca'}
                </span>
              </div>
            </div>

            {/* Thông tin tổng hợp */}
            <div className="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
              <StatBox label="Tổng đơn" value={shift.totalOrder!} format={false} />
              <StatBox label="Tổng món" value={shift.totalItem!} />
              <StatBox label="Tổng tiền" value={shift.totalAmount!} />
              <StatBox label="Đã nhận từ khách" value={shift.totalAmountReceivedFromCustomer!} />
              <StatBox label="Chiết khấu" value={shift.totalAmountDiscount!} />
              <StatBox label="Tiền thối" value={shift.totalAmountChangeGivenToCustomer!} />
            </div>

            {/* Phương thức thanh toán */}
            <div>
              <p className="mb-2 font-medium">Phương thức thanh toán:</p>
              {shift.amountPaymentMethods?.length ? (
                <div className="flex flex-wrap gap-2">
                  {shift.amountPaymentMethods.map(pm => (
                    <div key={pm.name} className="rounded bg-indigo-100 p-2">
                      {pm.name}: <span className="font-semibold">{fmtCurrency(pm.amount)}</span>
                    </div>
                  ))}
                </div>
              ) : (
                <p className="text-gray-500 italic">Chưa có phương thức thanh toán</p>
              )}
            </div>
          </>
        )}

        {/* Nút mở / đóng ca */}
        <div className="mt-4 flex gap-3">
          {!isCurrentOpen ? (
            <button
              className="flex-1 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600"
              onClick={handleOpenShift}
              disabled={!!isCurrentOpen} // không thể mở ca khi ca đang mở
            >
              Mở ca
            </button>
          ) : (
            <button
              className="flex-1 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600"
              onClick={handleCloseShift}
              disabled={!isCurrentOpen} // chỉ đóng khi ca đang mở
            >
              Đóng ca
            </button>
          )}
        </div>
      </div>
    </div>
  );
}

// Component phụ để hiển thị ô thống kê
const StatBox = ({ label, value, format = true }: { label: string; value: string | number, format: boolean }) => (
  <div className="rounded bg-indigo-50 p-3 text-center">
    <p className="text-sm text-gray-600">{label}</p>
    <p className="font-semibold">{format ? fmtCurrency(value): value}</p>
  </div>
);
