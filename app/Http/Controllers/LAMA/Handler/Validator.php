<?php


namespace App\Http\Controllers\LAMA\Handler;


use function GuzzleHttp\Psr7\str;

class Validator
{
    private $errors = [
        'global' => 0,
        'items' => []
    ];

    public function validation($data, $ruleset) {
        if (array_diff(array_keys($data), array_keys($ruleset)) != []) {
            $this->errors['global'] = 70001;
            return 0;
        }
        foreach($ruleset as $rulesetKey => $rules) {
            foreach ($rules as $ruleKey => $params) {
                $method = 'Validate' . ucfirst($ruleKey);
                if (method_exists($this, $method)) {
                    $this->$method($data[$rulesetKey], $params, $rulesetKey);
                } else {
                    $this->errors['global'] = 70002;
                    return 0;
                }
            }
        }
    }

    private function ValidateLengthBetween($data, $params, $key) {
        $params = explode('|', $params);
        if (strlen($data) < $params[0] || strlen($data) > $params[1])
            $this->errors['items'][$key][] = 80000;
    }

    public function getErrors() {
        return $this->errors;
    }

}
