import { http } from "../client";
import { type AxiosRequestConfig } from "axios";
import type {
  ApplyPromotionParamsZodType,
  GetOrderLookupParamsZodType,
  ToppingResponseZodType,
  TableResponseZodType,
  PromotionResponseZodType,
  PaymentMethodResponseZodType,
  OptionResponseZodType,
  MenuResponseZodType,
  CurrentShiftZodType,
  RestaurantResponseZodType,
  ProductResponseZodType,
  OrderResponseZodType,
  RefreshResponseZodType,
  ArrayToppingResponseZodType,
  ArrayTableResponseZodType,
  ShiftResponseZodType,
  SummaryRestaurantResponseZodType,
  ArrayStaffResponseZodType,
  SummaryResponseZodType,
  ArrayRestaurantSelectZodType,
  ArrayRestaurantResponseZodType,
  ArrayPromotionResponseZodType,
  ArrayProductResponseZodType,
  ArrayPaymentMethodResponseZodType,
  LookupOrderResponseZodType,
  ArrayOrderItemHistoryResponseZodType,
  ArrayOptionResponseZodType,
  ArrayMenuResponseZodType,
  CurrentUserZodType,
  ToppingRequestZodType,
  TableRequestZodType,
  PromotionRequestZodType,
  PaymentMethodRequestZodType,
  OptionRequestZodType,
  MenuRequestZodType,
  OpenShiftRequestZodType,
  CloseShiftRequestZodType,
  RestaurantRequestZodType,
  StaffRequestZodType,
  ProductRequestZodType,
  PaymentRequestZodType,
  OrderRequestZodType,
  OrderAddRequestZodType,
  LoginRequestZodType,
} from "./schemas";
import {
  ToppingResponseSchema,
  TableResponseSchema,
  PromotionResponseSchema,
  PaymentMethodResponseSchema,
  OptionResponseSchema,
  MenuResponseSchema,
  CurrentShiftSchema,
  RestaurantResponseSchema,
  ProductResponseSchema,
  OrderResponseSchema,
  RefreshResponseSchema,
  ArrayToppingResponseSchema,
  ArrayTableResponseSchema,
  ShiftResponseSchema,
  SummaryRestaurantResponseSchema,
  ArrayStaffResponseSchema,
  SummaryResponseSchema,
  ArrayRestaurantSelectSchema,
  ArrayRestaurantResponseSchema,
  ArrayPromotionResponseSchema,
  ArrayProductResponseSchema,
  ArrayPaymentMethodResponseSchema,
  LookupOrderResponseSchema,
  ArrayOrderItemHistoryResponseSchema,
  ArrayOptionResponseSchema,
  ArrayMenuResponseSchema,
  CurrentUserSchema,
} from "./schemas";

/**
 *
 *
 */
