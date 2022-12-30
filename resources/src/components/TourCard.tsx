import Paper from "@mui/material/Paper";
import {Box, Grid, Rating, Typography} from "@mui/material";
import AccessTime from "@mui/icons-material/AccessTime";

export default function TourCard ({ size = 3, rating = 2.5}) {
  return <Grid item xs={size}>
    <Paper className="TourCard">
      <img
        src="https://www.esl.fr/sites/default/files/styles/hero_banner/public/country/CostaRica-Hero_0.jpg?itok=D8OV-x-Q"
        alt="costa rica"/>

      <Box px={1}>
        <Typography variant="subtitle2" component="h2">
          Costa rica amazong !
        </Typography>
        <Box
          sx={{
            display: "flex",
            alignItems: "center"
          }}
        >
          <AccessTime
            sx={{
              width: 14
            }}
          />
          <Typography variant="body2" component="p" ml={0.5}>
            5 hours
          </Typography>
        </Box>
        <Box
          sx={{
            display: "flex",
            alignItems: "center",
            marginTop: 2
          }}
        >
          <Rating
            readOnly
            value={rating}
            precision={0.25}
            size="small"
          />
          <Typography variant="body2" component="p" ml={0.5}>
            {rating}
          </Typography>
          <Typography variant="body2" component="p" ml={1.5}>
            (655 reviews)
          </Typography>
        </Box>
        <Box>
          <Typography variant="h6" component="h3">
            500€
          </Typography>
        </Box>
      </Box>

    </Paper>
  </Grid>

  // return <div>Card</div>;
}
