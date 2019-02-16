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
 */
class Movies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title', 'filename', 'poster'], 'required'],
            [['id', 'link', 'status'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['filename'], 'string', 'max' => 200],
            [['poster'], 'string', 'max' => 250],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'filename' => 'Filename',
            'link' => 'Link',
            'poster' => 'Poster',
            'status' => 'Status',
        ];
    }
}
