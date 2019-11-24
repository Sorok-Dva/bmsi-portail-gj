<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 30/03/2016
 * @Time    : 11:11
 * @File    : FormBuilder.php
 * @Version : 1.0
 * @LastUpdate  : 30/03/2016 à 15:01
 */

namespace Core\HTML;

class FormBuilder extends Form {

	protected $json;

	/**
	 * FormBuilder constructor.
	 * @param $data array|object $_POST pour remettre les values
	 * @param $json array Chaine JSON du formulaire à génerer
	 */
	public function __construct($data, $json) {
		$this->json = $json;
		parent::__construct($data);
	}

	/**
	 * @param $for string pour la propriété for du label
	 * @param $name string pour la propriété name du label
	 * @return string Le label
	 */
	private function addLabel($for, $name) {
		return "<label class=\"col-md-4 control-label\" for=\"{$for}\">{$name}</label>";
	}

    /**
     * @param $value
     * @param $name
     * @param $onchange
     * @return string
     */
	private function generateSelect($value, $name, $onchange, $dataInfo, $css) {
		return "<option value=\"{$value}\" onchange=\"{$onchange}\" {$dataInfo} {$css}>{$name}</option>";
	}

	/**
	 * @param $name
	 * @param $options
	 * @param $required
	 * @param $disabled
	 * @return string
	 */
	private function surroundOptions($name, $options, $required, $disabled, $dataInfo, $css) {
		return "<div class=\"col-md-4\"><select name=\"{$name}\" class=\"form-control\" data-selected='{$this->getValue($name)}' {$required} {$disabled} {$dataInfo} {$css}>{$options}</select></div>";
	}

	/**
	 * @param $type
	 * @param $name
	 * @param $placeholder
	 * @param $required
	 * @param $disabled
	 * @param $class
	 * @param $dataInfo
	 * @param $css
	 * @return string
	 */
	private function generateInputText($type, $name, $placeholder, $required, $disabled, $class, $dataInfo, $css, $maxl) {
		return "<div class=\"col-md-4\"><input type=\"{$type}\" name=\"{$name}\" placeholder=\"{$placeholder}\" value=\"{$this->getValue($name)}\" class=\"form-control input-md {$class}\" {$required} {$disabled} {$dataInfo} {$css} {$maxl}/></div>";
	}

	/**
	 * @param $name
	 * @param $placeholder
	 * @param $required
	 * @param $disabled
	 * @param $class
	 * @param $dataInfo
	 * @param $css
	 * @return string
	 */
	private function generateTextarea($name, $placeholder, $required, $disabled, $class, $dataInfo, $css) {
		return "<div class=\"col-md-4\"><textarea style=\"resize:vertical; min-height: 50px;\" name=\"{$name}\" placeholder=\"{$placeholder}\" class=\"form-control {$class}\" {$required} {$disabled} {$dataInfo} {$css}>{$this->getValue($name)}</textarea></div>";
	}

	/**
	 * @param $label
	 * @param $name
	 * @param $value
	 * @param $id
	 * @param $onclick
	 * @param $dataInfo
	 * @param $css
	 * @return string
	 */
	private function generateRadioButtons($label, $name, $value, $id, $onclick, $dataInfo, $css) {
//		$selected = !empty($this->getValue($name)) ? "data-selected='{$this->getValue($name)}'" : null;
		return "<label class=\"btn btn-primary\" {$onclick}><input type=\"radio\" name=\"{$name}\" id=\"{$id}\" value=\"{$value}\" autocomplete=\"off\" {$dataInfo} {$css} > {$label}</label>";
	}

	/**
	 * @param $buttons
	 * @return string
	 */
	private function generateInputRadio($buttons) {
		return "<div class=\"btn-group col-md-4\" data-toggle=\"buttons\">{$buttons}</div>";
	}

	/**
	 * @param $field
	 * @param $hr
	 * @return string
	 */
	private function surroundField($field, $hr) {
		return "<div class=\"form-group\">{$field}</div>{$hr}";
	}

	/**
	 * @param $html
	 * @param $class
	 * @param $css
	 * @return string
	 */
	private function generateDiv($html, $class, $css) {
		return "<div class='{$class}' style='{$css}'>{$html}</div>";
	}

	/**
	 * @param $form
	 * @return string
	 */
	private function surroundForm($form) {
		return "<form class=\"form-horizontal\" method=\"post\" role=\"form\" autocomplete=\"off\" target=\"_blank\">{$form}</form>";
	}

	/**
	 * @param $parts string Le tableau de la part à générer
	 * @return string l'html du form
	 */
	public function formConstruct($parts) {
		$decodedData = json_decode($this->json);

		$inputs = $this->inputsConstruct($decodedData, $parts);
		$divs = $this->divsConstruct($decodedData, $parts);

		return $inputs . $divs;
	}

