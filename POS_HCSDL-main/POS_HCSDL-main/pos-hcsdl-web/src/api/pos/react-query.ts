import { useMutation, useQuery, useInfiniteQuery } from "@tanstack/react-query";

import type {
  DataTag,
  MutationFunction,
  MutationKey,
  QueryClient,
  QueryFunction,
  QueryKey,
  UseMutationOptions,
  UseMutationResult,
  UseQueryOptions,
  UseQueryResult,
  UseInfiniteQueryOptions,
  UseInfiniteQueryResult,
} from "@tanstack/react-query";

import type { AxiosError, AxiosRequestConfig } from "axios";
import type {
  ApplyPromotionParamsZodType,
  GetOrderLookupParamsZodType,
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
  updateToppingById,
  getTableById,
  updateTableById,
  updatePromotionById,
  updatePaymentMethodById,
  updateOptionById,
  getMenuById,
  updateMenuById,
  createTopping,
  createTable,
  openShift,
  closeShift,
  createRestaurant,
  createUser,
  createPromotion,
  createProduct,
  createPaymentMethod,
  payment,
  createOrder,
  addOrder,
  createOption,
  createMenu,
  refresh,
  login,
  getToppingsByRestaurant,
  getTableByRestaurant,
  getShiftInfo,
  currentShift,
  getRestaurantById,
  getSummaryRestaurant,
  getStaffs,
  getSummary,
  selectRestaurantList,
  getRestaurantList,
  getPromotionsByRestaurant,
  getProductsByRestaurant,
  getProductsByMenu,
  getPaymentMethodsByRestaurant,
  getOrderById,
  applyPromotion,
  getOrderLookup,
  getOrderHistoryByOrder,
  getOptionsByRestaurant,
  getMenusByRestaurant,
  getCurrentUser,
} from "./api-schemas";

/**
 * Summary
 * Description
 */

export const updateToppingByIdQueryKey = (id: string) => {
  return [`/topping/${id}`];
};

