 
import { z } from "zod";

type ToppingRequestType = {
  name?: string | null;
  maxQuantity?: number | null;
  price?: number | null;
};

type ToppingResponseType = {
  id?: string | null;
  name?: string | null;
  maxQuantity?: number | null;
  status?: string | null;
  restaurantId?: string | null;
  price?: number | null;
};

type TableRequestType = {
  name?: string | null;
};

type TableResponseType = {
  id?: string | null;
  name?: string | null;
  idx?: number | null;
  customerCount?: number | null;
  totalPrice?: number | null;
  totalItem?: number | null;
  status?: string | null;
  restaurantId?: string | null;
  orderId?: string | null;
};

type PromotionRequestType = {
  name?: string | null;
  type?: string | null;
  applyType?: string | null;
  value?: number | null;
  startDate?: string | null;
  endDate?: string | null;
  startHour?: string | null;
  endHour?: string | null;
  menus?: string[] | null;
};

type PromotionResponseType = {
  id?: string | null;
  name?: string | null;
  status?: string | null;
  value?: number | null;
  type?: string | null;
  applyType?: string | null;
  startDate?: string | null;
  endDate?: string | null;
  startHour?: string | null;
  endHour?: string | null;
  restaurantId?: string | null;
  menus?: string[] | null;
};

type PaymentMethodRequestType = {
  name?: string | null;
  code?: string | null;
};

type PaymentMethodResponseType = {
  id?: string | null;
  name?: string | null;
  code?: string | null;
  status?: string | null;
  restaurantId?: string | null;
};

type OptionRequestType = {
  name?: string | null;
  required?: boolean | null;
  price?: number | null;
};

type OptionResponseType = {
  id?: string | null;
  name?: string | null;
  required?: boolean | null;
  status?: string | null;
  restaurantId?: string | null;
  price?: number | null;
};

type MenuRequestType = {
  name?: string | null;
  description?: string | null;
};

type MenuResponseType = {
  id?: string | null;
  name?: string | null;
  description?: string | null;
  status?: string | null;
  restaurantId?: string | null;
};

type OpenShiftRequestType = {
  openerId?: string | null;
};

type CurrentShiftType = {
  id?: string | null;
  openerId?: string | null;
  closerId?: string | null;
  openAt?: string | null;
  closeAt?: string | null;
};

type CloseShiftRequestType = {
  closerId?: string | null;
};

type RestaurantRequestType = {
  username?: string | null;
  password?: string | null;
  name?: string | null;
  description?: string | null;
  address?: string | null;
  phone?: string | null;
  email?: string | null;
  imageUrl?: string | null;
};

type RestaurantResponseType = {
  id?: string | null;
  name?: string | null;
  description?: string | null;
  address?: string | null;
  phone?: string | null;
  email?: string | null;
  imageUrl?: string | null;
  createdAt?: string | null;
};

type StaffRequestType = {
  username?: string | null;
  password?: string | null;
  email?: string | null;
  address?: string | null;
  phone?: string | null;
  imageUrl?: string | null;
};

type ProductRequestType = {
  name: string;
  description?: string | null;
  tag?: string | null;
  imageUrl?: string | null;
  price: number;
  menuId: string;
  options?: string[] | null;
  toppings?: string[] | null;
};

type ProductResponseType = {
  id?: string | null;
  name?: string | null;
  description?: string | null;
  tag?: string | null;
  imageUrl?: string | null;
  price?: number | null;
  menuId?: string | null;
  restaurantId?: string | null;
  options?: OptionResponseType[] | null;
  toppings?: ToppingResponseType[] | null;
};

type PaymentRequestType = {
  orderId?: string | null;
  paymentMethods?: PaymentTotalRequestType[] | null;
  promotionId?: string | null;
};

type PaymentTotalRequestType = {
  id?: string | null;
  name?: string | null;
  amount?: number | null;
};

