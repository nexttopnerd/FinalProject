<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/19/14
 * Time: 5:55 PM
 */
function checkTextInput(&$field, &$fieldName, &$fieldIcon, &$fieldMessage){
    $field = strip_tags($field);
    $field = trim($field);
    if ($field == "")
        setEmptyError($fieldName, $fieldIcon, $fieldMessage);
    else if (!ctype_alpha(str_replace(' ', '', $field)))
        setTypeError($fieldName, $fieldIcon, $fieldMessage, "alphabets");
    else if (strlen($field) > 30)
        setLengthError($fieldName, $fieldIcon, $fieldMessage, "not exceed 30 characters");
    else
        setSuccess($fieldName, $fieldIcon);


}

function checkSelectInput($field, &$fieldName, &$fieldIcon, &$fieldMessage){
    if ($field == "0")
        setEmptyError($fieldName, $fieldIcon, $fieldMessage);
    else
        setSuccess($fieldName, $fieldIcon);
}

function checkRadioInput($type, &$fieldName, &$fieldIcon, &$fieldMessage){
    if (!isset($_POST[$type]))
        setEmptyError($fieldName, $fieldIcon, $fieldMessage);
    else
        setSuccess($fieldName, $fieldIcon);

}

function checkNumericalInput(&$field, &$fieldName, &$fieldIcon, &$fieldMessage){
    $field = strip_tags($field);
    $field = trim($field);
    if ($field=="")
        setEmptyError($fieldName, $fieldIcon, $fieldMessage);
    else if ($field > 20)
        setLengthError($fieldName, $fieldIcon, $fieldMessage, "not exceed 20");
    else if ($field < 0)
        setLengthError($fieldName, $fieldIcon, $fieldMessage, "not be negative");
    else
        setSuccess($fieldName, $fieldIcon);
}

function checkAreaInput(&$field, &$fieldName, &$fieldIcon, &$fieldMessage){
    $field = strip_tags($field);
    $field = trim($field);
    if ($field=="")
        setEmptyError($fieldName, $fieldIcon, $fieldMessage);
    else if (!ctype_alnum(str_replace(' ','',$field)))
        setTypeError($fieldName, $fieldIcon, $fieldMessage, "alphanumeric characters");
    else if (strlen($field) > 100)
        setLengthError($fieldName, $fieldIcon, $fieldMessage, "not exceed 100 characters");
    else
        setSuccess($fieldName, $fieldIcon);

}

function setEmptyError(&$fieldName, &$fieldIcon, &$fieldMessage){
    $fieldName = "has-error has-feedback";
    $fieldIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
    $fieldMessage = "This field is required";
    GLOBAL $error;
    $error = true;
}

function setTypeError(&$fieldName, &$fieldIcon, &$fieldMessage, $typeError){
    $fieldName = "has-error has-feedback";
    $fieldIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
    $fieldMessage = "This field must contain only ".$typeError;
    GLOBAL $error;
    $error = true;
}

function setLengthError(&$fieldName, &$fieldIcon, &$fieldMessage, $message){
    $fieldName = "has-error has-feedback";
    $fieldIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
    $fieldMessage = "This field can".$message;
    GLOBAL $error;
    $error = true;
}

function setSuccess(&$fieldName, &$fieldIcon){
    $fieldName = "has-success has-feedback";
    $fieldIcon = "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";
}