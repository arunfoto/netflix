<?php

use app\models\Movietype;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Movies */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="movies-form col-sm-6">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

<?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

<?=$form->field($model, 'filename')->fileInput();?>

<?php if ($model->filename != "") {
	?>
						    <video width="160" height="140" controls>
						      <source src="<?php echo Yii::getAlias('@web').'/uploads/'.$model->filename;?>" type="video/mp4">
						    </video>
	<?php
}?>

<?=$form->field($model, 'link')->textInput()?>

<?=$form->field($model, 'poster')->fileInput();?>

<?php if ($model->poster != "") {
	print(Html::img(Yii::getAlias('@web').'/uploads/'.$model->poster, ['alt' => '', 'width' => '130', 'height' => '130', 'data-toggle' => 'tooltip', 'data-placement' => 'left']));

}?>

<?php /*= $form->field($model, 'status')->textInput() */?>

<?=
$form->field($model, 'movietype')
     ->dropDownList(
	ArrayHelper::map(Movietype::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Option']
)
?>
<div class="form-group">
<?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
</div>

<?php ActiveForm::end();?>
</div>
