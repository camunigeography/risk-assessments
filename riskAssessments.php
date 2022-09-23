<?php

# Class implementing a risk assessment system
require_once ('reviewable-assessments/reviewableAssessments.php');
class riskAssessments extends reviewableAssessments
{
	# Define forms available
	private $forms = array (
		'form_default',
	);
	
	
	# Function to assign defaults additional to the general application defaults
	public function defaults ()
	{
		# Add implementation defaults
		$defaults = array (
			'applicationName'			=> 'Risk assessments',
			'database'					=> 'riskassessments',
			'description'				=> 'risk assessment',
			'descriptionPlural'			=> 'risk assessments',
			'directorDescription'		=> 'Departmental Safety Officer',
			'stage2Info'				=> 'customs/insurance information',
			'listingAdditionalFields'	=> array ('country', 'when'),
		);
		
		# Merge in the default defaults
		$defaults += parent::defaults ();
		
		# Return the defaults
		return $defaults;
	}
	
	
	public function main ()
	{
		# Load each form definition class
		foreach ($this->forms as $form) {
			$class = "riskAssessments_{$form}";
			$file = $class . '.php';
			require_once ($file);
			$this->formClasses[$form] = new $class ($this->settings);
		}
		
		# Run main
		parent::main ();
	}
	
	
	
	/* form_default: Default form */
	public function form_default ($data, $watermark) {
		return $this->formClasses['form_default']->form_default ($data, $watermark);
	}
	public function form_default_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_default']->form_default_mainAttributes ($formMainAttributes);
	}
	public function form_default_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_default']->setCountries ($this->getCountries ());
		return $this->formClasses['form_default']->form_default_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_default_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_default']->form_default_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_default_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_default']->form_default_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_default_validationRules ($form, $data) {
		return $this->formClasses['form_default']->form_default_validationRules ($form, $data);
	}
	
	
	
}

?>
