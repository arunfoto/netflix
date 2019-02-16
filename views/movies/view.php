<?php

use app\models\Movietype;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Movies */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movies-view">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
<?=Html::a('Update', ['update', 'id'         => $model->id], ['class'         => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
		'class'                                    => 'btn btn-danger',
		'data'                                     => [
			'confirm'                                 => 'Are you sure you want to delete this item?',
			'method'                                  => 'post',
		],
	])?>
</p>

<?=DetailView::widget([
		'model'      => $model,
		'attributes' => [
			'id',
			'title',
			[
				'format'    => 'raw',
				'attribute' => 'filename',
				'value'     => !empty($model->filename)?'<video width="160" height="140" controls>
                              <source src="'.Yii::getAlias('@web').'/uploads/'.$model->filename.'" type="video/mp4">
                            </video>':null,
			],
			'link',
			[
				'attribute' => 'poster',
				'value'     => Yii::getAlias('@web').'/uploads/'.$model->poster,
				'format'    => ['image', ['width'    => '100', 'height'    => '100']],
			],
			[
				'attribute' => 'status',
				'value'     => ($model->status == 1)?"Active":"Inactive",

			],
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
		],
	])?>
</div>
