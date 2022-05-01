<template>
<canvas id="myChart" class="h-100" width="100%" height="75%"></canvas>
</template>


<script>
import Chart from 'chart.js/auto';
import axios from 'axios';
export default {
    data() {
        return {
            chartValues: [],
        }
    },
    methods: {
        initProps(){


        },async initChart(){
            await this.getChartValues();

            const ctx = document.getElementById('myChart');
            const data = {
              labels: ['janv', 'févr', 'mars', 'avril', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc'],
              datasets: [{
                label: 'Ventes',
                data: this.chartValues,
                fill: false,
                  backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235,1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    tension: 0

              }],
            };

            const myChart = new Chart(ctx, {
               type: 'line',
                data: data,
                  options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
                });

        },async getChartValues(){
            let response = await axios.get('/admin/statistique/chart');

            if(response.data.success){

                this.chartValues = response.data.values;
            }

        }

    },

    mounted() {
        this.initChart();

    }
}
</script>
