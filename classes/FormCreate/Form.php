<?php

namespace FormCreate;

class Form
{

    /* The name to be displayed above the form
    * @String
    */
    public $formTitle;

    /* The path to a CSS stylesheet
    * @String
    */
    public $pathToCSS;

    /* Define the action URL
    * @String
    */
    public $actionURL;

    /* Define an array with the form field names
    * @Array
    */
    public $fields;

    /* Set form buttons
    *
    */
    public $buttons;

    /* Set the form title
    * Optional
    */
    public function setFormTitle(string $title)
    {
        $this->formTitle = $title;
    }

    /* Returns the form title
    * @String
    */
    public function getFormTitle():string
    {
        return $this->formTitle;
    }

    /* Sets the form fields
    *
    */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /* Set form buttons
    * Receives an array
    */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }

    /* Set all values of the form (the value attribute);
    * Expects an array with all values in the right order
    */
    public function setValues($values)
    {
        $fields = $this->fields;
        $fields = json_encode($fields);
        $fields = json_decode($fields);

        $count=0;
        foreach ($fields as $row) {
            foreach ($row as $result) {
                $result->value=$values[$count];
                $count++;
            }
        }

        $fields = json_encode($fields);
        $fields = json_decode($fields, true);

        $this->fields = $fields;
    }

    /* Set a specific form attribute value
    *
    */
    public function setFormAttributeValue($options)
    {
        $registerFields = $this->fields;
        $registerFields = json_encode($registerFields);
        $registerFields = json_decode($registerFields);

        $selectedGroupField = $options['groupField'];
        $selectedField = $options['field'];
        $attribute = $options['attribute'];
        $fieldValue = $options['value'];

        foreach ($registerFields as $key => $row) {

            if ($key===$selectedGroupField) {

                foreach ($row as $key => $field) {

                    if ($key===$selectedField) {

                        $field->$attribute=$fieldValue;

                    }

                }

            }

        }

        $registerFields = json_encode($registerFields);
        $registerFields = json_decode($registerFields, true);
        $this->fields = $registerFields;
    }

    /* Set CSS stylesheet path
    * Optional
    */
    public function setCSS(string $pathToCSS)
    {
        $this->pathToCSS = $pathToCSS;
    }

    /* Set the action URL
    *
    */
    public function setActionURL($url)
    {
        $this->actionURL = $url;
    }

    public function create()
    {

        $form = '<link rel="stylesheet" href="' . $this->pathToCSS . '">';

        $form.= '<h1>' . $this->formTitle  . '</h1>';

        $form.= '<form class="register" action="' . $this->actionURL . '" name="register" method="post">';

        foreach ($this->fields as $groupFieldTitle => $fieldsArray) {

            $form.= '<label>' . $groupFieldTitle . '</label>';

            $form.= '<div class="formfield">';

            $form.= '<div class="formsubfield">';

            foreach ($fieldsArray as $row) {

                $form.= '<label for="' . $row['name'] . '"> ' . $row['label'] . ' </label>';

                $form.= '<input type="' . $row['type'] . '" name="' . $row['name'] . '" placeholder="' . $row['placeholder'] . '" value="' . $row['value'] . '" '. (isset($row['disabled'])?($row['disabled']?"disabled":""):"") . '>';

            }

            $form.= '</div>';

            $form.= '</div>';
        }

        foreach ($this->buttons as $row) {
            $form.= '<input type="' . $row['type'] . '" name="'. $row['name'] . '" value="'. $row['value'] . '">';
        }

        $form.= '</form>';

        echo $form;

    }

    public function validate()
    {
        echo "validate form";
    }

    public function clean($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = stripcslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

}
