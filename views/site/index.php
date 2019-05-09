<?php
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<?php if(Yii::$app->user->isGuest) {
	Yii::$app->response->redirect(['site/login']);
}
?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "My First Chart in CanvasJS"
		},
		data: [
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "splineArea",
			dataPoints: [
				{ label: "apple",  y: 10  },
				{ label: "orange", y: 15  },
				{ label: "banana", y: 25  },
				{ label: "mango",  y: 30  },
				{ label: "grape",  y: 28  }
			]
		}
		]
	});
	chart.render();

  var chart = new CanvasJS.Chart("chartContainer1", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "State Operating Funds"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: 26, name: "School Aid", exploded: true },
			{ y: 20, name: "Medical Aid" },
			{ y: 5, name: "Debt/Capital" },
			{ y: 3, name: "Elected Officials" },
			{ y: 7, name: "University" },
			{ y: 17, name: "Executive" },
			{ y: 22, name: "Other Local Assistance"}
		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
<div id="chartContainer" style="height: 300px; width: 500px;margin:0 auto;"></div>
<div id="chartContainer1" style="height: 300px; width: 500px;margin:0 auto;"></div>
