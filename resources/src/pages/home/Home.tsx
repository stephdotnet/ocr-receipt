import FileLoader from '@/components/FileLoader/FileLoader';
import { useHumanReadableFileSize } from '@/hooks/useHumanReadableFileSize';
import { Box, Card, Chip, Container, Typography } from '@mui/material';
import Grid from '@mui/material/Unstable_Grid2';
import { useState } from 'react';
import FileInformation from './components/FileInformation';

const Home = () => {
  const [file, setFile] = useState<File | null>(null);

  const handleDelete = () => {
    setFile(null);
  };

  const getFileLabel = () => {
    const fileSize = file ? file?.size / 1024 : 0;

    return `${file?.name} (${fileSize})`;
  };

  return (
    <Container>
      <Box marginY={2}>
        <Typography variant="h3" component="h1" textAlign="center">
          Home
        </Typography>
      </Box>
      <Grid mdOffset={2} smOffset={0} md={8} sm={12}>
        <FileLoader setFile={setFile} />
        <Box marginTop={2}>
          {file && <FileInformation filename={file.name} filesize={file.size} handleDelete={handleDelete} />}
        </Box>
      </Grid>
    </Container>
  );
};

export default Home;
