<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 16/07/2015
 * @Time    : 00:01
 * @File    : bootstrapForm.php
 * @Version : 1.7
 */

namespace Core\HTML;

/**
 * Class bootstrapForm
 * @package POO\HTML
 */
class BootstrapForm extends Form
{

    /**
     * @param $name string
     * @param $label
     * @param array $options
     * @return string
     */
    public function input($name, $label, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label class="col-md-4 control-label" for="' . $name . '">' . $label . '</label>';

        $class = isset($options['class']) ? $options['class'] : null;
        $id = isset($options['id']) ? 'id="' . $options['id'] . '" ' : null;
        $placeholder = isset($options['placeholder']) ? 'placeholder="' . $options['placeholder'] . '" ' : null;
        $keyup = isset($options['onkeyup']) ? 'onkeyup="' . $options['onkeyup'] . '" ' : null;
        $keypress = isset($options['onkeypress']) ? 'onkeypress="' . $options['onkeypress'] . '" ' : null;
        $onclick = isset($options['onclick']) ? 'onclick="' . $options['onclick'] . '" ' : null;
        $required = isset($options['required']) ? 'required="" ' : null;
        $disabled = isset($options['disabled']) ? 'readonly ' : null;

        if ($type === 'textarea') {
            $input = '<textarea style="resize:vertical; min-height: 50px;" ' . $id . $placeholder . $keypress . $keyup . $onclick . ' class="form-control ' . $class . '" name="' . $name . '"/>' . $this->getValue($name) . '</textarea> ';
        } else {
            $input = '<input  name="' . $name . '" ' . $id . $placeholder . $keypress . $keyup . $onclick . $required . $disabled . ' class="form-control input-md ' . $class . '" type="' . $type . '" value="' . $this->getValue($name) . '" />';
        }
        return $this->surround($label . '<div class="col-md-4">' . $input . '</div>');
    }

    /**
     * @param string $html
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * @param $text string Le text a afficher dans le bouton
     * @return string
     */
    public function submit($text)
    {
        return $this->surround(' <button class="btn btn-primary">' . $text . '</button>');
    }
}