type OrderItemDTOType = {
  id?: string | null;
  itemId?: string | null;
  price?: number | null;
  quantity?: number | null;
  name?: string | null;
  itemType?: string | null;
  imageUrl?: string | null;
  menuId?: string | null;
  discountValue?: number | null;
  discountedPrice?: number | null;
  subItems?: OrderSubItemResponseType[] | null;
};

type OrderResponseType = {
  id?: string | null;
  code?: string | null;
  tableId?: string | null;
  tableName?: string | null;
  orderStatus?: string | null;
  orderItems?: OrderItemDTOType[] | null;
  shiftId?: string | null;
  creatorId?: string | null;
  creatorName?: string | null;
  totalPrice?: number | null;
  totalItem?: number | null;
  amountDiscount?: number | null;
  customerCount?: number | null;
  finalAmount?: number | null;
  amountReceivedFromCustomer?: number | null;
  amountChangeGivenToCustomer?: number | null;
  promotion?: PromotionOrderResponseType | null;
  createdAt?: string | null;
  updatedAt?: string | null;
};

type OrderSubItemResponseType = {
  id?: string | null;
  name?: string | null;
  price?: number | null;
  quantity?: number | null;
  itemType?: string | null;
  itemId?: string | null;
};

type PromotionOrderResponseType = {
  id?: string | null;
  promotionId?: string | null;
  promotionName?: string | null;
  promotionValue?: string | null;
  promotionType?: string | null;
  applyAt?: string | null;
  applyOrderType?: string | null;
  amountAfterPromotion?: number | null;
  amountBeforePromotion?: number | null;
};

type OrderItemBaseRequestType = {
  itemId?: string | null;
  quantity?: number | null;
  itemType?: string | null;
};

type OrderItemRequestType = {
  itemId?: string | null;
  quantity?: number | null;
  itemType?: string | null;
  subItems?: OrderItemBaseRequestType[] | null;
};

type OrderRequestType = {
  tableId?: string | null;
  shiftId?: string | null;
  creatorId?: string | null;
  customerCount?: number | null;
  items?: OrderItemRequestType[] | null;
};

type OrderAddRequestType = {
  orderId?: string | null;
  items?: OrderItemRequestType[] | null;
};

type LoginRequestType = {
  username?: string | null;
  password?: string | null;
};

type ShiftResponseType = {
  id?: string | null;
  openerId?: string | null;
  closerId?: string | null;
  openerName?: string | null;
  closerName?: string | null;
  openAt?: string | null;
  closeAt?: string | null;
  totalAmount?: number | null;
  totalAmountReceivedFromCustomer?: number | null;
  totalAmountDiscount?: number | null;
  totalAmountChangeGivenToCustomer?: number | null;
  totalOrder?: number | null;
  totalItem?: number | null;
  amountPaymentMethods?: PaymentTotalRequestType[] | null;
};

type SummaryRestaurantResponseType = {
  customerCount?: number | null;
  totalItem?: number | null;
  finalAmount?: number | null;
};

type StaffResponseType = {
  id?: string | null;
  username?: string | null;
  email?: string | null;
  phone?: string | null;
  address?: string | null;
  imageUrl?: string | null;
  roleName?: string | null;
};

type SummaryResponseType = {
  numRestaurant?: number | null;
  customerCount?: number | null;
  totalItem?: number | null;
  finalAmount?: number | null;
};

type RestaurantSelectType = {
  id?: string | null;
  name?: string | null;
};

type LookupOrderResponseType = {
  pageNo?: number | null;
  pageSize?: number | null;
  totalElements?: number | null;
  totalPages?: number | null;
  content?: OrderResponseType[] | null;
};

type OrderItemHistoryResponseType = {
  id?: string | null;
  name?: string | null;
  price?: number | null;
  quantity?: number | null;
  itemType?: string | null;
  orderHistoryStatus?: string | null;
  itemId?: string | null;
  requestId?: string | null;
  orderAt?: string | null;
  imageUrl?: string | null;
  subItems?: OrderSubItemHistoryResponseType[] | null;
};

