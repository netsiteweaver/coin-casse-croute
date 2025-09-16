/* global Chart:false */

$(function () {
    'use strict'
  
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
  
    //-----------------------
    // - MONTHLY SALES CHART -
    //-----------------------
  
    // Get context with jQuery - using jQuery's .get() method.
    
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
    var salesChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June'],
      datasets: [
        {
          label: 'Cash',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [48, 40, 19, 45, 27, 25]
        },
        // {
        //   label: 'MCB Juice',
        //   backgroundColor: 'rgba(210, 214, 222, 1)',
        //   borderColor: 'rgba(210, 214, 222, 1)',
        //   pointRadius: false,
        //   pointColor: 'rgba(210, 214, 222, 1)',
        //   pointStrokeColor: '#c1c7d1',
        //   pointHighlightFill: '#fff',
        //   pointHighlightStroke: 'rgba(220,220,220,1)',
        //   data: [65, 59, 80, 56, 55, 40]
        // },
        {
          label: 'MyT Money',
          backgroundColor: 'rgba(210, 100, 45, .7)',
          borderColor: 'rgba(210, 100, 45, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 100, 45, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#4c4c4c',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [59, 32, 24, 56, 55, 40]
        }
      ]
    }
  
    var salesChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          }
        }]
      }
    }
  
    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, {
      type: 'line',
      data: salesChartData,
      options: salesChartOptions
    }
    )
  
    //---------------------------
    // - END MONTHLY SALES CHART -
    //---------------------------

    // var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
    // $.ajax({
    //     url: base_url + "ajax/sales/month",
    //     success: function (result) {
    //         // console.log(result)
    //         var data = [];
    //         var myChart = new Chart(salesChartCanvas, {
    //             type: 'line',
    //             data: result.datasets,
    //             options: result.salesChartOptions
    //         });
    //     }
    // });
    
  })
  