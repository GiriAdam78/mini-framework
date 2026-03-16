<?php

namespace Core;

class Validator
{
    public static function validate($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $ruleString) {

            $rulesList = explode('|', $ruleString);
            $value = $data[$field] ?? null;

            foreach ($rulesList as $rule) {

                if ($rule === 'required' && empty($value)) {
                    $errors[$field][] = "$field is required";
                }

                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "$field must be a valid email";
                }

                if (str_starts_with($rule, 'min:')) {

                    $min = explode(':', $rule)[1];

                    if (strlen($value) < $min) {
                        $errors[$field][] = "$field must be at least $min characters";
                    }
                }
            }
        }

        if (!empty($errors)) {

            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $data;
    }
}