type OrderSubItemHistoryResponseType = {
  id?: string | null;
  name?: string | null;
  price?: number | null;
  quantity?: number | null;
  itemType?: string | null;
  itemId?: string | null;
};

type CurrentUserType = {
  id?: string | null;
  username?: string | null;
  phone?: string | null;
  email?: string | null;
  address?: string | null;
  roleName?: string | null;
  imageUrl?: string | null;
  restaurantId?: string | null;
};

type ApplyPromotionParamsType = {
  promotionId: string;
};

type GetOrderLookupParamsType = {
  orderStatus?: string | null;
  startDate: string;
  endDate: string;
  pageSize: number;
  pageNo: number;
};

type RefreshResponseType = any | null;

type ArrayToppingResponseSchemaType = ToppingResponseType[];

type ArrayTableResponseSchemaType = TableResponseType[];

type ArrayStaffResponseSchemaType = StaffResponseType[];

type ArrayRestaurantSelectSchemaType = RestaurantSelectType[];

type ArrayRestaurantResponseSchemaType = RestaurantResponseType[];

type ArrayPromotionResponseSchemaType = PromotionResponseType[];

type ArrayProductResponseSchemaType = ProductResponseType[];

type ArrayPaymentMethodResponseSchemaType = PaymentMethodResponseType[];

type ArrayOrderItemHistoryResponseSchemaType = OrderItemHistoryResponseType[];

type ArrayOptionResponseSchemaType = OptionResponseType[];

type ArrayMenuResponseSchemaType = MenuResponseType[];
export const ToppingRequestSchema: z.ZodType<ToppingRequestType> = z.object({
  name: z.string().optional().nullable(),
  maxQuantity: z.number().optional().nullable(),
  price: z.number().optional().nullable(),
});

export const ToppingResponseSchema: z.ZodType<ToppingResponseType> = z.object({
  id: z.string().optional().nullable(),
  name: z.string().optional().nullable(),
  maxQuantity: z.number().optional().nullable(),
  status: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
  price: z.number().optional().nullable(),
});

export const TableRequestSchema: z.ZodType<TableRequestType> = z.object({
  name: z.string().optional().nullable(),
});

export const TableResponseSchema: z.ZodType<TableResponseType> = z.object({
  id: z.string().optional().nullable(),
  name: z.string().optional().nullable(),
  idx: z.number().optional().nullable(),
  customerCount: z.number().optional().nullable(),
  totalPrice: z.number().optional().nullable(),
  totalItem: z.number().optional().nullable(),
  status: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
  orderId: z.string().optional().nullable(),
});

export const PromotionRequestSchema: z.ZodType<PromotionRequestType> = z.object(
  {
    name: z.string().optional().nullable(),
    type: z.string().optional().nullable(),
    applyType: z.string().optional().nullable(),
    value: z.number().optional().nullable(),
    startDate: z.string().optional().nullable(),
    endDate: z.string().optional().nullable(),
    startHour: z.string().optional().nullable(),
    endHour: z.string().optional().nullable(),
    menus: z
      .array(z.lazy(() => z.string()))
      .optional()
      .nullable(),
  },
);

export const PromotionResponseSchema: z.ZodType<PromotionResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    status: z.string().optional().nullable(),
    value: z.number().optional().nullable(),
    type: z.string().optional().nullable(),
    applyType: z.string().optional().nullable(),
    startDate: z.string().optional().nullable(),
    endDate: z.string().optional().nullable(),
    startHour: z.string().optional().nullable(),
    endHour: z.string().optional().nullable(),
    restaurantId: z.string().optional().nullable(),
    menus: z
      .array(z.lazy(() => z.string()))
      .optional()
      .nullable(),
  });

