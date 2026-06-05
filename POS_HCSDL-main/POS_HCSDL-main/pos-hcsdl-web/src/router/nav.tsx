import {
  MenuIcon,
  OptionIcon,
  PaymentMethodIcon,
  ProductIcon,
  PromotionIcon,
  ShiftIcon,
  StaffIcon,
  TableIcon,
  TableListIcon,
  ToppingIcon,
} from '@/icons';

export const paths = {
  home: '/',
  login: '/login',
  table: '/table-manage',
  menu: '/menu-manage',
  topping: '/topping-manage',
  option: '/option-manage',
  category: '/category',
  product: '/product-manage',
  promotion: '/promotion-manage',
  connect: '/connect',
  productStore: '/product-store',
  productSupplier: '/product-supplier',
  tableOrder: '/table-order',
  orderMenu: '/order/:id',
  payment: '/payment/:orderId',
  paymentMethod: '/payment-method-manage',
  shift: '/shift',
  employee: '/staff-manage',
  orderManage: '/order-manage',
  restaurantManage: '/restaurant-manage'
};

export const nav = [
  {
    name: 'Table Order',
    path: paths.tableOrder,
    icon: <TableListIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'STAFF'],
  },
  {
    name: 'Order Management',
    path: paths.orderManage,
    icon: (
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        strokeWidth="1.5"
        stroke="currentColor"
        className="size-5"
      >
        <path
          strokeLinecap="round"
          strokeLinejoin="round"
          d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
        />
      </svg>
    ),
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Restaurant Management',
    path: paths.restaurantManage,
    icon: (
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        strokeWidth="1.5"
        stroke="currentColor"
        className="size-5"
      >
        <path
          strokeLinecap="round"
          strokeLinejoin="round"
          d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"
        />
      </svg>
    ),
    accessibleRoles: ['ADMIN'],
  },
  {
    name: 'Shift',
    path: paths.shift,
    icon: <ShiftIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'STAFF'],
  },
  {
    name: 'Table Manage',
    path: paths.table,
    icon: <TableIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Menu manage',
    path: paths.menu,
    icon: <MenuIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Topping manage',
    path: paths.topping,
    icon: <ToppingIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Option manage',
    path: paths.option,
    icon: <OptionIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Product',
    path: paths.product,
    icon: <ProductIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Promotion',
    path: paths.promotion,
    icon: <PromotionIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Payment Method',
    path: paths.paymentMethod,
    icon: <PaymentMethodIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
  {
    name: 'Staff Management',
    path: paths.employee,
    icon: <StaffIcon />,
    accessibleRoles: ['ADMIN_RESTAURANT', 'ADMIN'],
  },
];