import {
  applyPromotion,
  type OrderItemHistoryResponseZodType,
  type OrderItemResponseZodType,
  type OrderResponseZodType,
  type PaymentMethodResponseZodType,
  type PromotionResponseZodType,
  useApplyPromotion,
  useGetOrderById,
  useGetOrderHistoryByOrder,
  useGetPaymentMethodsByRestaurant,
  useGetPromotionsByRestaurant,
  usePayment,
} from '@/api/pos';
import { useNavigate, useParams } from 'react-router-dom';
import { useEffect, useMemo, useState } from 'react';
import { useRestaurant } from '@/contexts/RestaurantContext.tsx';
import { paths } from '@/router/nav';
import { fmtCurrency } from '@/utils';

type OrderItemWithPromotion = OrderItemResponseZodType & {
  promotionApply?: PromotionResponseZodType;
};

type OrderType = Omit<OrderResponseZodType, 'orderItems'> & {
  orderItems?: OrderItemWithPromotion[];
  promotionApply?: PromotionResponseZodType;
};

export default function OrderDetails() {
  const { restaurant } = useRestaurant();
  const { orderId } = useParams();
  const { data: orderData } = useGetOrderById(orderId as string);
  const { data: promotions } = useGetPromotionsByRestaurant(restaurant?.id as string);
  const { data: paymentMethods } = useGetPaymentMethodsByRestaurant(restaurant?.id as string);
  const { mutate: payment } = usePayment({
    mutation: {
      onSuccess: () => {
        alert('Payment success');
        navigate(paths.tableOrder, { replace: true });
      },
      onError: error => {
        alert(error.response?.data?.error);
      },
    },
  });
  const navigate = useNavigate();
  const [order, setOrder] = useState<OrderType | null>(null);
  const [selectedPromoId, setSelectedPromoId] = useState('');

  // validate promo by date range and daily start/end time
  const isPromoValid = promo => {
    if (!promo) return false;
    const now = new Date();

    // date-only comparison (use midnight-local)
    const start = new Date(promo.startDate);
    const end = new Date(promo.endDate);
    if (now < start || now > end) return false;

    // parse HH:MM:SS
    const parseHMS = s => {
      const [hh, mm, ss] = s.split(':').map(x => parseInt(x, 10) || 0);
      return hh * 60 + mm;
    };

    const startMinutes = parseHMS(promo.startHour || '00:00:00');
    const endMinutes = parseHMS(promo.endHour || '23:59:59');
    const nowMinutes = now.getHours() * 60 + now.getMinutes();

    return nowMinutes >= startMinutes && nowMinutes <= endMinutes;
  };

  useEffect(() => {
    if (orderData) {
      setOrder(orderData as OrderType);
    }
  }, [orderData]);

  const selectedPromo = useMemo(
    () => promotions?.find(p => p.id === selectedPromoId) || null,
    [promotions, selectedPromoId]
  );
  const selectedPromoIsValid = isPromoValid(selectedPromo);

  const { data: orderPromotion, error: errorApply } = useApplyPromotion(
    order?.id as string,
    { promotionId: selectedPromoId },
    {
      query: {
        queryKey: ['applyPromotion', selectedPromoId],
        enabled: !!selectedPromoId && selectedPromoIsValid,
      },
    }
  );

  useEffect(() => {
    if (errorApply) {
      alert(errorApply.response?.data.error);
      setSelectedPromoId('');
    }
  }, [errorApply]);

  useEffect(() => {
    if (orderPromotion) {
      setOrder(orderPromotion as OrderType);
    }
  }, [orderPromotion]);

  useEffect(() => {
    if (!selectedPromoId) {
      setOrder(orderData as OrderType);
    }
  }, [selectedPromoId]);

  const fmtDate = iso => {
    try {
      return new Date(iso).toLocaleString('vi-VN');
    } catch {
      return iso;
    }
  };

  const [paymentMethodAmount, setPaymentMethodAmount] = useState<
    {
      id: string;
      code: string;
      name: string;
      amount: number;
    }[]
  >([]);

  const handleFillPaymentMethod = (pm: PaymentMethodResponseZodType, amount: number) => {
    setPaymentMethodAmount(prevState => {
      if (prevState.some(p => p.code === pm.code)) {
        return prevState.map(p => (p.code === pm.code ? { ...p, amount } : p));
      }
      return [...prevState, { code: pm.code!, id: pm.id!, name: pm.name!, amount }];
    });
  };

  const handleAmountCustomer = (type: 'received' | 'given') => {
    return (
      (paymentMethodAmount.reduce((sum, item) => sum + item.amount, 0) || 0) -
      (type === 'given' ? order?.finalAmount || 0 || 0 : 0)
    );
  };

  // useEffect(() => {
  //   if (selectedPromo && selectedPromoIsValid) {
  //     setOrder(prevState => {
  //       if (selectedPromo.applyType === 'ORDER') {
  //         return { ...prevState, promotionApply: selectedPromo };
  //       }
  //       return {
  //         ...prevState,
  //         orderItems: prevState?.orderItems?.map(item => ({
  //           ...item,
  //           promotionApply: selectedPromo.menus?.includes(item.menuId!) ? selectedPromo : undefined,
  //         })),
  //       };
  //     });
  //   } else {
  //     setOrder(prevState => {
  //       return {
  //         ...prevState,
  //         promotionApply: undefined,
  //         orderItems: prevState?.orderItems?.map(item => ({ ...item, promotionApply: undefined })),
  //       };
  //     });
  //   }
  // }, [selectedPromo]);

  const handleCalculatorPromotion = (price: number, promotion: PromotionResponseZodType) => {
    if (promotion.type === 'PERCENT') {
      return (price * (promotion?.value || 0)) / 100;
    }
    return Math.max(0, promotion.value || 0);
  };

  const handleAmountPromotion = () => {
    if (selectedPromo && selectedPromoIsValid) {
      if (selectedPromo.applyType === 'ORDER') {
        return handleCalculatorPromotion(order?.totalPrice || 0, selectedPromo);
      }

      return (
        order?.orderItems?.reduce(
          (sum: number, item) =>
            sum +
            (selectedPromo.menus?.includes(item.menuId!)
              ? item.quantity! * handleCalculatorPromotion(item.price || 0, selectedPromo)
              : 0),
          0
        ) || 0
      );
    }
    return 0;
  };

  const handlePayment = () => {
    payment({
      data: {
        orderId: orderId,
        paymentMethods: paymentMethodAmount.map(pm => ({
          id: pm.id,
          name: pm.name,
          amount: pm.amount,
        })),
        promotionId: selectedPromo?.id,
      },
    });
  };

  const [openHistory, setOpenHistory] = useState(false);
  const { data: orderItemHistory } = useGetOrderHistoryByOrder(orderId!);

  const groupedHistory = useMemo(() => {
    if (!orderItemHistory) return {};

    return orderItemHistory.reduce(
      (acc, item) => {
        if (!acc[item.requestId!]) acc[item.requestId!] = [];
        acc[item.requestId!].push(item);
        return acc;
      },
      {} as Record<string, OrderItemHistoryResponseZodType[]>
    );
  }, [orderItemHistory]);

  return (
    order && (
      <div className="mx-auto rounded-2xl bg-white p-6 shadow-md">
        <header className="mb-6 flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-semibold">
              Order <span className="text-indigo-600">{order.code}</span>
            </h1>
          </div>
          <div className="text-right">
            <div className="inline-flex items-center gap-2">
              <button
                onClick={() => setOpenHistory(true)}
                className="rounded bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700 hover:bg-gray-200"
              >
                Lịch sử gọi món
              </button>
              <button
                onClick={() => navigate(`/order/${order?.tableId}`)}
                className="rounded bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700 hover:bg-indigo-200"
              >
                Gọi món
              </button>
              <span className="rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-800">
                {order.orderStatus}
              </span>
            </div>
            <p className="mt-2 text-sm text-gray-500">
              Bàn: <span className="font-medium">{order.tableName}</span>
            </p>
          </div>
        </header>

        <section className="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
          <div className="col-span-2 max-h-[70vh] overflow-y-auto pr-2">
            <div className="col-span-2">
              <h2 className="mb-2 text-lg font-medium">Món</h2>
              <div className="divide-y overflow-hidden rounded-lg border border-gray-100">
                {order?.orderItems?.map(item => (
                  <div key={item.id} className="flex items-start gap-4 p-4">
                    <div className="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-100 text-sm text-gray-400">
                      {item.imageUrl ? (
                        <img
                          src={item.imageUrl}
                          alt={item.name!}
                          className="h-full w-full rounded-md object-cover"
                        />
                      ) : (
                        <span>Ảnh</span>
                      )}
                    </div>
                    <div className="flex-1">
                      <div className="flex items-start justify-between">
                        <div>
                          <div className="text-base font-semibold">{item.name}</div>
                        </div>
                        <div className="text-right">
                          <div className="font-medium">
                            {item.discountedPrice !== item.price ? (
                              <>
                                {fmtCurrency(item.discountedPrice)}
                                <span className={'line-through'}> ({fmtCurrency(item.price)})</span>
                              </>
                            ) : (
                              fmtCurrency(item.price)
                            )}
                          </div>
                          <div className="text-sm text-gray-500">Số lượng: {item.quantity}</div>
                        </div>
                      </div>

                      {item.subItems && item.subItems.length > 0 && (
                        <div className="mt-3 rounded bg-gray-50 p-3">
                          <div className="mb-2 text-sm font-medium text-gray-700">Thành phần</div>
                          <ul className="space-y-2 text-sm text-gray-600">
                            {item.subItems.map(s => (
                              <li key={s.id} className="flex justify-between">
                                <div>
                                  <div className="ms-3 font-medium">- {s.name}</div>
                                </div>
                                <div className="flex items-center gap-3 text-right">
                                  <div>{fmtCurrency(s.price)}</div>
                                  <div className="text-xs text-gray-500">SL: {s.quantity}</div>
                                </div>
                              </li>
                            ))}
                          </ul>
                        </div>
                      )}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
          {/* right: summary - sticky */}
          <aside className="sticky top-4 col-span-1 h-fit rounded-lg bg-gray-50 p-4">
            <h3 className="mb-3 text-lg font-medium">Tóm tắt</h3>

            <div className="space-y-2 text-sm text-gray-700">
              <div className="flex justify-between">
                <span>Giá tổng</span>
                <span className="font-medium">{fmtCurrency(order.totalPrice)}</span>
              </div>

              <div className="flex justify-between">
                <span>Tổng món</span>
                <span className="font-medium">{order.totalItem}</span>
              </div>
              {selectedPromoIsValid && (
                <div className="flex justify-between">
                  <span>Khuyến mãi</span>
                  <span className="font-medium">{fmtCurrency(order.amountDiscount)}</span>
                </div>
              )}

              <div className="flex justify-between">
                <span>Thanh toán cuối</span>
                <span className="font-medium">{fmtCurrency(order.finalAmount!)}</span>
              </div>

              <div className="flex justify-between">
                <span>Khách đưa</span>
                <span className="font-medium">
                  {fmtCurrency(
                    order.amountReceivedFromCustomer
                      ? order.amountReceivedFromCustomer
                      : handleAmountCustomer('received')
                  )}
                </span>
              </div>

              {(order.amountReceivedFromCustomer
                ? order.amountReceivedFromCustomer
                : handleAmountCustomer('received')) > 0 && (
                <div className="flex justify-between">
                  <span>Trả lại</span>
                  <span className="font-medium">
                    {fmtCurrency(
                      order.amountChangeGivenToCustomer
                        ? order.amountChangeGivenToCustomer
                        : handleAmountCustomer('given')
                    )}
                  </span>
                </div>
              )}
            </div>

            <div className="mt-4">
              <h3 className="mb-1 text-sm font-medium">Khuyến mãi</h3>
              <select
                className="w-full rounded border p-2 text-sm"
                value={selectedPromoId}
                onChange={e => setSelectedPromoId(e.target.value)}
              >
                <option value="">Chọn khuyến mãi</option>
                {promotions?.map(p => (
                  <option key={p.id} value={p.id!}>
                    {p.name} — {p.type === 'PERCENT' ? `${p.value}%` : fmtCurrency(p.value)}
                  </option>
                ))}
              </select>

              <div className="mt-1 text-xs text-gray-500">
                {selectedPromo ? (
                  selectedPromoIsValid ? (
                    <span>Khuyến mãi hợp lệ — Áp dụng được ngay</span>
                  ) : (
                    <span className="text-red-600">
                      Khuyến mãi không hợp lệ vào thời điểm hiện tại
                    </span>
                  )
                ) : (
                  <span>Chọn khuyến mãi để kiểm tra thời gian</span>
                )}
              </div>
            </div>
            <div className="mt-4">
              <h3 className="mb-1 text-sm font-medium">Phương thức thanh toán</h3>
              {paymentMethods?.map(pm => (
                <div key={pm.id} className="mb-2 flex items-center justify-between">
                  <span className="text-sm">{pm.name}</span>
                  <input
                    value={paymentMethodAmount?.find(p => p.code === pm.code)?.amount || 0}
                    onChange={amount => handleFillPaymentMethod(pm, parseInt(amount.target.value))}
                    type="number"
                    placeholder="Nhập số tiền"
                    className="w-28 rounded border p-1 text-sm"
                  />
                </div>
              ))}
            </div>
            <div className="mt-4 flex gap-3">
              <button className="w-full rounded-lg bg-gray-600 py-2 font-medium text-white hover:bg-gray-700">
                In hoá đơn
              </button>
              <button
                onClick={handlePayment}
                className="w-full rounded-lg bg-indigo-600 py-2 font-medium text-white hover:bg-indigo-700"
              >
                Thanh toán
              </button>
            </div>
            <div className="mt-4 border-t pt-3 text-xs text-gray-500">
              <div>
                Người tạo:{' '}
                <span className="font-medium">{order.creatorName || order.creatorId}</span>
              </div>
              <div>
                Ca: <span className="font-medium">{order.shiftId}</span>
              </div>
              <div>
                Ngày tạo: <span className="font-medium">{fmtDate(order.createdAt)}</span>
              </div>
              <div>
                Cập nhật: <span className="font-medium">{fmtDate(order.updatedAt)}</span>
              </div>
            </div>
          </aside>
        </section>

        <footer className="text-right text-sm text-gray-500">Order ID: {order.id}</footer>
        {openHistory && (
          <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div className="max-h-[80vh] w-[600px] overflow-y-auto rounded-xl bg-white p-4 shadow-xl">
              <div className="mb-3 flex items-center justify-between border-b pb-2">
                <h2 className="text-lg font-semibold">Lịch sử gọi món</h2>
                <button
                  onClick={() => setOpenHistory(false)}
                  className="text-gray-500 hover:text-gray-700"
                >
                  ✕
                </button>
              </div>

              {/* render grouped */}
              {Object.entries(groupedHistory).map(([reqId, items]) => (
                <div key={reqId} className="mb-5 rounded-lg border p-3">
                  <div className="mb-2 text-sm text-gray-500">
                    Request ID: <span className="font-medium">{reqId}</span>
                    <br />
                    Thời gian gọi: <span className="font-medium">{fmtDate(items[0].orderAt)}</span>
                  </div>

                  <div className="space-y-3">
                    {items.map(item => (
                      <div key={item.id} className="flex items-start gap-3 rounded bg-gray-50 p-3">
                        <img
                          src={item.imageUrl}
                          className="h-14 w-14 rounded object-cover"
                          alt=""
                        />
                        <div className="flex-1">
                          <div className="flex justify-between">
                            <div className="font-medium">{item.name}</div>
                            <div className="text-sm">{fmtCurrency(item.price)}</div>
                          </div>

                          <div className="text-xs text-gray-500">
                            SL: {item.quantity} — {item.orderHistoryStatus}
                          </div>

                          {/* sub items */}
                          {item.subItems?.length > 0 && (
                            <div className="mt-2 rounded bg-white p-2 text-sm text-gray-700">
                              {item.subItems.map(s => (
                                <div key={s.id} className="flex justify-between">
                                  <span>- {s.name}</span>
                                  <span>
                                    {fmtCurrency(s.price)} × {s.quantity}
                                  </span>
                                </div>
                              ))}
                            </div>
                          )}
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>
    )
  );
}
