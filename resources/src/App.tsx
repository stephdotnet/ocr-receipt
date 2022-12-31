import '@css/app.scss';

import '@fontsource/roboto/300.css';
import '@fontsource/roboto/400.css';
import '@fontsource/roboto/500.css';
import '@fontsource/roboto/700.css';

import { RouterProvider } from 'react-router-dom';
import useRouter from '@hooks/useRouter';

export default function App() {
  const { router } = useRouter();

  return <RouterProvider router={router} />;
}