export const updateToppingByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updateToppingById>>,
    TError,
    { id: string; data: ToppingRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updateToppingById>>,
  TError,
  { id: string; data: ToppingRequestZodType },
  TContext
> => {
  const mutationKey = ["updateToppingById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updateToppingById>>,
    { id: string; data: ToppingRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updateToppingById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdateToppingById<
  TData = Awaited<ReturnType<typeof updateToppingById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updateToppingById>>,
        TError,
        { id: string; data: ToppingRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updateToppingById>>,
  TError,
  { id: string; data: ToppingRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updateToppingByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updateToppingById>>,
    TError,
    { id: string; data: ToppingRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updateToppingById>>,
    TError,
    { id: string; data: ToppingRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const getTableByIdQueryKey = (id: string) => {
  return [`/table/${id}`];
};

export const getTableByIdQueryOptions = <
  TData = Awaited<ReturnType<typeof getTableById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getTableById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getTableByIdQueryKey(id);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getTableById>>> = ({
    signal,
  }) => getTableById(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getTableById>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetTableByIdResult = NonNullable<
  Awaited<ReturnType<typeof getTableById>>
>;
export type GetTableByIdQueryError = AxiosError<null>;

export function useGetTableById<
  TData = Awaited<ReturnType<typeof getTableById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getTableById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getTableByIdQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const updateTableByIdQueryKey = (id: string) => {
  return [`/table/${id}`];
};

export const updateTableByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updateTableById>>,
    TError,
    { id: string; data: TableRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updateTableById>>,
  TError,
  { id: string; data: TableRequestZodType },
  TContext
> => {
  const mutationKey = ["updateTableById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updateTableById>>,
    { id: string; data: TableRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updateTableById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdateTableById<
  TData = Awaited<ReturnType<typeof updateTableById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updateTableById>>,
        TError,
        { id: string; data: TableRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updateTableById>>,
  TError,
  { id: string; data: TableRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updateTableByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updateTableById>>,
    TError,
    { id: string; data: TableRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updateTableById>>,
    TError,
    { id: string; data: TableRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const updatePromotionByIdQueryKey = (id: string) => {
  return [`/promotion/${id}`];
};

export const updatePromotionByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updatePromotionById>>,
    TError,
    { id: string; data: PromotionRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updatePromotionById>>,
  TError,
  { id: string; data: PromotionRequestZodType },
  TContext
> => {
  const mutationKey = ["updatePromotionById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updatePromotionById>>,
    { id: string; data: PromotionRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updatePromotionById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdatePromotionById<
  TData = Awaited<ReturnType<typeof updatePromotionById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updatePromotionById>>,
        TError,
        { id: string; data: PromotionRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updatePromotionById>>,
  TError,
  { id: string; data: PromotionRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updatePromotionByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updatePromotionById>>,
    TError,
    { id: string; data: PromotionRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updatePromotionById>>,
    TError,
    { id: string; data: PromotionRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const updatePaymentMethodByIdQueryKey = (id: string) => {
  return [`/payment-method/${id}`];
};

export const updatePaymentMethodByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updatePaymentMethodById>>,
    TError,
    { id: string; data: PaymentMethodRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updatePaymentMethodById>>,
  TError,
  { id: string; data: PaymentMethodRequestZodType },
  TContext
> => {
  const mutationKey = ["updatePaymentMethodById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updatePaymentMethodById>>,
    { id: string; data: PaymentMethodRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updatePaymentMethodById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdatePaymentMethodById<
  TData = Awaited<ReturnType<typeof updatePaymentMethodById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updatePaymentMethodById>>,
        TError,
        { id: string; data: PaymentMethodRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updatePaymentMethodById>>,
  TError,
  { id: string; data: PaymentMethodRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updatePaymentMethodByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updatePaymentMethodById>>,
    TError,
    { id: string; data: PaymentMethodRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updatePaymentMethodById>>,
    TError,
    { id: string; data: PaymentMethodRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const updateOptionByIdQueryKey = (id: string) => {
  return [`/option/${id}`];
};

export const updateOptionByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updateOptionById>>,
    TError,
    { id: string; data: OptionRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updateOptionById>>,
  TError,
  { id: string; data: OptionRequestZodType },
  TContext
> => {
  const mutationKey = ["updateOptionById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updateOptionById>>,
    { id: string; data: OptionRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updateOptionById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdateOptionById<
  TData = Awaited<ReturnType<typeof updateOptionById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updateOptionById>>,
        TError,
        { id: string; data: OptionRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updateOptionById>>,
  TError,
  { id: string; data: OptionRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updateOptionByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updateOptionById>>,
    TError,
    { id: string; data: OptionRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updateOptionById>>,
    TError,
    { id: string; data: OptionRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const getMenuByIdQueryKey = (id: string) => {
  return [`/menu/${id}`];
};

export const getMenuByIdQueryOptions = <
  TData = Awaited<ReturnType<typeof getMenuById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getMenuById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getMenuByIdQueryKey(id);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getMenuById>>> = ({
    signal,
  }) => getMenuById(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getMenuById>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetMenuByIdResult = NonNullable<
  Awaited<ReturnType<typeof getMenuById>>
>;
export type GetMenuByIdQueryError = AxiosError<null>;

export function useGetMenuById<
  TData = Awaited<ReturnType<typeof getMenuById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getMenuById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getMenuByIdQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const updateMenuByIdQueryKey = (id: string) => {
  return [`/menu/${id}`];
};

export const updateMenuByIdMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof updateMenuById>>,
    TError,
    { id: string; data: MenuRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof updateMenuById>>,
  TError,
  { id: string; data: MenuRequestZodType },
  TContext
> => {
  const mutationKey = ["updateMenuById"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof updateMenuById>>,
    { id: string; data: MenuRequestZodType }
  > = (props) => {
    const { id, data } = props ?? {};
    return updateMenuById(id, data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useUpdateMenuById<
  TData = Awaited<ReturnType<typeof updateMenuById>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof updateMenuById>>,
        TError,
        { id: string; data: MenuRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof updateMenuById>>,
  TError,
  { id: string; data: MenuRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = updateMenuByIdMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof updateMenuById>>,
    TError,
    { id: string; data: MenuRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof updateMenuById>>,
    TError,
    { id: string; data: MenuRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createToppingQueryKey = () => {
  return [`/topping/create-topping`];
};

export const createToppingMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createTopping>>,
    TError,
    { data: ToppingRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createTopping>>,
  TError,
  { data: ToppingRequestZodType },
  TContext
> => {
  const mutationKey = ["createTopping"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createTopping>>,
    { data: ToppingRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createTopping(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateTopping<
  TData = Awaited<ReturnType<typeof createTopping>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createTopping>>,
        TError,
        { data: ToppingRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createTopping>>,
  TError,
  { data: ToppingRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createToppingMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createTopping>>,
    TError,
    { data: ToppingRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createTopping>>,
    TError,
    { data: ToppingRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createTableQueryKey = () => {
  return [`/table/create-table`];
};

export const createTableMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createTable>>,
    TError,
    { data: TableRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createTable>>,
  TError,
  { data: TableRequestZodType },
  TContext
> => {
  const mutationKey = ["createTable"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createTable>>,
    { data: TableRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createTable(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateTable<
  TData = Awaited<ReturnType<typeof createTable>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createTable>>,
        TError,
        { data: TableRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createTable>>,
  TError,
  { data: TableRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createTableMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createTable>>,
    TError,
    { data: TableRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createTable>>,
    TError,
    { data: TableRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const openShiftQueryKey = () => {
  return [`/shift/open`];
};

export const openShiftMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof openShift>>,
    TError,
    { data: OpenShiftRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof openShift>>,
  TError,
  { data: OpenShiftRequestZodType },
  TContext
> => {
  const mutationKey = ["openShift"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof openShift>>,
    { data: OpenShiftRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return openShift(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useOpenShift<
  TData = Awaited<ReturnType<typeof openShift>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof openShift>>,
        TError,
        { data: OpenShiftRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof openShift>>,
  TError,
  { data: OpenShiftRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = openShiftMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof openShift>>,
    TError,
    { data: OpenShiftRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof openShift>>,
    TError,
    { data: OpenShiftRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const closeShiftQueryKey = () => {
  return [`/shift/close`];
};

export const closeShiftMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof closeShift>>,
    TError,
    { data: CloseShiftRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof closeShift>>,
  TError,
  { data: CloseShiftRequestZodType },
  TContext
> => {
  const mutationKey = ["closeShift"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof closeShift>>,
    { data: CloseShiftRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return closeShift(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCloseShift<
  TData = Awaited<ReturnType<typeof closeShift>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof closeShift>>,
        TError,
        { data: CloseShiftRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof closeShift>>,
  TError,
  { data: CloseShiftRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = closeShiftMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof closeShift>>,
    TError,
    { data: CloseShiftRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof closeShift>>,
    TError,
    { data: CloseShiftRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createRestaurantQueryKey = () => {
  return [`/restaurant/create`];
};

export const createRestaurantMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createRestaurant>>,
    TError,
    { data: RestaurantRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createRestaurant>>,
  TError,
  { data: RestaurantRequestZodType },
  TContext
> => {
  const mutationKey = ["createRestaurant"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createRestaurant>>,
    { data: RestaurantRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createRestaurant(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateRestaurant<
  TData = Awaited<ReturnType<typeof createRestaurant>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createRestaurant>>,
        TError,
        { data: RestaurantRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createRestaurant>>,
  TError,
  { data: RestaurantRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createRestaurantMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createRestaurant>>,
    TError,
    { data: RestaurantRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createRestaurant>>,
    TError,
    { data: RestaurantRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createUserQueryKey = () => {
  return [`/restaurant/create-staff`];
};

export const createUserMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createUser>>,
    TError,
    { data: StaffRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createUser>>,
  TError,
  { data: StaffRequestZodType },
  TContext
> => {
  const mutationKey = ["createUser"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createUser>>,
    { data: StaffRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createUser(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateUser<
  TData = Awaited<ReturnType<typeof createUser>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createUser>>,
        TError,
        { data: StaffRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createUser>>,
  TError,
  { data: StaffRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createUserMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createUser>>,
    TError,
    { data: StaffRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createUser>>,
    TError,
    { data: StaffRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createPromotionQueryKey = () => {
  return [`/promotion/create-promotion`];
};

export const createPromotionMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createPromotion>>,
    TError,
    { data: PromotionRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createPromotion>>,
  TError,
  { data: PromotionRequestZodType },
  TContext
> => {
  const mutationKey = ["createPromotion"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createPromotion>>,
    { data: PromotionRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createPromotion(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreatePromotion<
  TData = Awaited<ReturnType<typeof createPromotion>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createPromotion>>,
        TError,
        { data: PromotionRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createPromotion>>,
  TError,
  { data: PromotionRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createPromotionMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createPromotion>>,
    TError,
    { data: PromotionRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createPromotion>>,
    TError,
    { data: PromotionRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createProductQueryKey = () => {
  return [`/product/create-product`];
};

export const createProductMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createProduct>>,
    TError,
    { data: ProductRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createProduct>>,
  TError,
  { data: ProductRequestZodType },
  TContext
> => {
  const mutationKey = ["createProduct"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createProduct>>,
    { data: ProductRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createProduct(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateProduct<
  TData = Awaited<ReturnType<typeof createProduct>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createProduct>>,
        TError,
        { data: ProductRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createProduct>>,
  TError,
  { data: ProductRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createProductMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createProduct>>,
    TError,
    { data: ProductRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createProduct>>,
    TError,
    { data: ProductRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createPaymentMethodQueryKey = () => {
  return [`/payment-method/create`];
};

export const createPaymentMethodMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createPaymentMethod>>,
    TError,
    { data: PaymentMethodRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createPaymentMethod>>,
  TError,
  { data: PaymentMethodRequestZodType },
  TContext
> => {
  const mutationKey = ["createPaymentMethod"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createPaymentMethod>>,
    { data: PaymentMethodRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createPaymentMethod(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreatePaymentMethod<
  TData = Awaited<ReturnType<typeof createPaymentMethod>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createPaymentMethod>>,
        TError,
        { data: PaymentMethodRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createPaymentMethod>>,
  TError,
  { data: PaymentMethodRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createPaymentMethodMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createPaymentMethod>>,
    TError,
    { data: PaymentMethodRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createPaymentMethod>>,
    TError,
    { data: PaymentMethodRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const paymentQueryKey = () => {
  return [`/order/payment`];
};

export const paymentMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof payment>>,
    TError,
    { data: PaymentRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof payment>>,
  TError,
  { data: PaymentRequestZodType },
  TContext
> => {
  const mutationKey = ["payment"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof payment>>,
    { data: PaymentRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return payment(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function usePayment<
  TData = Awaited<ReturnType<typeof payment>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof payment>>,
        TError,
        { data: PaymentRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof payment>>,
  TError,
  { data: PaymentRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = paymentMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof payment>>,
    TError,
    { data: PaymentRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof payment>>,
    TError,
    { data: PaymentRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createOrderQueryKey = () => {
  return [`/order/create`];
};

export const createOrderMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createOrder>>,
    TError,
    { data: OrderRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createOrder>>,
  TError,
  { data: OrderRequestZodType },
  TContext
> => {
  const mutationKey = ["createOrder"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createOrder>>,
    { data: OrderRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createOrder(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateOrder<
  TData = Awaited<ReturnType<typeof createOrder>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createOrder>>,
        TError,
        { data: OrderRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createOrder>>,
  TError,
  { data: OrderRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createOrderMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createOrder>>,
    TError,
    { data: OrderRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createOrder>>,
    TError,
    { data: OrderRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const addOrderQueryKey = () => {
  return [`/order/add`];
};

export const addOrderMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof addOrder>>,
    TError,
    { data: OrderAddRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof addOrder>>,
  TError,
  { data: OrderAddRequestZodType },
  TContext
> => {
  const mutationKey = ["addOrder"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof addOrder>>,
    { data: OrderAddRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return addOrder(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useAddOrder<
  TData = Awaited<ReturnType<typeof addOrder>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof addOrder>>,
        TError,
        { data: OrderAddRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof addOrder>>,
  TError,
  { data: OrderAddRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = addOrderMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof addOrder>>,
    TError,
    { data: OrderAddRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof addOrder>>,
    TError,
    { data: OrderAddRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createOptionQueryKey = () => {
  return [`/option/create-option`];
};

export const createOptionMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createOption>>,
    TError,
    { data: OptionRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createOption>>,
  TError,
  { data: OptionRequestZodType },
  TContext
> => {
  const mutationKey = ["createOption"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createOption>>,
    { data: OptionRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createOption(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateOption<
  TData = Awaited<ReturnType<typeof createOption>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createOption>>,
        TError,
        { data: OptionRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createOption>>,
  TError,
  { data: OptionRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createOptionMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createOption>>,
    TError,
    { data: OptionRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createOption>>,
    TError,
    { data: OptionRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const createMenuQueryKey = () => {
  return [`/menu/create-menu`];
};

export const createMenuMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof createMenu>>,
    TError,
    { data: MenuRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof createMenu>>,
  TError,
  { data: MenuRequestZodType },
  TContext
> => {
  const mutationKey = ["createMenu"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof createMenu>>,
    { data: MenuRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return createMenu(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useCreateMenu<
  TData = Awaited<ReturnType<typeof createMenu>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof createMenu>>,
        TError,
        { data: MenuRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof createMenu>>,
  TError,
  { data: MenuRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = createMenuMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof createMenu>>,
    TError,
    { data: MenuRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof createMenu>>,
    TError,
    { data: MenuRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const refreshQueryKey = () => {
  return [`/auth/refresh`];
};

export const refreshMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof refresh>>,
    TError,
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof refresh>>,
  TError,
  TContext
> => {
  const mutationKey = ["refresh"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof refresh>>
  > = () => {
    return refresh(axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useRefresh<
  TData = Awaited<ReturnType<typeof refresh>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<Awaited<ReturnType<typeof refresh>>, TError>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<Awaited<ReturnType<typeof refresh>>, TError> & {
  mutationKey: DataTag<QueryKey, TData, TError>;
} {
  const mutationOptions = refreshMutationOptions(options);
  const mutation = useMutation<Awaited<ReturnType<typeof refresh>>, TError>(
    mutationOptions,
    queryClient,
  ) as UseMutationResult<Awaited<ReturnType<typeof refresh>>, TError> & {
    mutationKey: DataTag<MutationKey, TData, TError>;
  };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const loginQueryKey = () => {
  return [`/auth/login`];
};

export const loginMutationOptions = <
  TError = AxiosError<null>,
  TContext = unknown,
>(options?: {
  mutation?: UseMutationOptions<
    Awaited<ReturnType<typeof login>>,
    TError,
    { data: LoginRequestZodType },
    TContext
  >;
  axios?: AxiosRequestConfig;
}): UseMutationOptions<
  Awaited<ReturnType<typeof login>>,
  TError,
  { data: LoginRequestZodType },
  TContext
> => {
  const mutationKey = ["login"];
  const { mutation: mutationOptions, axios: axiosOptions } = options
    ? options.mutation &&
      "mutationKey" in options.mutation &&
      options.mutation.mutationKey
      ? options
      : { ...options, mutation: { ...options.mutation, mutationKey } }
    : { mutation: { mutationKey }, axios: undefined };

  const mutationFn: MutationFunction<
    Awaited<ReturnType<typeof login>>,
    { data: LoginRequestZodType }
  > = (props) => {
    const { data } = props ?? {};
    return login(data, axiosOptions);
  };

  return { mutationFn, ...mutationOptions };
};

export function useLogin<
  TData = Awaited<ReturnType<typeof login>>,
  TError = AxiosError<null>,
>(
  options?: {
    mutation: Partial<
      UseMutationOptions<
        Awaited<ReturnType<typeof login>>,
        TError,
        { data: LoginRequestZodType }
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseMutationResult<
  Awaited<ReturnType<typeof login>>,
  TError,
  { data: LoginRequestZodType }
> & { mutationKey: DataTag<QueryKey, TData, TError> } {
  const mutationOptions = loginMutationOptions(options);
  const mutation = useMutation<
    Awaited<ReturnType<typeof login>>,
    TError,
    { data: LoginRequestZodType }
  >(mutationOptions, queryClient) as UseMutationResult<
    Awaited<ReturnType<typeof login>>,
    TError,
    { data: LoginRequestZodType }
  > & { mutationKey: DataTag<MutationKey, TData, TError> };

  return mutation;
}

/**
 * Summary
 * Description
 */

export const getToppingsByRestaurantQueryKey = (id: string) => {
  return [`/topping/restaurant/${id}`];
};

export const getToppingsByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getToppingsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getToppingsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey =
    queryOptions?.queryKey ?? getToppingsByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getToppingsByRestaurant>>
  > = ({ signal }) => getToppingsByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getToppingsByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetToppingsByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getToppingsByRestaurant>>
>;
export type GetToppingsByRestaurantQueryError = AxiosError<null>;

export function useGetToppingsByRestaurant<
  TData = Awaited<ReturnType<typeof getToppingsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getToppingsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getToppingsByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getTableByRestaurantQueryKey = (id: string) => {
  return [`/table/restaurant/${id}`];
};

export const getTableByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getTableByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getTableByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getTableByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getTableByRestaurant>>
  > = ({ signal }) => getTableByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getTableByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetTableByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getTableByRestaurant>>
>;
export type GetTableByRestaurantQueryError = AxiosError<null>;

export function useGetTableByRestaurant<
  TData = Awaited<ReturnType<typeof getTableByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getTableByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getTableByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getShiftInfoQueryKey = (id: string) => {
  return [`/shift/${id}/info`];
};

export const getShiftInfoQueryOptions = <
  TData = Awaited<ReturnType<typeof getShiftInfo>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getShiftInfo>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getShiftInfoQueryKey(id);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getShiftInfo>>> = ({
    signal,
  }) => getShiftInfo(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getShiftInfo>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetShiftInfoResult = NonNullable<
  Awaited<ReturnType<typeof getShiftInfo>>
>;
export type GetShiftInfoQueryError = AxiosError<null>;

export function useGetShiftInfo<
  TData = Awaited<ReturnType<typeof getShiftInfo>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getShiftInfo>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getShiftInfoQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const currentShiftQueryKey = () => {
  return [`/shift/current`];
};

export const currentShiftQueryOptions = <
  TData = Awaited<ReturnType<typeof currentShift>>,
  TError = AxiosError<null>,
>(options?: {
  query?: Partial<
    UseQueryOptions<Awaited<ReturnType<typeof currentShift>>, TError, TData>
  >;
  axios?: AxiosRequestConfig;
}) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? currentShiftQueryKey();
  const queryFn: QueryFunction<Awaited<ReturnType<typeof currentShift>>> = ({
    signal,
  }) => currentShift({ signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof currentShift>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type CurrentShiftResult = NonNullable<
  Awaited<ReturnType<typeof currentShift>>
>;
export type CurrentShiftQueryError = AxiosError<null>;

export function useCurrentShift<
  TData = Awaited<ReturnType<typeof currentShift>>,
  TError = AxiosError<null>,
>(
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof currentShift>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = currentShiftQueryOptions(options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getRestaurantByIdQueryKey = (id: string) => {
  return [`/restaurant/${id}`];
};

export const getRestaurantByIdQueryOptions = <
  TData = Awaited<ReturnType<typeof getRestaurantById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getRestaurantById>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getRestaurantByIdQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getRestaurantById>>
  > = ({ signal }) => getRestaurantById(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getRestaurantById>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetRestaurantByIdResult = NonNullable<
  Awaited<ReturnType<typeof getRestaurantById>>
>;
export type GetRestaurantByIdQueryError = AxiosError<null>;

export function useGetRestaurantById<
  TData = Awaited<ReturnType<typeof getRestaurantById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getRestaurantById>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getRestaurantByIdQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getSummaryRestaurantQueryKey = (id: string) => {
  return [`/restaurant/${id}/summary`];
};

export const getSummaryRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getSummaryRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getSummaryRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getSummaryRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getSummaryRestaurant>>
  > = ({ signal }) => getSummaryRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getSummaryRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetSummaryRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getSummaryRestaurant>>
>;
export type GetSummaryRestaurantQueryError = AxiosError<null>;

export function useGetSummaryRestaurant<
  TData = Awaited<ReturnType<typeof getSummaryRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getSummaryRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getSummaryRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getStaffsQueryKey = (id: string) => {
  return [`/restaurant/${id}/staffs`];
};

export const getStaffsQueryOptions = <
  TData = Awaited<ReturnType<typeof getStaffs>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getStaffs>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getStaffsQueryKey(id);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getStaffs>>> = ({
    signal,
  }) => getStaffs(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<Awaited<ReturnType<typeof getStaffs>>, TError, TData> & {
    queryKey: DataTag<QueryKey, TData, TError>;
  };
};

export type GetStaffsResult = NonNullable<
  Awaited<ReturnType<typeof getStaffs>>
>;
export type GetStaffsQueryError = AxiosError<null>;

export function useGetStaffs<
  TData = Awaited<ReturnType<typeof getStaffs>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getStaffs>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getStaffsQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getSummaryQueryKey = () => {
  return [`/restaurant/summary`];
};

export const getSummaryQueryOptions = <
  TData = Awaited<ReturnType<typeof getSummary>>,
  TError = AxiosError<null>,
>(options?: {
  query?: Partial<
    UseQueryOptions<Awaited<ReturnType<typeof getSummary>>, TError, TData>
  >;
  axios?: AxiosRequestConfig;
}) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getSummaryQueryKey();
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getSummary>>> = ({
    signal,
  }) => getSummary({ signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getSummary>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetSummaryResult = NonNullable<
  Awaited<ReturnType<typeof getSummary>>
>;
export type GetSummaryQueryError = AxiosError<null>;

export function useGetSummary<
  TData = Awaited<ReturnType<typeof getSummary>>,
  TError = AxiosError<null>,
>(
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getSummary>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getSummaryQueryOptions(options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const selectRestaurantListQueryKey = () => {
  return [`/restaurant/select-list`];
};

export const selectRestaurantListQueryOptions = <
  TData = Awaited<ReturnType<typeof selectRestaurantList>>,
  TError = AxiosError<null>,
>(options?: {
  query?: Partial<
    UseQueryOptions<
      Awaited<ReturnType<typeof selectRestaurantList>>,
      TError,
      TData
    >
  >;
  axios?: AxiosRequestConfig;
}) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? selectRestaurantListQueryKey();
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof selectRestaurantList>>
  > = ({ signal }) => selectRestaurantList({ signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof selectRestaurantList>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type SelectRestaurantListResult = NonNullable<
  Awaited<ReturnType<typeof selectRestaurantList>>
>;
export type SelectRestaurantListQueryError = AxiosError<null>;

export function useSelectRestaurantList<
  TData = Awaited<ReturnType<typeof selectRestaurantList>>,
  TError = AxiosError<null>,
>(
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof selectRestaurantList>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = selectRestaurantListQueryOptions(options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getRestaurantListQueryKey = () => {
  return [`/restaurant/list`];
};

export const getRestaurantListQueryOptions = <
  TData = Awaited<ReturnType<typeof getRestaurantList>>,
  TError = AxiosError<null>,
>(options?: {
  query?: Partial<
    UseQueryOptions<
      Awaited<ReturnType<typeof getRestaurantList>>,
      TError,
      TData
    >
  >;
  axios?: AxiosRequestConfig;
}) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getRestaurantListQueryKey();
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getRestaurantList>>
  > = ({ signal }) => getRestaurantList({ signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getRestaurantList>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetRestaurantListResult = NonNullable<
  Awaited<ReturnType<typeof getRestaurantList>>
>;
export type GetRestaurantListQueryError = AxiosError<null>;

export function useGetRestaurantList<
  TData = Awaited<ReturnType<typeof getRestaurantList>>,
  TError = AxiosError<null>,
>(
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getRestaurantList>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getRestaurantListQueryOptions(options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getPromotionsByRestaurantQueryKey = (id: string) => {
  return [`/promotion/restaurant/${id}`];
};

export const getPromotionsByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getPromotionsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getPromotionsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey =
    queryOptions?.queryKey ?? getPromotionsByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getPromotionsByRestaurant>>
  > = ({ signal }) =>
    getPromotionsByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getPromotionsByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetPromotionsByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getPromotionsByRestaurant>>
>;
export type GetPromotionsByRestaurantQueryError = AxiosError<null>;

export function useGetPromotionsByRestaurant<
  TData = Awaited<ReturnType<typeof getPromotionsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getPromotionsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getPromotionsByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getProductsByRestaurantQueryKey = (id: string) => {
  return [`/product/restaurant/${id}`];
};

export const getProductsByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getProductsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getProductsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey =
    queryOptions?.queryKey ?? getProductsByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getProductsByRestaurant>>
  > = ({ signal }) => getProductsByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getProductsByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetProductsByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getProductsByRestaurant>>
>;
export type GetProductsByRestaurantQueryError = AxiosError<null>;

export function useGetProductsByRestaurant<
  TData = Awaited<ReturnType<typeof getProductsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getProductsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getProductsByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getProductsByMenuQueryKey = (id: string) => {
  return [`/product/menu/${id}`];
};

export const getProductsByMenuQueryOptions = <
  TData = Awaited<ReturnType<typeof getProductsByMenu>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getProductsByMenu>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getProductsByMenuQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getProductsByMenu>>
  > = ({ signal }) => getProductsByMenu(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getProductsByMenu>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetProductsByMenuResult = NonNullable<
  Awaited<ReturnType<typeof getProductsByMenu>>
>;
export type GetProductsByMenuQueryError = AxiosError<null>;

export function useGetProductsByMenu<
  TData = Awaited<ReturnType<typeof getProductsByMenu>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getProductsByMenu>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getProductsByMenuQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getPaymentMethodsByRestaurantQueryKey = (id: string) => {
  return [`/payment-method/restaurant/${id}`];
};

export const getPaymentMethodsByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey =
    queryOptions?.queryKey ?? getPaymentMethodsByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>
  > = ({ signal }) =>
    getPaymentMethodsByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetPaymentMethodsByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>
>;
export type GetPaymentMethodsByRestaurantQueryError = AxiosError<null>;

export function useGetPaymentMethodsByRestaurant<
  TData = Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getPaymentMethodsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getPaymentMethodsByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getOrderByIdQueryKey = (id: string) => {
  return [`/order/${id}`];
};

export const getOrderByIdQueryOptions = <
  TData = Awaited<ReturnType<typeof getOrderById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getOrderById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getOrderByIdQueryKey(id);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getOrderById>>> = ({
    signal,
  }) => getOrderById(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getOrderById>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetOrderByIdResult = NonNullable<
  Awaited<ReturnType<typeof getOrderById>>
>;
export type GetOrderByIdQueryError = AxiosError<null>;

export function useGetOrderById<
  TData = Awaited<ReturnType<typeof getOrderById>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getOrderById>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getOrderByIdQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const applyPromotionQueryKey = (
  id: string,
  params: ApplyPromotionParamsZodType,
) => {
  return [`/order/${id}/apply-promotion`, { params }];
};

export const applyPromotionQueryOptions = <
  TData = Awaited<ReturnType<typeof applyPromotion>>,
  TError = AxiosError<null>,
>(
  id: string,
  params: ApplyPromotionParamsZodType,
  options?: {
    query?: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof applyPromotion>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? applyPromotionQueryKey(id, params);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof applyPromotion>>> = ({
    signal,
  }) => applyPromotion(id, params, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof applyPromotion>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type ApplyPromotionResult = NonNullable<
  Awaited<ReturnType<typeof applyPromotion>>
>;
export type ApplyPromotionQueryError = AxiosError<null>;

export function useApplyPromotion<
  TData = Awaited<ReturnType<typeof applyPromotion>>,
  TError = AxiosError<null>,
>(
  id: string,
  params: ApplyPromotionParamsZodType,
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof applyPromotion>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = applyPromotionQueryOptions(id, params, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getOrderLookupInfiniteQueryKey = (
  params: GetOrderLookupParamsZodType,
) => {
  return [`/order/lookup`, { params }];
};

export const getOrderLookupInfiniteQueryOptions = <
  TData = Awaited<ReturnType<typeof getOrderLookup>>,
  TError = AxiosError<null>,
>(
  params: GetOrderLookupParamsZodType,
  options?: {
    query?: Partial<
      UseInfiniteQueryOptions<
        Awaited<ReturnType<typeof getOrderLookup>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey =
    queryOptions?.queryKey ?? getOrderLookupInfiniteQueryKey(params);
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getOrderLookup>>> = ({
    signal,
    pageParam,
  }) =>
    getOrderLookup((pageParam ?? params) as GetOrderLookupParams, {
      signal,
      ...axiosOptions,
    });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseInfiniteQueryOptions<
    Awaited<ReturnType<typeof getOrderLookup>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetOrderLookupInfiniteResult = NonNullable<
  Awaited<ReturnType<typeof getOrderLookup>>
>;
export type GetOrderLookupInfiniteQueryError = AxiosError<null>;

export function useGetOrderLookup<
  TData = Awaited<ReturnType<typeof getOrderLookup>>,
  TError = AxiosError<null>,
>(
  params: GetOrderLookupParamsZodType,
  options?: {
    query: Partial<
      UseInfiniteQueryOptions<
        Awaited<ReturnType<typeof getOrderLookup>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseInfiniteQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getOrderLookupInfiniteQueryOptions(params, options);
  const query = useInfiniteQuery(
    queryOptions,
    queryClient,
  ) as UseInfiniteQueryResult<TData, TError> & {
    queryKey: DataTag<QueryKey, TData, TError>;
  };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getOrderHistoryByOrderQueryKey = (id: string) => {
  return [`/order-history/order/${id}`];
};

export const getOrderHistoryByOrderQueryOptions = <
  TData = Awaited<ReturnType<typeof getOrderHistoryByOrder>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getOrderHistoryByOrder>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getOrderHistoryByOrderQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getOrderHistoryByOrder>>
  > = ({ signal }) => getOrderHistoryByOrder(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getOrderHistoryByOrder>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetOrderHistoryByOrderResult = NonNullable<
  Awaited<ReturnType<typeof getOrderHistoryByOrder>>
>;
export type GetOrderHistoryByOrderQueryError = AxiosError<null>;

export function useGetOrderHistoryByOrder<
  TData = Awaited<ReturnType<typeof getOrderHistoryByOrder>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getOrderHistoryByOrder>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getOrderHistoryByOrderQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getOptionsByRestaurantQueryKey = (id: string) => {
  return [`/option/restaurant/${id}`];
};

export const getOptionsByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getOptionsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getOptionsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getOptionsByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getOptionsByRestaurant>>
  > = ({ signal }) => getOptionsByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getOptionsByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetOptionsByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getOptionsByRestaurant>>
>;
export type GetOptionsByRestaurantQueryError = AxiosError<null>;

export function useGetOptionsByRestaurant<
  TData = Awaited<ReturnType<typeof getOptionsByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getOptionsByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getOptionsByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getMenusByRestaurantQueryKey = (id: string) => {
  return [`/menu/restaurant/${id}`];
};

export const getMenusByRestaurantQueryOptions = <
  TData = Awaited<ReturnType<typeof getMenusByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query?: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getMenusByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getMenusByRestaurantQueryKey(id);
  const queryFn: QueryFunction<
    Awaited<ReturnType<typeof getMenusByRestaurant>>
  > = ({ signal }) => getMenusByRestaurant(id, { signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: !!id,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getMenusByRestaurant>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetMenusByRestaurantResult = NonNullable<
  Awaited<ReturnType<typeof getMenusByRestaurant>>
>;
export type GetMenusByRestaurantQueryError = AxiosError<null>;

export function useGetMenusByRestaurant<
  TData = Awaited<ReturnType<typeof getMenusByRestaurant>>,
  TError = AxiosError<null>,
>(
  id: string,
  options?: {
    query: Partial<
      UseQueryOptions<
        Awaited<ReturnType<typeof getMenusByRestaurant>>,
        TError,
        TData
      >
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getMenusByRestaurantQueryOptions(id, options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}

/**
 * Summary
 * Description
 */

export const getCurrentUserQueryKey = () => {
  return [`/auth/current-user`];
};

export const getCurrentUserQueryOptions = <
  TData = Awaited<ReturnType<typeof getCurrentUser>>,
  TError = AxiosError<null>,
>(options?: {
  query?: Partial<
    UseQueryOptions<Awaited<ReturnType<typeof getCurrentUser>>, TError, TData>
  >;
  axios?: AxiosRequestConfig;
}) => {
  const { query: queryOptions, axios: axiosOptions } = options ?? {};
  const queryKey = queryOptions?.queryKey ?? getCurrentUserQueryKey();
  const queryFn: QueryFunction<Awaited<ReturnType<typeof getCurrentUser>>> = ({
    signal,
  }) => getCurrentUser({ signal, ...axiosOptions });
  return {
    queryKey,
    queryFn,
    enabled: undefined,
    ...queryOptions,
  } as UseQueryOptions<
    Awaited<ReturnType<typeof getCurrentUser>>,
    TError,
    TData
  > & { queryKey: DataTag<QueryKey, TData, TError> };
};

export type GetCurrentUserResult = NonNullable<
  Awaited<ReturnType<typeof getCurrentUser>>
>;
export type GetCurrentUserQueryError = AxiosError<null>;

export function useGetCurrentUser<
  TData = Awaited<ReturnType<typeof getCurrentUser>>,
  TError = AxiosError<null>,
>(
  options?: {
    query: Partial<
      UseQueryOptions<Awaited<ReturnType<typeof getCurrentUser>>, TError, TData>
    >;
    axios?: AxiosRequestConfig;
  },
  queryClient?: QueryClient,
): UseQueryResult<TData, TError> & {
  queryKey: DataTag<QueryKey, TData, TError>;
} {
  const queryOptions = getCurrentUserQueryOptions(options);
  const query = useQuery(queryOptions, queryClient) as UseQueryResult<
    TData,
    TError
  > & { queryKey: DataTag<QueryKey, TData, TError> };
  query.queryKey = queryOptions.queryKey;

  return query;
}
