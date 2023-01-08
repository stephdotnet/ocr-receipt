import { useState } from 'react';
import { Box, Button, Container, Typography } from '@mui/material';
import Grid from '@mui/material/Unstable_Grid2';
import FileLoader from '@/components/FileLoader/FileLoader';
import FileInformation from './components/FileInformation';

const Home = () => {
  const [file, setFile] = useState<File | null>(null);

  const handleDelete = () => {
    setFile(null);
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
        <Box marginY={2}>
          {file && <FileInformation filename={file.name} filesize={file.size} handleDelete={handleDelete} />}
        </Box>
        <Box marginY={2}>
          <Button></Button>
        </Box>
      </Grid>
    </Container>
  );
};

export default Home;
