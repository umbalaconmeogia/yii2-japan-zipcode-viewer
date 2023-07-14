<?php

namespace umbalaconmeogia\japanzipcodecsv\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use umbalaconmeogia\japanzipcodecsv\models\Zipcode;
use yii\db\ActiveQuery;

/**
 * ZipcodeSearch represents the model behind the search form of `umbalaconmeogia\japanzipcodecsv\models\Zipcode`.
 */
class ZipcodeSearch extends Zipcode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'multiple_zip_code', 'has_banchi', 'has_chome', 'multiple_town_area', 'modified', 'modified_reason'], 'integer'],
            [['local_public_entity_code', 'old_zip_code', 'zip_code', 'prefecture_name_kana', 'city_ward_town_village_name_kana', 'town_area_name_kana', 'prefecture_name_kanji', 'city_ward_town_village_name_kanji', 'town_area_name_kanji'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Zipcode::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'multiple_zip_code' => $this->multiple_zip_code,
            'has_banchi' => $this->has_banchi,
            'has_chome' => $this->has_chome,
            'multiple_town_area' => $this->multiple_town_area,
            'modified' => $this->modified,
            'modified_reason' => $this->modified_reason,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'multiple_zip_code' => $this->multiple_zip_code,
            'has_banchi' => $this->has_banchi,
            'has_chome' => $this->has_chome,
            'multiple_town_area' => $this->multiple_town_area,
            'modified' => $this->modified,
            'modified_reason' => $this->modified_reason,
        ]);

        $this->andFilterWhere($query, 'local_public_entity_code', $this->local_public_entity_code)
            ->andFilterWhere($query, 'old_zip_code', $this->old_zip_code)
            ->andFilterWhere($query, 'zip_code', $this->zip_code)
            ->andFilterWhere($query, 'prefecture_name_kana', $this->prefecture_name_kana)
            ->andFilterWhere($query, 'city_ward_town_village_name_kana', $this->city_ward_town_village_name_kana)
            ->andFilterWhere($query, 'town_area_name_kana', $this->town_area_name_kana)
            ->andFilterWhere($query, 'prefecture_name_kanji', $this->prefecture_name_kanji)
            ->andFilterWhere($query, 'city_ward_town_village_name_kanji', $this->city_ward_town_village_name_kanji)
            ->andFilterWhere($query, 'town_area_name_kanji', $this->town_area_name_kanji);

        return $dataProvider;
    }

    /**
     * Add LIKE condition, if there is % in the $value, then does not wrap its by %%.
     * @param ActiveQuery $query
     * @param string $attribute
     * @param mixed $value
     * @return $this
     */
    protected function andFilterWhere(ActiveQuery $query, $attribute, $value)
    {
        $fullTextSearch = strpos($value, '%') === FALSE;
        $query->andFilterWhere(['like', $attribute, $value, $fullTextSearch]);
        return $this;
    }
}