export const PaymentMethodRequestSchema: z.ZodType<PaymentMethodRequestType> =
  z.object({
    name: z.string().optional().nullable(),
    code: z.string().optional().nullable(),
  });

export const PaymentMethodResponseSchema: z.ZodType<PaymentMethodResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    code: z.string().optional().nullable(),
    status: z.string().optional().nullable(),
    restaurantId: z.string().optional().nullable(),
  });

export const OptionRequestSchema: z.ZodType<OptionRequestType> = z.object({
  name: z.string().optional().nullable(),
  required: z.boolean().optional().nullable(),
  price: z.number().optional().nullable(),
});

export const OptionResponseSchema: z.ZodType<OptionResponseType> = z.object({
  id: z.string().optional().nullable(),
  name: z.string().optional().nullable(),
  required: z.boolean().optional().nullable(),
  status: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
  price: z.number().optional().nullable(),
});

export const MenuRequestSchema: z.ZodType<MenuRequestType> = z.object({
  name: z.string().optional().nullable(),
  description: z.string().optional().nullable(),
});

export const MenuResponseSchema: z.ZodType<MenuResponseType> = z.object({
  id: z.string().optional().nullable(),
  name: z.string().optional().nullable(),
  description: z.string().optional().nullable(),
  status: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
});

export const OpenShiftRequestSchema: z.ZodType<OpenShiftRequestType> = z.object(
  {
    openerId: z.string().optional().nullable(),
  },
);

export const CurrentShiftSchema: z.ZodType<CurrentShiftType> = z.object({
  id: z.string().optional().nullable(),
  openerId: z.string().optional().nullable(),
  closerId: z.string().optional().nullable(),
  openAt: z.string().optional().nullable(),
  closeAt: z.string().optional().nullable(),
});

export const CloseShiftRequestSchema: z.ZodType<CloseShiftRequestType> =
  z.object({
    closerId: z.string().optional().nullable(),
  });

export const RestaurantRequestSchema: z.ZodType<RestaurantRequestType> =
  z.object({
    username: z.string().optional().nullable(),
    password: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    description: z.string().optional().nullable(),
    address: z.string().optional().nullable(),
    phone: z.string().optional().nullable(),
    email: z.string().optional().nullable(),
    imageUrl: z.string().optional().nullable(),
  });

export const RestaurantResponseSchema: z.ZodType<RestaurantResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    description: z.string().optional().nullable(),
    address: z.string().optional().nullable(),
    phone: z.string().optional().nullable(),
    email: z.string().optional().nullable(),
    imageUrl: z.string().optional().nullable(),
    createdAt: z.string().optional().nullable(),
  });

export const StaffRequestSchema: z.ZodType<StaffRequestType> = z.object({
  username: z.string().optional().nullable(),
  password: z.string().optional().nullable(),
  email: z.string().optional().nullable(),
  address: z.string().optional().nullable(),
  phone: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
});

export const ProductRequestSchema: z.ZodType<ProductRequestType> = z.object({
  name: z.string(),
  description: z.string().optional().nullable(),
  tag: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
  price: z.number(),
  menuId: z.string(),
  options: z
    .array(z.lazy(() => z.string()))
    .optional()
    .nullable(),
  toppings: z
    .array(z.lazy(() => z.string()))
    .optional()
    .nullable(),
});

export const ProductResponseSchema: z.ZodType<ProductResponseType> = z.object({
  id: z.string().optional().nullable(),
  name: z.string().optional().nullable(),
  description: z.string().optional().nullable(),
  tag: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
  price: z.number().optional().nullable(),
  menuId: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
  options: z
    .array(z.lazy(() => OptionResponseSchema))
    .optional()
    .nullable(),
  toppings: z
    .array(z.lazy(() => ToppingResponseSchema))
    .optional()
    .nullable(),
});

