import { RouterProvider } from 'react-router-dom';
import '@fontsource/roboto/300.css';
import '@fontsource/roboto/400.css';
import '@fontsource/roboto/500.css';
import '@fontsource/roboto/700.css';
import '@css/app.scss';
import useRouter from '@hooks/useRouter';

export default function App() {
  const { router } = useRouter();

  return <RouterProvider router={router} />;
}
