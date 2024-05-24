<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h2>Total tagihan chart: </h2>
<?php
$labels = array_keys($chartData);
$data = array_values($chartData);

$this->widget(
    'chartjs.widgets.ChBars',
    array(
        'width' => 800,
        'height' => 300,
        'htmlOptions' => array(),
        'labels' => $labels,
        'datasets' => array(
            array(
                "fillColor" => "#ff00ff",
                "strokeColor" => "rgba(220,220,220,1)",
                "data" => $data
            )
        ),
        'options' => array()
    )
);
?>
