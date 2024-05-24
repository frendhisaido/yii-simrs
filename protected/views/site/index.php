<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php
$labels = array_keys($chartData);
$data = array_values($chartData);

$this->widget(
    'chartjs.widgets.ChBars',
    array(
        'width' => 600,
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
