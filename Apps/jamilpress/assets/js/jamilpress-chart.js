
       

const labels = [
  'Monday',
  'Tuesday',
  'Wednessday',
  'Thursday',
  'Friday',
  'Saturday',
  'Sunday',
];
const visits = {
    label: 'Visits',
    backgroundColor: 'green',
    borderColor: 'green',
    data: [0, 5, 15, 21, 30, 20, 15],
}


const comments = {
    label: 'Comments',
    backgroundColor: 'blue',
    borderColor: 'blue',
    data: [5, 28, 25, 28, 40, 26, 45],
}

const views = {
    label: 'Views',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [15, 0, 19, 51, 70, 30, 25],
}
const data = {
  labels: labels,
  datasets: [
      visits,
      views,
      comments
  ]
};
const config = {
  type: 'line',
  data: data,
  options: {}
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
    