export const PaymentRequestSchema: z.ZodType<PaymentRequestType> = z.object({
  orderId: z.string().optional().nullable(),
  paymentMethods: z
    .array(z.lazy(() => PaymentTotalRequestSchema))
    .optional()
    .nullable(),
  promotionId: z.string().optional().nullable(),
});

export const PaymentTotalRequestSchema: z.ZodType<PaymentTotalRequestType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    amount: z.number().optional().nullable(),
  });

export const OrderItemDTOSchema: z.ZodType<OrderItemDTOType> = z.object({
  id: z.string().optional().nullable(),
  itemId: z.string().optional().nullable(),
  price: z.number().optional().nullable(),
  quantity: z.number().optional().nullable(),
  name: z.string().optional().nullable(),
  itemType: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
  menuId: z.string().optional().nullable(),
  discountValue: z.number().optional().nullable(),
  discountedPrice: z.number().optional().nullable(),
  subItems: z
    .array(z.lazy(() => OrderSubItemResponseSchema))
    .optional()
    .nullable(),
});

export const OrderResponseSchema: z.ZodType<OrderResponseType> = z.object({
  id: z.string().optional().nullable(),
  code: z.string().optional().nullable(),
  tableId: z.string().optional().nullable(),
  tableName: z.string().optional().nullable(),
  orderStatus: z.string().optional().nullable(),
  orderItems: z
    .array(z.lazy(() => OrderItemDTOSchema))
    .optional()
    .nullable(),
  shiftId: z.string().optional().nullable(),
  creatorId: z.string().optional().nullable(),
  creatorName: z.string().optional().nullable(),
  totalPrice: z.number().optional().nullable(),
  totalItem: z.number().optional().nullable(),
  amountDiscount: z.number().optional().nullable(),
  customerCount: z.number().optional().nullable(),
  finalAmount: z.number().optional().nullable(),
  amountReceivedFromCustomer: z.number().optional().nullable(),
  amountChangeGivenToCustomer: z.number().optional().nullable(),
  promotion: z
    .lazy(() => PromotionOrderResponseSchema)
    .optional()
    .nullable(),
  createdAt: z.string().optional().nullable(),
  updatedAt: z.string().optional().nullable(),
});

export const OrderSubItemResponseSchema: z.ZodType<OrderSubItemResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    price: z.number().optional().nullable(),
    quantity: z.number().optional().nullable(),
    itemType: z.string().optional().nullable(),
    itemId: z.string().optional().nullable(),
  });

export const PromotionOrderResponseSchema: z.ZodType<PromotionOrderResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    promotionId: z.string().optional().nullable(),
    promotionName: z.string().optional().nullable(),
    promotionValue: z.string().optional().nullable(),
    promotionType: z.string().optional().nullable(),
    applyAt: z.string().optional().nullable(),
    applyOrderType: z.string().optional().nullable(),
    amountAfterPromotion: z.number().optional().nullable(),
    amountBeforePromotion: z.number().optional().nullable(),
  });

export const OrderItemBaseRequestSchema: z.ZodType<OrderItemBaseRequestType> =
  z.object({
    itemId: z.string().optional().nullable(),
    quantity: z.number().optional().nullable(),
    itemType: z.string().optional().nullable(),
  });

export const OrderItemRequestSchema: z.ZodType<OrderItemRequestType> = z.object(
  {
    itemId: z.string().optional().nullable(),
    quantity: z.number().optional().nullable(),
    itemType: z.string().optional().nullable(),
    subItems: z
      .array(z.lazy(() => OrderItemBaseRequestSchema))
      .optional()
      .nullable(),
  },
);

export const OrderRequestSchema: z.ZodType<OrderRequestType> = z.object({
  tableId: z.string().optional().nullable(),
  shiftId: z.string().optional().nullable(),
  creatorId: z.string().optional().nullable(),
  customerCount: z.number().optional().nullable(),
  items: z
    .array(z.lazy(() => OrderItemRequestSchema))
    .optional()
    .nullable(),
});

