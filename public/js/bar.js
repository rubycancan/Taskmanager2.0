var str = $('#bar-data').data('names')
// console.log(JSON.parse(str))

var ctxBar = $('#barChart');
var dataBar = {
    labels: str,
    datasets: [{
        // barPercentage: 0.5,
        // barThickness: 6,
        backgroundColor: 'rgba(54, 162,  235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        maxBarThickness: 50,
        borderWidth: 1,
        // minBarLength: 2,
        data: $('#bar-data').data('counts')
}]
};

var myBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: dataBar,
    options: {
        legend: { display:false },
        responsive: true,
        title: {
            display: true,
            text: '项目之间的任务总数对比'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,// y轴数据从0开始展示
                    fontColor: '#666666'
                }
            }]
        }
    }
});