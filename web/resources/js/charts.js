import { Chart } from 'tw-elements';

new Chart(
  document.getElementById('line-chart'),
  {
    type: 'bar',
    data: {
      labels: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
      ],
      datasets: [
        {
          label: 'Registration',
          data: dataLine,
          backgroundColor: ['rgba(239, 68, 68, 1)'],
        },
      ],
    },
  },
  {
    options: {
      plugins: {
        legend: {
          position: 'bottom',
          align: 'end',
        },
      },
      interaction: {
        mode: 'index',
        intersect: false,
      },
    },
  }
);

new Chart(
  document.getElementById('pie-chart'),
  {
    type: 'pie',
    data: {
      labels: ['General', 'JKN (National Health Insurance)'],
      datasets: [
        {
          label: 'Patient',
          data: dataPie,
          backgroundColor: ['rgba(234, 179, 8, 1)', 'rgba(34, 197, 94, 1)'],
        },
      ],
    },
  },
  {
    options: {
      plugins: {
        legend: {
          position: 'bottom',
        },
      },
    },
  }
);
