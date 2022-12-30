import {Container, Grid, Typography} from "@mui/material";
import TourCard from "@components/TourCard";

const Tours = () => {
  return <Container>
    <Typography variant="h1" textAlign="center">
      Tours
    </Typography>
    <Grid container spacing={2}>
      <TourCard/>
      <TourCard/>
      <TourCard/>
      <TourCard/>
    </Grid>
  </Container>;
}

export default Tours;