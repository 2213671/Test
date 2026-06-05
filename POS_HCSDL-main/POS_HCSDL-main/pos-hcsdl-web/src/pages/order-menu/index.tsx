import { useEffect, useMemo, useState } from 'react';
import { useRestaurant } from '@/contexts/RestaurantContext';
import {
  type OrderItemHistoryResponseZodType,
  type ProductResponseZodType,
  useAddOrder,
  useCreateOrder,
  useGetMenusByRestaurant,
  useGetOrderHistoryByOrder,
  useGetProductsByMenu,
  useGetTableById,
} from '@/api/pos';
import { Modal } from '@/components/modal';
import { useLocation, useNavigate, useParams } from 'react-router-dom';
import { useAuth } from '@/contexts/AuthContext.tsx';
import { fmtCurrency, fmtDate } from '@/utils';

interface CartItem {
  product: ProductResponseZodType;
  quantity: number;
  options: { [optionId: string]: { id: string; name: string } };
  toppings: { [toppingId: string]: { id: string; name: string; quantity: number } };
}

const OrderMenu = () => {
  const { user } = useAuth();
  const { restaurant, shift } = useRestaurant();
  const { id } = useParams();
  const { state } = useLocation();
  const { data: table, refetch: refetchTable } = useGetTableById(id!);

  const { data: menus } = useGetMenusByRestaurant(restaurant?.id || '');
  const [selectedMenu, setSelectedMenu] = useState<string | null>(null);
  const { data: products } = useGetProductsByMenu(selectedMenu || '');

  const [cart, setCart] = useState<CartItem[]>([]);
  const [selectedProduct, setSelectedProduct] = useState<ProductResponseZodType | null>(null);
  const [modalOpen, setModalOpen] = useState(false);

  const [modalHistory, setModalHistory] = useState(false);

  const { data: history, refetch: refetchHistory } = useGetOrderHistoryByOrder(
    table?.orderId || ''
  );

  const [productQuantity, setProductQuantity] = useState(1);
  const [optionQuantities, setOptionQuantities] = useState<{ [id: string]: number }>({});
  const [toppingQuantities, setToppingQuantities] = useState<{ [id: string]: number }>({});

  useEffect(() => {
    if (menus) setSelectedMenu(menus[0]?.id as string);
  }, [menus]);

  const openProductModal = (product: ProductResponseZodType) => {
    setSelectedProduct(product);
    setProductQuantity(1);

    const optionsInit: { [id: string]: number } = {};
    product.options?.forEach(opt => {
      optionsInit[opt.id!] = opt.required ? 1 : 0;
    });
    setOptionQuantities(optionsInit);

    const toppingsInit: { [id: string]: number } = {};
    product.toppings?.forEach(top => {
      toppingsInit[top.id!] = 0;
    });
    setToppingQuantities(toppingsInit);

    setModalOpen(true);
  };

  const handleAddToCart = () => {
    if (!selectedProduct) return;

    // Validate options bắt buộc
    for (const opt of selectedProduct.options || []) {
      if (opt.required && optionQuantities[opt.id!] === 0) {
        alert(`Tùy chọn ${opt.name} là bắt buộc`);
        return;
      }
    }

    // Validate topping max
    for (const top of selectedProduct.toppings || []) {
      const qty = toppingQuantities[top.id!] || 0;
      if (qty > top.maxQuantity!) {
        alert(`Topping ${top.name} vượt quá số lượng tối đa`);
        return;
      }
    }

    // Chuẩn hoá options được chọn -> Set ID
    const selectedOptionIds = new Set(
      selectedProduct.options?.filter(opt => optionQuantities[opt.id!] > 0).map(opt => opt.id!) ||
        []
    );

    // Chuẩn hoá toppings được chọn -> Map { id: quantity }
    const selectedToppings: Record<string, number> = {};
    selectedProduct.toppings?.forEach(top => {
      const qty = toppingQuantities[top.id!] || 0;
      if (qty > 0) selectedToppings[top.id!] = qty;
    });

    setCart(prevCart => {
      // Tìm xem có món nào trùng hoàn toàn không
      const existingIndex = prevCart.findIndex(item => {
        if (item.product.id !== selectedProduct.id) return false;

        // So sánh options (so sánh Set)
        const itemOptionIds = new Set(Object.keys(item.options));
        if (
          itemOptionIds.size !== selectedOptionIds.size ||
          [...itemOptionIds].some(id => !selectedOptionIds.has(id))
        ) {
          return false;
        }

        // So sánh toppings
        const itemTop = item.toppings;
        const newTop = selectedToppings;

        const itemTopIds = Object.keys(itemTop);
        const newTopIds = Object.keys(newTop);

        if (itemTopIds.length !== newTopIds.length) return false;

        for (const id of newTopIds) {
          if (!itemTop[id] || itemTop[id].quantity !== newTop[id]) return false;
        }

        return true;
      });

      // Nếu tìm thấy item giống -> cộng dồn số lượng
      if (existingIndex !== -1) {
        const updatedCart = [...prevCart];
        const item = updatedCart[existingIndex];

        // Tăng số lượng món
        item.quantity += productQuantity;

        // Tăng topping.quantity
        Object.keys(selectedToppings).forEach(id => {
          item.toppings[id].quantity += selectedToppings[id] * productQuantity;
        });

        return updatedCart;
      }

      // Không tìm thấy -> tạo item mới
      const newItem: CartItem = {
        product: selectedProduct,
        quantity: productQuantity,
        options: {},
        toppings: {},
      };

      selectedOptionIds.forEach(id => {
        const opt = selectedProduct.options!.find(o => o.id === id)!;
        newItem.options[id] = { id, name: opt.name! };
      });

      Object.keys(selectedToppings).forEach(id => {
        const top = selectedProduct.toppings!.find(t => t.id === id)!;
        newItem.toppings[id] = {
          id,
          name: top.name!,
          quantity: selectedToppings[id] * productQuantity,
        };
      });

      return [...prevCart, newItem];
    });

    setModalOpen(false);
  };

  const { mutate: handleOrder } = useCreateOrder({
    mutation: {
      onSuccess: () => {
        refetchTable();
        setCart([]);
        alert('Tạo đơn hàng thành công');
      },
    },
  });

  const { mutate: handleCreate } = useAddOrder({
    mutation: {
      onSuccess: () => {
        alert('Gọi thêm món thành công');
        setCart([]);
      },
    },
  });

  const handlePlaceOrder = () => {
    (table?.orderId ? handleCreate : handleOrder)({
      data: {
        ...(table?.orderId
          ? { orderId: table?.orderId }
          : {
              tableId: table?.id,
              shiftId: shift?.id,
              creatorId: user?.id,
              customerCount: state?.guestCount,
            }),
        items: cart.map(item => ({
          itemId: item.product.id,
          quantity: item.quantity,
          itemType: 'PRODUCT',
          subItems: [
            ...Object.values(item.options).map(opt => ({
              itemId: opt.id,
              itemType: 'OPTION',
              quantity: item.quantity,
            })),
            ...Object.values(item.toppings).map(top => ({
              itemId: top.id,
              itemType: 'TOPPING',
              quantity: item.quantity * top.quantity,
            })),
          ],
        })),
      },
    });
  };

  const navigate = useNavigate();

  const groupedHistory = useMemo(() => {
    if (!history) return {};

    return history.reduce(
      (acc, item) => {
        if (!acc[item.requestId!]) acc[item.requestId!] = [];
        acc[item.requestId!].push(item);
        return acc;
      },
      {} as Record<string, OrderItemHistoryResponseZodType[]>
    );
  }, [history]);

  return (
    <div className="pb-40">
      {/* Header */}
      <div className="mb-6 flex items-center justify-between">
        <h1 className="text-3xl font-semibold text-indigo-700">Gọi món</h1>

        {table?.orderId && (
          <div className="flex gap-3">
            <button
              className="rounded-lg border border-indigo-200 bg-white px-4 py-2 text-indigo-700 shadow-sm transition hover:bg-indigo-50"
              onClick={() => {
                refetchHistory();
                setModalHistory(true);
              }}
            >
              Lịch sử
            </button>

            <button
              className="rounded-lg bg-indigo-600 px-4 py-2 text-white shadow-md hover:bg-indigo-700"
              onClick={() => navigate('/payment/' + table?.orderId)}
            >
              Thanh toán
            </button>
          </div>
        )}
      </div>

      {/* Menu selector */}
      <div className="mb-6 flex gap-2 overflow-x-auto pb-1">
        {menus?.map(menu => (
          <button
            key={menu.id}
            className={`rounded-full px-4 py-2 shadow-sm transition ${
              selectedMenu === menu.id
                ? 'bg-indigo-600 text-white'
                : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200'
            }`}
            onClick={() => setSelectedMenu(menu.id!)}
          >
            {menu.name}
          </button>
        ))}
      </div>

      {/* Product Grid */}
      <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
        {products?.map(product => (
          <div
            key={product.id}
            className="group cursor-pointer overflow-hidden rounded-xl border border-indigo-100 bg-white shadow-sm transition hover:shadow-lg"
            onClick={() => openProductModal(product)}
          >
            <div className="overflow-hidden">
              <img
                src={product.imageUrl as string}
                alt={product.name!}
                className="h-40 w-full rounded-t-xl object-cover transition group-hover:scale-105"
              />
            </div>

            <div className="p-3">
              <p className="font-semibold text-indigo-700">{product.name}</p>
              <p className="max-h-10 overflow-hidden text-sm text-indigo-500">
                {product.description}
              </p>

              <p className="mt-2 text-lg font-semibold text-indigo-800">
                {fmtCurrency(product.price)}
              </p>
            </div>
          </div>
        ))}
      </div>

      {/* ============ MODAL PRODUCT ============ */}
      <Modal isOpen={modalOpen} onClose={() => setModalOpen(false)} title={selectedProduct?.name!}>
        <div className="space-y-6">
          {/* Quantity */}
          <div className="flex items-center justify-between">
            <p className="font-medium text-indigo-700">Số lượng</p>

            <div className="flex items-center gap-3">
              <button
                onClick={() => setProductQuantity(prev => Math.max(1, prev - 1))}
                className="rounded-full bg-indigo-100 p-2 text-indigo-600 hover:bg-indigo-200"
              >
                −
              </button>
              <span className="min-w-6 text-center text-lg font-semibold text-indigo-800">
                {productQuantity}
              </span>
              <button
                onClick={() => setProductQuantity(prev => prev + 1)}
                className="rounded-full bg-indigo-100 p-2 text-indigo-600 hover:bg-indigo-200"
              >
                +
              </button>
            </div>
          </div>

          {/* Options */}
          {(selectedProduct?.options?.length || 0) > 0 && (
            <div>
              <p className="mb-2 text-lg font-semibold text-indigo-700">Tùy chọn</p>

              <div className="space-y-3">
                {selectedProduct.options?.map(opt => (
                  <label
                    key={opt.id}
                    className="flex items-center justify-between rounded-lg border px-3 py-2 shadow-sm"
                  >
                    <span className="text-indigo-700">
                      {opt.name} {opt.required && <span className="text-red-500">*</span>}
                    </span>
                    <input
                      type="radio"
                      name={`option-${selectedProduct.id}`}
                      checked={optionQuantities[opt.id!] > 0}
                      onChange={() => setOptionQuantities({ [opt.id!]: 1 })}
                      className="h-4 w-4 accent-indigo-600"
                    />
                  </label>
                ))}
              </div>
            </div>
          )}

          {/* Toppings */}
          {(selectedProduct?.toppings?.length || 0) > 0 && (
            <div>
              <p className="mb-2 text-lg font-semibold text-indigo-700">Topping</p>

              <div className="space-y-3">
                {selectedProduct.toppings?.map(top => (
                  <div
                    key={top.id}
                    className="flex items-center justify-between rounded-lg border px-3 py-2 shadow-sm"
                  >
                    <span className="text-indigo-700">
                      {top.name} (tối đa {top.maxQuantity})
                    </span>

                    <div className="flex items-center gap-2">
                      <button
                        onClick={() =>
                          setToppingQuantities(prev => ({
                            ...prev,
                            [top.id!]: Math.max(0, (prev[top.id!] || 0) - 1),
                          }))
                        }
                        className="rounded-full bg-indigo-100 px-3 py-1 text-indigo-600 hover:bg-indigo-200"
                      >
                        −
                      </button>

                      <span className="w-6 text-center text-indigo-700">
                        {toppingQuantities[top.id!] || 0}
                      </span>

                      <button
                        onClick={() =>
                          setToppingQuantities(prev => ({
                            ...prev,
                            [top.id!]: Math.min(top.maxQuantity!, (prev[top.id!] || 0) + 1),
                          }))
                        }
                        className="rounded-full bg-indigo-100 px-3 py-1 text-indigo-600 hover:bg-indigo-200"
                      >
                        +
                      </button>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          <div className="flex justify-end gap-3">
            <button
              onClick={() => setModalOpen(false)}
              className="rounded-lg border border-indigo-300 px-4 py-2 text-indigo-700 hover:bg-indigo-50"
            >
              Hủy
            </button>

            <button
              onClick={handleAddToCart}
              className="rounded-lg bg-indigo-600 px-5 py-2 text-white shadow hover:bg-indigo-700"
            >
              Thêm vào giỏ
            </button>
          </div>
        </div>
      </Modal>

      {/* ============ MODAL HISTORY ============ */}
      <Modal isOpen={modalHistory} onClose={() => setModalHistory(false)} title="Lịch sử gọi món">
        <div className="max-h-[70vh] overflow-y-auto px-1">
          {!history || history.length === 0 ? (
            <p className="py-6 text-center text-gray-500">Chưa có lịch sử</p>
          ) : (
            <div className="space-y-4">
              {Object.entries(groupedHistory).map(([reqId, items]) => (
                <div
                  key={reqId}
                  className="rounded-xl border border-gray-200 bg-gray-50 p-4 shadow-sm"
                >
                  <div className="mb-3 text-sm text-gray-600">
                    <div className="flex justify-between">
                      <span className="font-medium">Mã yêu cầu:</span>
                      <span>{reqId}</span>
                    </div>
                    <div className="flex justify-between">
                      <span className="font-medium">Thời gian:</span>
                      <span>{fmtDate(items[0].orderAt)}</span>
                    </div>
                  </div>

                  <div className="space-y-3">
                    {items.map(item => (
                      <div
                        key={item.id}
                        className="flex items-start gap-3 rounded-lg bg-white p-3 shadow-sm"
                      >
                        <img
                          src={item.imageUrl}
                          className="h-14 w-14 rounded-lg object-cover"
                          alt=""
                        />

                        <div className="flex-1">
                          <div className="flex justify-between">
                            <div className="font-semibold text-gray-800">{item.name}</div>
                            <div className="text-sm font-medium text-indigo-600">
                              {fmtCurrency(item.price)}
                            </div>
                          </div>

                          <div className="mt-1 text-xs text-gray-500">
                            SL: {item.quantity} — {item.orderHistoryStatus}
                          </div>

                          {item.subItems?.length > 0 && (
                            <div className="mt-2 rounded-lg bg-gray-50 p-2 text-sm">
                              <p className="mb-1 font-medium text-gray-700">Chi tiết:</p>

                              <div className="space-y-1">
                                {item.subItems.map(s => (
                                  <div key={s.id} className="flex justify-between text-gray-700">
                                    <span>- {s.name}</span>
                                    <span>
                                      {fmtCurrency(s.price)} × {s.quantity}
                                    </span>
                                  </div>
                                ))}
                              </div>
                            </div>
                          )}
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </Modal>

      {/* Cart */}
      {cart.length > 0 && (
        <div className="fixed right-6 bottom-6 w-80 rounded-2xl border border-indigo-200 bg-white p-4 shadow-xl">
          <h3 className="mb-3 text-lg font-semibold text-indigo-700">
            Giỏ hàng ({cart.length} món)
          </h3>

          <div className="max-h-64 space-y-2 overflow-y-auto pr-1">
            {cart.map((item, idx) => (
              <div key={idx} className="rounded border bg-indigo-50 p-2 text-indigo-800">
                {item.product.name} × {item.quantity}
              </div>
            ))}
          </div>

          <button
            onClick={handlePlaceOrder}
            className="mt-4 w-full rounded-lg bg-indigo-600 py-2 text-white shadow hover:bg-indigo-700"
          >
            Xác nhận gọi món
          </button>
        </div>
      )}
    </div>
  );
};

export default OrderMenu;
