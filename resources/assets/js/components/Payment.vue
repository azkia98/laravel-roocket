<template>
    <div>
        <canvas style="width:100%" height="400" ref="payment"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props : ['labels' , 'values'],

        mounted() {

            var ctx = this.$refs.payment.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'پرداخت های موفق',
                        data: this.values.success,
                        backgroundColor: 'rgba(52, 152, 219,0.5)',
                        borderColor: 'rgba(41, 128, 185,1.0)',
                        borderWidth: 1
                    },{
                        label: 'پرداخت های ناموفق',
                        data: this.values.unsuccess,
                        backgroundColor: 'rgba(231, 76, 60,.5)',
                        borderColor: 'rgba(192, 57, 43,1.0)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>
