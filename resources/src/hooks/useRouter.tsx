import { createBrowserRouter } from 'react-router-dom';

import Home from '@/pages/home/Home';
import Layout from '@layouts/Layout';
import ErrorPage from '@/pages/ErrorPage';

export interface headerNavItem {
  path: string;
  label: string;
}

const useRouter = () => {
  const pages = {
    home: {
      path: '/',
      slug: 'home',
    },
    tours: {
      path: '/tours',
      slug: 'tours',
    },
  };

  const isActive = (locationPathname: string, toPathname: string) => {
    return (
      locationPathname === toPathname ||
      (locationPathname.startsWith(toPathname) && locationPathname.charAt(toPathname.length) === '/')
    );
  };

  const router = createBrowserRouter([
    {
      element: <Layout />,
      children: [
        {
          path: pages.home.path,
          element: <Home />,
        },
      ],
      errorElement: <ErrorPage />,
    },
  ]);

  const headerNav: headerNavItem[] = [
    {
      path: pages.home.path,
      label: 'Home',
    },
    {
      path: pages.tours.path,
      label: 'Tours',
    },
  ];

  return {
    router,
    headerNav,
    isActive,
  };
};

export default useRouter;