	/**
	 * @param $decodedData object Tableau décodé de la chaine JSON
	 * @param $parts string Tableau de la part à générer
	 * @return string HTML des inputs créées
	 */
	public function inputsConstruct($decodedData, $parts) {
		if (key_exists($parts, $decodedData->mainForm->blocks)):
			$inputs = "";
			foreach ($decodedData->mainForm->blocks as $k => $v) {
				if ($k == $parts):
					//Gestions Inputs : text/select/radio
					foreach ($v->elements as $key => $input) {

						$required = null;
						$disabled = null;
						$onclick = null;
						$hr = null;
						$class = null;
                        $onchange = null;
						$dataInfo = null;
						$css = null;
						$maxl = null;

						if (array_key_exists('required', $input)) {
							if ($input->required) {
								$required = "required";
							}
						}

						if (array_key_exists('hr', $input)) {
							if ($input->hr) {
								$hr = "<hr>";
							}
						}

						if (array_key_exists('disabled', $input)) {
                            if ($input->disabled) {
                                $disabled = "readonly";
                            }
						}

						if (array_key_exists('onclick', $input)) {
							$onclick = $input->onclick;
						}

						if (array_key_exists('css', $input)) {
							$css = $input->css;
						}

						if (array_key_exists('class', $input)) {
							$class = $input->class;
						}
						if (array_key_exists('maxlength', $input)) {
							$maxl = $dataInfo = 'maxlent="'.$input->data_info.'"';
						}

                        if (array_key_exists('onchange', $input)) {
                            $onchange = $input->onchange;
                        }

						if (array_key_exists('data_info', $input)) {
							$dataInfo = $dataInfo = 'data-info="'.$input->data_info.'"';
                        }



						$html = $this->addLabel($input->name, $input->label);

						switch ($input->type) {

						case 'select':
							$options = "";
							foreach ($input->options->values as $option) {
								$options .= $this->generateSelect($option->value, $option->name, $onchange, $dataInfo, $css);
							}
							$html .= $this->surroundOptions($input->name, $options, $required, $disabled, $dataInfo, $css);
							break;

						case 'text':
							$html .= $this->generateInputText($input->type, $input->name, $input->placeholder, $required, $disabled, $class, $dataInfo, $css, $maxl);
							break;

						case 'number':
							$html .= $this->generateInputText($input->type, $input->name, $input->placeholder, $required, $disabled, $class, $dataInfo, $css, $maxl);
							break;

						case 'textarea':
							$html .= $this->generateTextarea($input->name, $input->placeholder, $required, $disabled, $class, $dataInfo, $css);
							break;

						case 'radio':
							$buttons = "";
							foreach ($input->buttons->values as $button) {
								$buttons .= $this->generateRadioButtons($button->label, $button->name, $button->value, $button->id, $onclick, $dataInfo, $css);
							}
							$html .= $this->generateInputRadio($buttons);
							break;
						}
						$inputs .= $this->surroundField($html, $hr);
					}
				endif;
			}
			return $inputs;
		endif;
	}

	/**
	 * @param $decodedData object Tableau décodé de la chaine JSON
	 * @param $parts string Tableau de la part à générer
	 * @return string HTML des divs créées
	 */
	public function divsConstruct($decodedData, $parts) {
		$divs = "";
		if (key_exists($parts, $decodedData->mainForm->blocks)):
			foreach ($decodedData->mainForm->blocks as $k => $v) {
				if ($k == $parts):
					if (property_exists($v, 'divs')) {
						$inputs = "";
						foreach ($v->divs as $key => $div) {
							foreach ($div->elements->inputs as $k => $input) {
								$inputs .= $this->inputsConstructFromDivs($input);
							}
							$divs = $this->generateDiv($inputs, $div->class, $div->css);
						}
					}
				endif;
			}
		endif;
		return $divs;
	}

	/**
	 * @param $data array|object Tableau des inputs contenu dans une div à générer
	 * @return string L'HTML des inputs contenu dans la div
	 */
	public function inputsConstructFromDivs($data) {
		$inputs = "";

		$required = null;
		$disabled = null;
		$onclick = null;
		$hr = null;
		$class = null;
        $onchange = null;
        $dataInfo = null;
        $css = null;
		$maxl = null;

		if (array_key_exists('css', $data)) {
			$css = $data->css;
		}

		if (array_key_exists('required', $data)) {
			if ($data->required) {
				$required = "required";
			}
		}

		if (array_key_exists('hr', $data)) {
			if ($data->hr) {
				$hr = "<hr>";
			}
		}

        if (array_key_exists('disabled', $data)) {
            if ($data->disabled) {
                $disabled = "readonly";
            }
        }

		if (array_key_exists('onclick', $data)) {
			$onclick = $data->onclick;
		}

		if (array_key_exists('class', $data)) {
			$class = $data->class;
		}
		if (array_key_exists('maxlength', $data)) {
			$maxl = $data->maxlength;
		}
        if (array_key_exists('onchange', $data)) {
            $onchange = $data->onchange;
		}

        if (array_key_exists('data_info', $data)) {
            $dataInfo = 'data-info="'.$data->data_info.'"';
        }


		$html = $this->addLabel($data->name, $data->label);

		switch ($data->type) {
		case 'select':
			$options = "";
			foreach ($data->options->values as $option) {
				$options .= $this->generateSelect($option->value, $option->name, $onchange, $dataInfo, $css);
			}
			$html .= $this->surroundOptions($data->name, $options, $required, $disabled, $dataInfo, $css);
			break;
			case 'text':
				$html .= $this->generateInputText($data->type, $data->name, $data->placeholder, $required, $disabled, $class, $dataInfo, $css, $maxl);
				break;

			case 'number':
				$html .= $this->generateInputText($data->type, $data->name, $data->placeholder, $required, $disabled, $class, $dataInfo, $css, $maxl);
				break;
		case 'radio':
			$buttons = "";
			foreach ($data->buttons->values as $button) {
				$buttons .= $this->generateRadioButtons($button->label, $button->name, $button->value, $button->id, $onclick, $dataInfo, $css);
			}
			$html .= $this->generateInputRadio($buttons);
			break;
		}
		$inputs .= $this->surroundField($html, $hr);
		return $inputs;
	}
}