export const OrderAddRequestSchema: z.ZodType<OrderAddRequestType> = z.object({
  orderId: z.string().optional().nullable(),
  items: z
    .array(z.lazy(() => OrderItemRequestSchema))
    .optional()
    .nullable(),
});

export const LoginRequestSchema: z.ZodType<LoginRequestType> = z.object({
  username: z.string().optional().nullable(),
  password: z.string().optional().nullable(),
});

export const ShiftResponseSchema: z.ZodType<ShiftResponseType> = z.object({
  id: z.string().optional().nullable(),
  openerId: z.string().optional().nullable(),
  closerId: z.string().optional().nullable(),
  openerName: z.string().optional().nullable(),
  closerName: z.string().optional().nullable(),
  openAt: z.string().optional().nullable(),
  closeAt: z.string().optional().nullable(),
  totalAmount: z.number().optional().nullable(),
  totalAmountReceivedFromCustomer: z.number().optional().nullable(),
  totalAmountDiscount: z.number().optional().nullable(),
  totalAmountChangeGivenToCustomer: z.number().optional().nullable(),
  totalOrder: z.number().optional().nullable(),
  totalItem: z.number().optional().nullable(),
  amountPaymentMethods: z
    .array(z.lazy(() => PaymentTotalRequestSchema))
    .optional()
    .nullable(),
});

export const SummaryRestaurantResponseSchema: z.ZodType<SummaryRestaurantResponseType> =
  z.object({
    customerCount: z.number().optional().nullable(),
    totalItem: z.number().optional().nullable(),
    finalAmount: z.number().optional().nullable(),
  });

export const StaffResponseSchema: z.ZodType<StaffResponseType> = z.object({
  id: z.string().optional().nullable(),
  username: z.string().optional().nullable(),
  email: z.string().optional().nullable(),
  phone: z.string().optional().nullable(),
  address: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
  roleName: z.string().optional().nullable(),
});

export const SummaryResponseSchema: z.ZodType<SummaryResponseType> = z.object({
  numRestaurant: z.number().optional().nullable(),
  customerCount: z.number().optional().nullable(),
  totalItem: z.number().optional().nullable(),
  finalAmount: z.number().optional().nullable(),
});

export const RestaurantSelectSchema: z.ZodType<RestaurantSelectType> = z.object(
  {
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
  },
);

export const LookupOrderResponseSchema: z.ZodType<LookupOrderResponseType> =
  z.object({
    pageNo: z.number().optional().nullable(),
    pageSize: z.number().optional().nullable(),
    totalElements: z.number().optional().nullable(),
    totalPages: z.number().optional().nullable(),
    content: z
      .array(z.lazy(() => OrderResponseSchema))
      .optional()
      .nullable(),
  });

export const OrderItemHistoryResponseSchema: z.ZodType<OrderItemHistoryResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    price: z.number().optional().nullable(),
    quantity: z.number().optional().nullable(),
    itemType: z.string().optional().nullable(),
    orderHistoryStatus: z.string().optional().nullable(),
    itemId: z.string().optional().nullable(),
    requestId: z.string().optional().nullable(),
    orderAt: z.string().optional().nullable(),
    imageUrl: z.string().optional().nullable(),
    subItems: z
      .array(z.lazy(() => OrderSubItemHistoryResponseSchema))
      .optional()
      .nullable(),
  });

export const OrderSubItemHistoryResponseSchema: z.ZodType<OrderSubItemHistoryResponseType> =
  z.object({
    id: z.string().optional().nullable(),
    name: z.string().optional().nullable(),
    price: z.number().optional().nullable(),
    quantity: z.number().optional().nullable(),
    itemType: z.string().optional().nullable(),
    itemId: z.string().optional().nullable(),
  });

