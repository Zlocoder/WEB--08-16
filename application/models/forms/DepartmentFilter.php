<?php

namespace app\models\forms;

use app\models\Department;

class DepartmentFilter extends \yii\base\Model {
    public $name;
    public $city;
    public $address;
    public $phone;

    public function rules() {
        return [
            [['name', 'city', 'address', 'phone'], 'string', 'max' => 25],
            ['phone', 'match', 'pattern' => '/^\d*$/']
        ];
    }

    public function getFilterQuery() {
        $this->validate();

        $query = Department::find();

        if ($this->name && !$this->hasErrors('name')) {
            $query->andWhere(['like', 'name', $this->name]);
        }

        if ($this->city && !$this->hasErrors('city')) {
            $query->andWhere(['like', 'city', $this->city]);
        }

        if ($this->address && !$this->hasErrors('address')) {
            $query->andWhere(['like', 'address', $this->address]);
        }

        if ($this->phone && !$this->hasErrors('phone')) {
            $query->andWhere(['like', 'phoneDigits', $this->phone]);
        }

        return $query;
    }
}