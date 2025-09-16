<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller
{
    public function month()
    {
        echo json_encode(array(
            "chartData" =>  array(
                "labels"    =>  ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                "datasets"  =>  array(
                    [
                        'label' => 'label1',
                        'data'  =>  [28, 48, 40, 19, 86, 27, 90]
                    ],
                    [
                        'label' => 'label2',
                        'data'  =>  [65, 59, 80, 81, 56, 55, 40]
                    ]
                ),
                "salesChartOptions" =>  array(
                    "maintainAspectRatio"   =>  false,
                    "responsive"            =>  true,
                    "legend"                =>  ["display"=>true],
                    "scales"                =>  [
                        "xAxes" =>  [
                            "gridLines" =>  ["display"=>false]
                        ],
                        "yAxes" =>  [
                            "gridLines" =>  ["display"=>false]
                        ]
                    ]
                )
            )
            ));
        exit;
    }
}