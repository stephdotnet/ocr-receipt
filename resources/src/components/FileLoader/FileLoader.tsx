import { Box, Card, Typography } from '@mui/material';
import React from 'react';
import { useEffect } from 'react';
import { useDropzone } from 'react-dropzone';
import classes from './fileLoader.module.scss';

interface FileLoaderProps {
  setFile: React.Dispatch<React.SetStateAction<File | null>>;
}

const FileLoader: React.FC<FileLoaderProps> = ({ setFile }) => {
  const { acceptedFiles, getRootProps, getInputProps, isFocused, isDragAccept, isDragReject } = useDropzone({
    accept: { 'image/*': [] },
  });

  useEffect(() => {
    setFile(acceptedFiles[0]);
  }, [acceptedFiles, setFile]);

  const getFileLoaderClassNames = () => {
    let classesCollection: string[] = [classes.dropzone];
    if (isFocused) {
      classesCollection.push(classes.focused);
    }
    if (isDragAccept) {
      classesCollection.push(classes.isDragAccept);
    }
    if (isDragReject) {
      classesCollection.push(classes.isDragReject);
    }

    return classesCollection.join(' ');
  };

  return (
    <Box className={classes.FileLoaderBox}>
      <Box {...getRootProps()} className={getFileLoaderClassNames()}>
        <input {...getInputProps()} />
        <Typography>Charger un fichier</Typography>
      </Box>
    </Box>
  );
};

export default FileLoader;
