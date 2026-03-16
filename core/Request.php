<?php

namespace Core;
use Core\Validator;

class Request
{
    public function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function input($key, $default = null){
        return $_REQUEST[$key] ?? $default;
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function get($key)
    {
        return $_GET[$key] ?? null;
    }

    public function post($key)
    {
        return $_POST[$key] ?? null;
    }

    public function validate(array $rules)
    {
        $errors = [];
        $data = [];

        foreach ($rules as $field => $ruleString) {

            $value = $this->input($field);
            $ruleList = explode('|', $ruleString);

            foreach ($ruleList as $rule) {

                // required
                if ($rule === 'required' && empty($value)) {
                    $errors[$field][] = "$field is required";
                }

                // email
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "$field must be a valid email";
                }

                // min
                if (str_starts_with($rule, 'min:')) {

                    $min = explode(':', $rule)[1];

                    if (strlen($value) < $min) {
                        $errors[$field][] = "$field must be at least $min characters";
                    }
                }
            }

            $data[$field] = $value;
        }

        if (!empty($errors)) {
            throw new \Exception(json_encode($errors));
        }

        return Validator::validate($_POST, $rules);
    }
}