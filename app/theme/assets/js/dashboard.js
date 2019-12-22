$(function(){
  'use strict'

  var ch1 = new Rickshaw.Graph({
    element: document.querySelector('#ch1'),
    renderer: 'area',
    max: 80,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 }
      ],
      color: 'rgba(255,255,255,0.5)'
    }]
  });
  ch1.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch1.configure({
      width: $('#ch1').width(),
      height: $('#ch1').height()
    });
    ch1.render();
  });

  var ch2 = new Rickshaw.Graph({
    element: document.querySelector('#ch2'),
    renderer: 'area',
    max: 80,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 15 },
        { x: 2, y: 38 },
        { x: 3, y: 40 },
        { x: 4, y: 32 },
        { x: 5, y: 50 },
        { x: 6, y: 65 },
        { x: 7, y: 70 },
        { x: 8, y: 45 },
        { x: 9, y: 55 },
        { x: 10, y: 60 },
        { x: 11, y: 50 },
        { x: 12, y: 40 }
      ],
      color: 'rgba(255,255,255,0.5)'
    }]
  });
  ch2.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch2.configure({
      width: $('#ch2').width(),
      height: $('#ch2').height()
    });
    ch2.render();
  });

  var ch3 = new Rickshaw.Graph({
    element: document.querySelector('#ch3'),
    renderer: 'area',
    max: 80,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 45 },
        { x: 2, y: 30 },
        { x: 3, y: 40 },
        { x: 4, y: 50 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 }
      ],
      color: 'rgba(255,255,255,0.5)'
    }]
  });
  ch3.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch3.configure({
      width: $('#ch3').width(),
      height: $('#ch3').height()
    });
    ch3.render();
  });

  var ch4 = new Rickshaw.Graph({
    element: document.querySelector('#ch4'),
    renderer: 'area',
    max: 80,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 45 },
        { x: 2, y: 30 },
        { x: 3, y: 40 },
        { x: 4, y: 50 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 }
      ],
      color: 'rgba(255,255,255,0.5)'
    }]
  });
  ch4.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch4.configure({
      width: $('#ch4').width(),
      height: $('#ch4').height()
    });
    ch4.render();
  });



  var newCust = [[0, 8], [1, 7], [2,7], [3, 8], [4, 7], [5, 8], [6, 9], [7, 9], [8, 9], [9, 8], [10, 9], [11, 8], [12, 7], [13,8], [14, 7], [15, 7], [16, 8], [17, 9], [18, 9], [19, 10]];
  var retCust = [[0, 1], [1, 2], [2,3], [3, 3], [4, 2], [5, 3], [6, 4], [7, 5], [8, 4], [9, 5], [10, 4], [11, 4], [12, 3], [13,4], [14, 4], [15, 5], [16, 5], [17, 4], [18, 6], [19, 7]];

  var plot = $.plot($('#ch5'),[
    {
      data: newCust,
      label: 'Bounce Rate',
      color: '#17A2B8'
    },
    {
      data: retCust,
      label: 'Page Views',
      color: '#4E6577'
    }
  ],{
    series: {
      lines: {
        show: false
      },
      splines: {
        show: true,
        tension: 0.4,
        lineWidth: 0,
        fill: 0.5
      },
      shadowSize: 0
    },
    points: {
      show: false,
    },
    grid: {
      hoverable: true,
      clickable: true,
      borderColor: '#ddd',
      borderWidth: 0,
      labelMargin: 5,
      backgroundColor: '#fff'
    },
    yaxis: {
      min: 0,
      max: 15,
      color: '#eee',
      font: {
        size: 10,
        color: '#999'
      }
    },
    xaxis: {
      color: '#eee',
      font: {
        size: 10,
        color: '#999'
      }
    }
  });

  var ch6 = new Rickshaw.Graph({
    element: document.querySelector('#ch6'),
    renderer: 'area',
    max: 50,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 }
      ],
      color: '#1CAF9A'
    }]
  });
  ch6.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch6.configure({
      width: $('#ch6').width(),
      height: $('#ch6').height()
    });
    ch6.render();
  });


  $('#ch7').sparkline('html', {
    type: 'bar',
    barWidth: 10,
    height: 70,
    barColor: '#17A2B8',
    chartRangeMax: 12
  });

  $('#ch8').sparkline('html', {
    type: 'bar',
    barWidth: 10,
    height: 70,
    barColor: '#20C997',
    chartRangeMax: 12
  });

  $('#ch9').sparkline('html', {
    type: 'bar',
    barWidth: 10,
    height: 70,
    barColor: '#3A4293',
    chartRangeMax: 12
  });

  var ch10 = new Rickshaw.Graph({
    element: document.querySelector('#ch10'),
    renderer: 'bar',
    max: 50,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 35 }
      ],
      color: '#6F42C1'
    }]
  });
  ch10.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch10.configure({
      width: $('#ch10').width(),
      height: $('#ch10').height()
    });
    ch10.render();
  });

  var ch11 = new Rickshaw.Graph({
    element: document.querySelector('#ch11'),
    renderer: 'bar',
    max: 50,
    series: [{
      data: [
        { x: 0, y: 35 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 }
      ],
      color: '#6F42C1'
    }]
  });
  ch11.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch11.configure({
      width: $('#ch11').width(),
      height: $('#ch11').height()
    });
    ch11.render();
  });

  // Horizontal bar chart
  var ch12data = [
    {
      name: 'Oranges',
      type: 'bar',
      data: [20, 20, 36, 12, 15]
    },
    {
      name: 'Apples',
      type: 'bar',
      data: [8, 5, 25, 10, 10]
    }
  ];

  var ch12Option = {
    grid: {
      top: '6',
      right: '0',
      bottom: '17',
      left: '32',
    },
    xAxis: {
      type: 'value',
      axisLine: {
        lineStyle: {
          color: '#ccc'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#666'
      }
    },
    yAxis: {
      type: 'category',
      data: [ '2006', '2008', '2010', '2012', '2014'],
      splitLine: {
        lineStyle: {
          color: '#ddd'
        }
      },
      axisLine: {
        lineStyle: {
          color: '#ccc'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#666'
      }
    },
    series: ch12data,
    color: ['#17A2B8', '#6F42C1']
  };

  var ch12id = document.getElementById('ch12');
  var ch12 = echarts.init(ch12id);
  ch12.setOption(ch12Option);

  new ResizeSensor($('.br-mainpanel'), function(){
    ch12.resize();
  });

  var ch13 = new Rickshaw.Graph({
    element: document.querySelector('#ch13'),
    renderer: 'bar',
    stack: false,
    max: 60,
    series: [{
      data: [
        { x: 0, y: 20 },
        { x: 1, y: 25 },
        { x: 2, y: 10 },
        { x: 3, y: 15 },
        { x: 4, y: 20 },
        { x: 5, y: 40 },
        { x: 6, y: 15 },
        { x: 7, y: 40 },
        { x: 8, y: 25 }
      ],
      color: '#f25766'
    },
    {
      data: [
        { x: 0, y: 10 },
        { x: 1, y: 30 },
        { x: 2, y: 45 },
        { x: 3, y: 30 },
        { x: 4, y: 42 },
        { x: 5, y: 20 },
        { x: 6, y: 30 },
        { x: 7, y: 15 },
        { x: 8, y: 20 }
      ],
      color: '#aa2531'
    }]
  });

  ch13.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    ch13.configure({
      width: $('#ch13').width(),
      height: $('#ch13').height()
    });
    ch13.render();
  });

});
