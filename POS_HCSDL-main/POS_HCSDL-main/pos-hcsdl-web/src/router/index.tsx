import { lazy } from 'react';
import { Outlet, type RouteObject } from 'react-router-dom';
import { ProtectedRouter } from './ProtectedRouter.tsx';
import { Root } from '@/pages';
import { paths } from '@/router/nav.tsx';

const Login = lazy(() => import('../pages/login'));
const Home = lazy(() => import('../pages/home'));
const Table = lazy(() => import('../pages/table-manage'));
const Menu = lazy(() => import('../pages/menu-manage'));
const Topping = lazy(() => import('../pages/topping-manage'));
const Option = lazy(() => import('../pages/option-manage'));
const Product = lazy(() => import('../pages/product-manage'));
const Promotion = lazy(() => import('../pages/promotion-manage'));
const TableOrder = lazy(() => import('../pages/table-order'));
const OrderMenu = lazy(() => import('../pages/order-menu'));
const Payment = lazy(() => import('../pages/payment'));
const PaymentMethod = lazy(() => import('../pages/payment-method-manage'));
const Shift = lazy(() => import('../pages/shift-manage'));
const Staff = lazy(() => import('../pages/employee-manage'));
const OrderManage = lazy(() => import('../pages/order-manage'));
const RestaurantManage = lazy(() => import('../pages/restaurant-manage'));


export const routes: RouteObject[] = [
  {
    element: (
      <ProtectedRouter>
        <Root />
      </ProtectedRouter>
    ),
    path: '/',
    children: [
      {
        path: paths.home,
        element: <Home />,
        index: true,
      },
      {
        path: paths.table,
        element: <Table />,
        index: true,
      },
      {
        path: paths.menu,
        element: <Menu />,
        index: true,
      },
      {
        path: paths.topping,
        element: <Topping />,
        index: true,
      },
      {
        path: paths.option,
        element: <Option />,
        index: true,
      },
      {
        path: paths.product,
        element: <Product />,
        index: true,
      },
      {
        path: paths.promotion,
        element: <Promotion />,
        index: true,
      },
      {
        path: paths.tableOrder,
        element: <TableOrder />,
        index: true,
      },
      {
        path: paths.orderMenu,
        element: <OrderMenu />,
        index: true,
      },
      {
        path: paths.payment,
        element: <Payment />,
        index: true,
      },
      {
        path: paths.paymentMethod,
        element: <PaymentMethod />,
        index: true,
      },
      {
        path: paths.shift,
        element: <Shift />,
        index: true,
      },
      {
        path: paths.employee,
        element: <Staff />,
        index: true,
      },
      {
        path: paths.orderManage,
        element: <OrderManage />,
        index: true,
      },
      {
        path: paths.restaurantManage,
        element: <RestaurantManage />,
        index: true,
      },
    ],
  },
  {
    path: paths.login,
    element: <Login />,
    index: true,
  },
];