export async function updateToppingById(
  id: string,
  data: ToppingRequestZodType,
  options?: AxiosRequestConfig,
): Promise<ToppingResponseZodType> {
  const res = await http.put<ToppingResponseZodType>(`/topping/${id}`, data, {
    ...options,
  });
  const parsed = ToppingResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getTableById(
  id: string,
  options?: AxiosRequestConfig,
): Promise<TableResponseZodType> {
  const res = await http.get<TableResponseZodType>(`/table/${id}`, options);
  const parsed = TableResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function updateTableById(
  id: string,
  data: TableRequestZodType,
  options?: AxiosRequestConfig,
): Promise<TableResponseZodType> {
  const res = await http.put<TableResponseZodType>(`/table/${id}`, data, {
    ...options,
  });
  const parsed = TableResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function updatePromotionById(
  id: string,
  data: PromotionRequestZodType,
  options?: AxiosRequestConfig,
): Promise<PromotionResponseZodType> {
  const res = await http.put<PromotionResponseZodType>(
    `/promotion/${id}`,
    data,
    { ...options },
  );
  const parsed = PromotionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function updatePaymentMethodById(
  id: string,
  data: PaymentMethodRequestZodType,
  options?: AxiosRequestConfig,
): Promise<PaymentMethodResponseZodType> {
  const res = await http.put<PaymentMethodResponseZodType>(
    `/payment-method/${id}`,
    data,
    { ...options },
  );
  const parsed = PaymentMethodResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function updateOptionById(
  id: string,
  data: OptionRequestZodType,
  options?: AxiosRequestConfig,
): Promise<OptionResponseZodType> {
  const res = await http.put<OptionResponseZodType>(`/option/${id}`, data, {
    ...options,
  });
  const parsed = OptionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getMenuById(
  id: string,
  options?: AxiosRequestConfig,
): Promise<MenuResponseZodType> {
  const res = await http.get<MenuResponseZodType>(`/menu/${id}`, options);
  const parsed = MenuResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function updateMenuById(
  id: string,
  data: MenuRequestZodType,
  options?: AxiosRequestConfig,
): Promise<MenuResponseZodType> {
  const res = await http.put<MenuResponseZodType>(`/menu/${id}`, data, {
    ...options,
  });
  const parsed = MenuResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createTopping(
  data: ToppingRequestZodType,
  options?: AxiosRequestConfig,
): Promise<ToppingResponseZodType> {
  const res = await http.post<ToppingResponseZodType>(
    `/topping/create-topping`,
    data,
    { ...options },
  );
  const parsed = ToppingResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createTable(
  data: TableRequestZodType,
  options?: AxiosRequestConfig,
): Promise<TableResponseZodType> {
  const res = await http.post<TableResponseZodType>(
    `/table/create-table`,
    data,
    { ...options },
  );
  const parsed = TableResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function openShift(
  data: OpenShiftRequestZodType,
  options?: AxiosRequestConfig,
): Promise<CurrentShiftZodType> {
  const res = await http.post<CurrentShiftZodType>(`/shift/open`, data, {
    ...options,
  });
  const parsed = CurrentShiftSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function closeShift(
  data: CloseShiftRequestZodType,
  options?: AxiosRequestConfig,
): Promise<CurrentShiftZodType> {
  const res = await http.post<CurrentShiftZodType>(`/shift/close`, data, {
    ...options,
  });
  const parsed = CurrentShiftSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createRestaurant(
  data: RestaurantRequestZodType,
  options?: AxiosRequestConfig,
): Promise<RestaurantResponseZodType> {
  const res = await http.post<RestaurantResponseZodType>(
    `/restaurant/create`,
    data,
    { ...options },
  );
  const parsed = RestaurantResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createUser(
  data: StaffRequestZodType,
  options?: AxiosRequestConfig,
): Promise<void> {
  const res = await http.post<void>(`/restaurant/create-staff`, data, {
    ...options,
  });
  return res.data;
}

/**
 *
 *
 */
export async function createPromotion(
  data: PromotionRequestZodType,
  options?: AxiosRequestConfig,
): Promise<PromotionResponseZodType> {
  const res = await http.post<PromotionResponseZodType>(
    `/promotion/create-promotion`,
    data,
    { ...options },
  );
  const parsed = PromotionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createProduct(
  data: ProductRequestZodType,
  options?: AxiosRequestConfig,
): Promise<ProductResponseZodType> {
  const res = await http.post<ProductResponseZodType>(
    `/product/create-product`,
    data,
    { ...options },
  );
  const parsed = ProductResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createPaymentMethod(
  data: PaymentMethodRequestZodType,
  options?: AxiosRequestConfig,
): Promise<PaymentMethodResponseZodType> {
  const res = await http.post<PaymentMethodResponseZodType>(
    `/payment-method/create`,
    data,
    { ...options },
  );
  const parsed = PaymentMethodResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function payment(
  data: PaymentRequestZodType,
  options?: AxiosRequestConfig,
): Promise<OrderResponseZodType> {
  const res = await http.post<OrderResponseZodType>(`/order/payment`, data, {
    ...options,
  });
  const parsed = OrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createOrder(
  data: OrderRequestZodType,
  options?: AxiosRequestConfig,
): Promise<OrderResponseZodType> {
  const res = await http.post<OrderResponseZodType>(`/order/create`, data, {
    ...options,
  });
  const parsed = OrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function addOrder(
  data: OrderAddRequestZodType,
  options?: AxiosRequestConfig,
): Promise<OrderResponseZodType> {
  const res = await http.post<OrderResponseZodType>(`/order/add`, data, {
    ...options,
  });
  const parsed = OrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createOption(
  data: OptionRequestZodType,
  options?: AxiosRequestConfig,
): Promise<OptionResponseZodType> {
  const res = await http.post<OptionResponseZodType>(
    `/option/create-option`,
    data,
    { ...options },
  );
  const parsed = OptionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function createMenu(
  data: MenuRequestZodType,
  options?: AxiosRequestConfig,
): Promise<MenuResponseZodType> {
  const res = await http.post<MenuResponseZodType>(`/menu/create-menu`, data, {
    ...options,
  });
  const parsed = MenuResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function refresh(
  options?: AxiosRequestConfig,
): Promise<RefreshResponseZodType> {
  const res = await http.post<RefreshResponseZodType>(
    `/auth/refresh`,
    {},
    options,
  );
  const parsed = RefreshResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function login(
  data: LoginRequestZodType,
  options?: AxiosRequestConfig,
): Promise<void> {
  const res = await http.post<void>(`/auth/login`, data, { ...options });
  return res.data;
}

/**
 *
 *
 */
export async function getToppingsByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayToppingResponseZodType> {
  const res = await http.get<ArrayToppingResponseZodType>(
    `/topping/restaurant/${id}`,
    options,
  );
  const parsed = ArrayToppingResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getTableByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayTableResponseZodType> {
  const res = await http.get<ArrayTableResponseZodType>(
    `/table/restaurant/${id}`,
    options,
  );
  const parsed = ArrayTableResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getShiftInfo(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ShiftResponseZodType> {
  const res = await http.get<ShiftResponseZodType>(
    `/shift/${id}/info`,
    options,
  );
  const parsed = ShiftResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function currentShift(
  options?: AxiosRequestConfig,
): Promise<CurrentShiftZodType> {
  const res = await http.get<CurrentShiftZodType>(`/shift/current`, options);
  const parsed = CurrentShiftSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getRestaurantById(
  id: string,
  options?: AxiosRequestConfig,
): Promise<RestaurantResponseZodType> {
  const res = await http.get<RestaurantResponseZodType>(
    `/restaurant/${id}`,
    options,
  );
  const parsed = RestaurantResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getSummaryRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<SummaryRestaurantResponseZodType> {
  const res = await http.get<SummaryRestaurantResponseZodType>(
    `/restaurant/${id}/summary`,
    options,
  );
  const parsed = SummaryRestaurantResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getStaffs(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayStaffResponseZodType> {
  const res = await http.get<ArrayStaffResponseZodType>(
    `/restaurant/${id}/staffs`,
    options,
  );
  const parsed = ArrayStaffResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getSummary(
  options?: AxiosRequestConfig,
): Promise<SummaryResponseZodType> {
  const res = await http.get<SummaryResponseZodType>(
    `/restaurant/summary`,
    options,
  );
  const parsed = SummaryResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function selectRestaurantList(
  options?: AxiosRequestConfig,
): Promise<ArrayRestaurantSelectZodType> {
  const res = await http.get<ArrayRestaurantSelectZodType>(
    `/restaurant/select-list`,
    options,
  );
  const parsed = ArrayRestaurantSelectSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getRestaurantList(
  options?: AxiosRequestConfig,
): Promise<ArrayRestaurantResponseZodType> {
  const res = await http.get<ArrayRestaurantResponseZodType>(
    `/restaurant/list`,
    options,
  );
  const parsed = ArrayRestaurantResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getPromotionsByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayPromotionResponseZodType> {
  const res = await http.get<ArrayPromotionResponseZodType>(
    `/promotion/restaurant/${id}`,
    options,
  );
  const parsed = ArrayPromotionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getProductsByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayProductResponseZodType> {
  const res = await http.get<ArrayProductResponseZodType>(
    `/product/restaurant/${id}`,
    options,
  );
  const parsed = ArrayProductResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getProductsByMenu(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayProductResponseZodType> {
  const res = await http.get<ArrayProductResponseZodType>(
    `/product/menu/${id}`,
    options,
  );
  const parsed = ArrayProductResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getPaymentMethodsByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayPaymentMethodResponseZodType> {
  const res = await http.get<ArrayPaymentMethodResponseZodType>(
    `/payment-method/restaurant/${id}`,
    options,
  );
  const parsed = ArrayPaymentMethodResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getOrderById(
  id: string,
  options?: AxiosRequestConfig,
): Promise<OrderResponseZodType> {
  const res = await http.get<OrderResponseZodType>(`/order/${id}`, options);
  const parsed = OrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function applyPromotion(
  id: string,
  params: ApplyPromotionParamsZodType,
  options?: AxiosRequestConfig,
): Promise<OrderResponseZodType> {
  const res = await http.get<OrderResponseZodType>(
    `/order/${id}/apply-promotion`,
    { params, ...options },
  );
  const parsed = OrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getOrderLookup(
  params: GetOrderLookupParamsZodType,
  options?: AxiosRequestConfig,
): Promise<LookupOrderResponseZodType> {
  const res = await http.get<LookupOrderResponseZodType>(`/order/lookup`, {
    params,
    ...options,
  });
  const parsed = LookupOrderResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getOrderHistoryByOrder(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayOrderItemHistoryResponseZodType> {
  const res = await http.get<ArrayOrderItemHistoryResponseZodType>(
    `/order-history/order/${id}`,
    options,
  );
  const parsed = ArrayOrderItemHistoryResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getOptionsByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayOptionResponseZodType> {
  const res = await http.get<ArrayOptionResponseZodType>(
    `/option/restaurant/${id}`,
    options,
  );
  const parsed = ArrayOptionResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getMenusByRestaurant(
  id: string,
  options?: AxiosRequestConfig,
): Promise<ArrayMenuResponseZodType> {
  const res = await http.get<ArrayMenuResponseZodType>(
    `/menu/restaurant/${id}`,
    options,
  );
  const parsed = ArrayMenuResponseSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}

/**
 *
 *
 */
export async function getCurrentUser(
  options?: AxiosRequestConfig,
): Promise<CurrentUserZodType> {
  const res = await http.get<CurrentUserZodType>(`/auth/current-user`, options);
  const parsed = CurrentUserSchema.safeParse(res.data);
  if (!parsed.success) {
    throw {
      message: "Invalid parse data Zod",
      error: parsed.error,
      type: "ZodError",
    };
  }
  return parsed.data;
}
