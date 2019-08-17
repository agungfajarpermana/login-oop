<?php

class Validation {
    private $_passed = false,
            $_errors = [];

    public function checkInput($items = [])
    {
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){

                switch ($rule) {
                    case 'required':
                        if(trim(Input::get($item)) == FALSE && $rule_value == TRUE)
                            $this->addError("$item wajib di isi!");
                        break;

                    case 'min':
                        if(strlen(Input::get($item)) < $rule_value)
                            $this->addError("$item minimal $rule_value karakter!");
                        break;

                    case 'max':
                        if(strlen(Input::get($item)) >= $rule_value)
                            $this->addError("$item maksimal $rule_value karakter!");
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}