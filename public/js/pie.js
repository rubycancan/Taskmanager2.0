var ctxPie = $('#pieChart')
var data = {
    datasets: [{
        data: [$('#pie-data').data('todo'), $('#pie-data').data('done')],
backgroundColor: [
    "#FF6384",
    "#36A2EB"
],
    hoverBackgroundColor: [
    "#FF6384",
    "#36A2EB"
]
}],

// These labels appear in the legend and in the tooltips when hovering different arcs
labels: [
    '未完成',
    '已完成'
]
};

var myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: data,
    options: {
        title: {
            display: true,
            text: '所有任务的完成比例（总数'+ $('#pie-data').data('total') +'）'
        }
    }
});