export const CurrentUserSchema: z.ZodType<CurrentUserType> = z.object({
  id: z.string().optional().nullable(),
  username: z.string().optional().nullable(),
  phone: z.string().optional().nullable(),
  email: z.string().optional().nullable(),
  address: z.string().optional().nullable(),
  roleName: z.string().optional().nullable(),
  imageUrl: z.string().optional().nullable(),
  restaurantId: z.string().optional().nullable(),
});

export const ApplyPromotionParamsSchema: z.ZodType<ApplyPromotionParamsType> =
  z.object({
    promotionId: z.string(),
  });

export const GetOrderLookupParamsSchema: z.ZodType<GetOrderLookupParamsType> =
  z.object({
    orderStatus: z.string().optional().nullable(),
    startDate: z.string(),
    endDate: z.string(),
    pageSize: z.number(),
    pageNo: z.number(),
  });

export const RefreshResponseSchema: z.ZodType<RefreshResponseType> = z.any();

export const ArrayToppingResponseSchema: z.ZodType<ArrayToppingResponseSchemaType> =
  z.array(ToppingResponseSchema);

export const ArrayTableResponseSchema: z.ZodType<ArrayTableResponseSchemaType> =
  z.array(TableResponseSchema);

export const ArrayStaffResponseSchema: z.ZodType<ArrayStaffResponseSchemaType> =
  z.array(StaffResponseSchema);

export const ArrayRestaurantSelectSchema: z.ZodType<ArrayRestaurantSelectSchemaType> =
  z.array(RestaurantSelectSchema);

export const ArrayRestaurantResponseSchema: z.ZodType<ArrayRestaurantResponseSchemaType> =
  z.array(RestaurantResponseSchema);

export const ArrayPromotionResponseSchema: z.ZodType<ArrayPromotionResponseSchemaType> =
  z.array(PromotionResponseSchema);

export const ArrayProductResponseSchema: z.ZodType<ArrayProductResponseSchemaType> =
  z.array(ProductResponseSchema);

export const ArrayPaymentMethodResponseSchema: z.ZodType<ArrayPaymentMethodResponseSchemaType> =
  z.array(PaymentMethodResponseSchema);

export const ArrayOrderItemHistoryResponseSchema: z.ZodType<ArrayOrderItemHistoryResponseSchemaType> =
  z.array(OrderItemHistoryResponseSchema);

export const ArrayOptionResponseSchema: z.ZodType<ArrayOptionResponseSchemaType> =
  z.array(OptionResponseSchema);

export const ArrayMenuResponseSchema: z.ZodType<ArrayMenuResponseSchemaType> =
  z.array(MenuResponseSchema);

export type ToppingRequestZodType = z.infer<typeof ToppingRequestSchema>;
export type ToppingResponseZodType = z.infer<typeof ToppingResponseSchema>;
export type TableRequestZodType = z.infer<typeof TableRequestSchema>;
export type TableResponseZodType = z.infer<typeof TableResponseSchema>;
export type PromotionRequestZodType = z.infer<typeof PromotionRequestSchema>;
export type PromotionResponseZodType = z.infer<typeof PromotionResponseSchema>;
export type PaymentMethodRequestZodType = z.infer<
  typeof PaymentMethodRequestSchema
>;
export type PaymentMethodResponseZodType = z.infer<
  typeof PaymentMethodResponseSchema
>;
export type OptionRequestZodType = z.infer<typeof OptionRequestSchema>;
export type OptionResponseZodType = z.infer<typeof OptionResponseSchema>;
export type MenuRequestZodType = z.infer<typeof MenuRequestSchema>;
export type MenuResponseZodType = z.infer<typeof MenuResponseSchema>;
export type OpenShiftRequestZodType = z.infer<typeof OpenShiftRequestSchema>;
export type CurrentShiftZodType = z.infer<typeof CurrentShiftSchema>;
export type CloseShiftRequestZodType = z.infer<typeof CloseShiftRequestSchema>;
export type RestaurantRequestZodType = z.infer<typeof RestaurantRequestSchema>;
export type RestaurantResponseZodType = z.infer<
  typeof RestaurantResponseSchema
