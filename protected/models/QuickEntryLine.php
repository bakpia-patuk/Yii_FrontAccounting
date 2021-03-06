<?php

/**
 * This is the model class for table "quick_entry_line".
 *
 * The followings are the available columns in table 'quick_entry_line':
 * @property integer $id
 * @property integer $quick_entry_id
 * @property double $amount
 * @property integer $quick_entry_action_id
 * @property string $destination_id
 * @property integer $dimension1_id
 * @property integer $dimension2_id
 *
 * The followings are the available model relations:
 * @property Dimension $dimension1
 * @property Dimension $dimension2
 * @property QuickEntry $quickEntry
 * @property QuickEntryAction $quickEntryAction
 */
class QuickEntryLine extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuickEntryLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quick_entry_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quick_entry_id, quick_entry_action_id, destination_id', 'required'),
			array('quick_entry_id, quick_entry_action_id, dimension1_id, dimension2_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('destination_id', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quick_entry_id, amount, quick_entry_action_id, destination_id, dimension1_id, dimension2_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'dimension1' => array(self::BELONGS_TO, 'Dimension', 'dimension1_id'),
			'dimension2' => array(self::BELONGS_TO, 'Dimension', 'dimension2_id'),
			'quickEntry' => array(self::BELONGS_TO, 'QuickEntry', 'quick_entry_id'),
			'destination' => array(self::BELONGS_TO, 'Location', 'destination_id'),
			'quickEntryAction' => array(self::BELONGS_TO, 'QuickEntryAction', 'quick_entry_action_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quick_entry_id' => 'Quick Entry',
			'amount' => 'Amount',
			'quick_entry_action_id' => 'Quick Entry Action',
			'destination_id' => 'Destination',
			'dimension1_id' => 'Dimension1',
			'dimension2_id' => 'Dimension2',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('quick_entry_id',$this->quick_entry_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('quick_entry_action_id',$this->quick_entry_action_id);
		$criteria->compare('destination_id',$this->destination_id,true);
		$criteria->compare('dimension1_id',$this->dimension1_id);
		$criteria->compare('dimension2_id',$this->dimension2_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}