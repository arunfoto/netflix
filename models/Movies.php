<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movies".
 *
 * @property int $id
 * @property string $title
 * @property string $filename
 * @property int $link
 * @property string $poster
 * @property int $status
 * @property int $movietype
 */

class Movies extends \yii\db\ActiveRecord {
	/**
	 * {@inheritdoc}
	 */
	//public img1,mov1;
	public static function tableName() {
		return 'movies';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[['title', 'movietype'], 'required'],
			[['status', 'movietype'], 'integer'],
			[['filename'], 'file', 'extensions' => 'mp4'],
			[['poster'], 'file', 'extensions'   => 'png, jpg, jpeg'],
			[['link'], 'string', 'max'          => 500],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'        => 'ID',
			'title'     => 'Title',
			'filename'  => 'Filename',
			'link'      => 'Link',
			'poster'    => 'Poster',
			'status'    => 'Status',
			'movietype' => 'Movietype',
		];
	}
}
