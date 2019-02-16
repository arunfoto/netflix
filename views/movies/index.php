<?php

use app\models\Movietype;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Movies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movies-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
<?=Html::a('Create Movies', ['create'], ['class' => 'btn btn-success'])?>
</p>

<?=GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class'      => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'filename',
			'link',
			//'poster',
			[
				'attribute' => 'poster',

				'format'  => 'html',
				'content' =>

function ($data) {

					$images = Html::img(Yii::getAlias('@web').'/uploads/'.$data->poster, ['alt' => '', 'width' => '30', 'height' => '30', 'data-toggle' => 'tooltip', 'data-placement' => 'left']);
					return $images;
				}
			],
			//'status',
			['attribute' => 'movietype',
				'value'     =>

				function ($model) {
					$myMemberModel = Movietype::find()->
					where(['id' => $model->movietype])->one();
					if (isset($myMemberModel)) {
						return $myMemberModel->name;
					} else {
						return ' id : '.$model->memberID.' do not match ';
					}
				}],

			['class' => 'yii\grid\ActionColumn'],
		],
	]);?>
</div>