>;
export type StaffRequestZodType = z.infer<typeof StaffRequestSchema>;
export type ProductRequestZodType = z.infer<typeof ProductRequestSchema>;
export type ProductResponseZodType = z.infer<typeof ProductResponseSchema>;
export type PaymentRequestZodType = z.infer<typeof PaymentRequestSchema>;
export type PaymentTotalRequestZodType = z.infer<
  typeof PaymentTotalRequestSchema
>;
export type OrderItemDTOZodType = z.infer<typeof OrderItemDTOSchema>;
export type OrderResponseZodType = z.infer<typeof OrderResponseSchema>;
export type OrderSubItemResponseZodType = z.infer<
  typeof OrderSubItemResponseSchema
>;
export type PromotionOrderResponseZodType = z.infer<
  typeof PromotionOrderResponseSchema
>;
export type OrderItemBaseRequestZodType = z.infer<
  typeof OrderItemBaseRequestSchema
>;
export type OrderItemRequestZodType = z.infer<typeof OrderItemRequestSchema>;
export type OrderRequestZodType = z.infer<typeof OrderRequestSchema>;
export type OrderAddRequestZodType = z.infer<typeof OrderAddRequestSchema>;
export type LoginRequestZodType = z.infer<typeof LoginRequestSchema>;
export type ShiftResponseZodType = z.infer<typeof ShiftResponseSchema>;
export type SummaryRestaurantResponseZodType = z.infer<
  typeof SummaryRestaurantResponseSchema
>;
export type StaffResponseZodType = z.infer<typeof StaffResponseSchema>;
export type SummaryResponseZodType = z.infer<typeof SummaryResponseSchema>;
export type RestaurantSelectZodType = z.infer<typeof RestaurantSelectSchema>;
export type LookupOrderResponseZodType = z.infer<
  typeof LookupOrderResponseSchema
>;
export type OrderItemHistoryResponseZodType = z.infer<
  typeof OrderItemHistoryResponseSchema
>;
export type OrderSubItemHistoryResponseZodType = z.infer<
  typeof OrderSubItemHistoryResponseSchema
>;
export type CurrentUserZodType = z.infer<typeof CurrentUserSchema>;
export type ApplyPromotionParamsZodType = z.infer<
  typeof ApplyPromotionParamsSchema
>;
export type GetOrderLookupParamsZodType = z.infer<
  typeof GetOrderLookupParamsSchema
>;
export type RefreshResponseZodType = z.infer<typeof RefreshResponseSchema>;
export type ArrayToppingResponseZodType = z.infer<
  typeof ArrayToppingResponseSchema
>;
export type ArrayTableResponseZodType = z.infer<
  typeof ArrayTableResponseSchema
>;
export type ArrayStaffResponseZodType = z.infer<
  typeof ArrayStaffResponseSchema
>;
export type ArrayRestaurantSelectZodType = z.infer<
  typeof ArrayRestaurantSelectSchema
>;
export type ArrayRestaurantResponseZodType = z.infer<
  typeof ArrayRestaurantResponseSchema
>;
export type ArrayPromotionResponseZodType = z.infer<
  typeof ArrayPromotionResponseSchema
>;
export type ArrayProductResponseZodType = z.infer<
  typeof ArrayProductResponseSchema
>;
export type ArrayPaymentMethodResponseZodType = z.infer<
  typeof ArrayPaymentMethodResponseSchema
>;
export type ArrayOrderItemHistoryResponseZodType = z.infer<
  typeof ArrayOrderItemHistoryResponseSchema
>;
export type ArrayOptionResponseZodType = z.infer<
  typeof ArrayOptionResponseSchema
>;
export type ArrayMenuResponseZodType = z.infer<typeof ArrayMenuResponseSchema>;
