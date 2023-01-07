import { useHumanReadableFileSize } from '@/hooks/useHumanReadableFileSize';
import Chip from '@mui/material/Chip';

type FileInformationProps = {
  filename: string;
  filesize: number;
  handleDelete: () => void;
};

const FileInformation: React.FC<FileInformationProps> = ({ filename, filesize, handleDelete }) => {
  const humanReadable = useHumanReadableFileSize(filesize);

  return <Chip label={`${filename} (${humanReadable})`} variant="outlined" onDelete={handleDelete} />;
};

export default FileInformation;
