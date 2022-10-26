<?php

# Class implementing a risk assessment system
require_once ('reviewable-assessments/reviewableAssessments.php');
class riskAssessments extends reviewableAssessments
{
	# Define forms available
	public $forms = array (
		'form_default',		// Legacy, not available for new assessments, as marked below
		'form_lowrisk',
		'form_mediumrisk',
		'form_highrisk',
		'form_groupactivity',
		'form_event',
		'form_exemption',
	);
	
	# Legacy form types, which do not permit cloning
	public $legacyForms = array (
		'form_default',
	);
	
	# Colours for listing
	public $formColours = array (
		'form_lowrisk'			=> 'blue',
		'form_mediumrisk'		=> 'orange',
		'form_highrisk'			=> 'red',
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
			'emailSubjectAddition'		=> array ('form_highrisk' => 'HIGH RISK', ),
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
	
	
	
	# Choice form
	public function choiceForm ($form)
	{
		# Overall form type
		$form->radiobuttons (array (
			'name'		=> 'choice0',
			'title'		=> 'What type of risk assessment?',
			'values'	=> array (
				'a_goto1'					=> 'Risk assessment for individual activity<br />',
				'b_result_groupactivity'	=> 'Risk assessment for group activity (e.g. group fieldtrips)<br />',
				'c_result_event'			=> 'Risk assessment for events<br />',
				'd_result_exemption'		=> 'Exemption from risk assessment form (MPhil in Anthropocene/Holocene only)<br />',
			),
			'entities' => false,
			'discard' => true,
		));
		
		# Intermediate choice values, which result in selection of the 'form' value below
		$form->radiobuttons (array (
			'name'		=> 'choice1',
			'title'		=> '1. Where are you going?',
			'values'	=> array (
				'a_goto2' => 'Travel is in the UK<br />',
				'b_goto2' => 'Travel is outside the UK and there is no FCDO advice in place for anywhere in the country<br />',
				'c_goto3' => 'Travel is outside the UK and there is local FCDO advice<br />',
				'd_goto4' => 'Travel is outside the UK and FCDO advises against all but essential travel or advise against all travel',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice2',
			'title'		=> '2. Traveller details',
			'values'	=> array (
				'a_goto5' => 'Traveller has relevant experience, understanding and skills for the work proposed<br />',
				'b_goto6' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that may require specific adjustments or support during work, or because of living away from home.<br />',
				'c_goto7' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that could significantly increase their vulnerability to certain risks.<br />',
				'd_goto7' => 'Traveller does not have experience of conducting a higher risk activity or working in a higher risk location.',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice3',
			'title'		=> '3. Traveller details',
			'values'	=> array (
				'a_goto6' => 'Traveller has relevant experience, understanding and skills for the work proposed<br />',
				'b_goto6' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that may require specific adjustments or support during work, or because of living away from home.<br />',
				'c_goto7' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that could significantly increase their vulnerability to certain risks.<br />',
				'd_goto7' => 'Traveller does not have experience of conducting a higher risk activity or working in a higher risk location.',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice4',
			'title'		=> '4. Traveller details',
			'values'	=> array (
				'a_goto7' => 'Traveller has relevant experience, understanding and skills for the work proposed<br />',
				'b_goto7' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that may require specific adjustments or support during work, or because of living away from home.<br />',
				'c_goto7' => 'Traveller has personal characteristics (e.g. health, disability, pregnancy, language, ethnic, religious, protected characteristics or cultural factors) that could significantly increase their vulnerability to certain risks.<br />',
				'd_goto7' => 'Traveller does not have experience of conducting a higher risk activity or working in a higher risk location.',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice5',
			'title'		=> '5. What are you going to be doing?',
			'values'	=> array (
				'a_result_lowrisk' => 'Conducting non-practical work such as desk work, attendance at a seminar, conference or exhibition held in a controlled environment.<br />',
				'b_result_lowrisk' => 'Standard fieldwork, including interviews, location visits, accessing archives, etc.<br />',
				'c_result_mediumrisk' => 'Conducting practical work (field visits, work in a lab, work in a remote area), and/or an activity where permits/licenses are required (mountaineering, diving, archaeological dig), where the individual is accompanied by a professional guide, or any other work/research that requires the traveller to complete a standard ethics assessment.<br />',
				'd_result_highrisk' => 'Conducting lone practical work in an area of high risk (field visits, work in a lab, work in a remote area), or an activity where permits/licenses are required (mountaineering, diving) and will not be accompanied by a professional guide.<br />',
				'e_result_highrisk' => 'Researching a highly sensitive/controversial topic that could potentially put you in danger.',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice6',
			'title'		=> '6. What are you going to be doing?',
			'values'	=> array (
				'a_result_mediumrisk' => 'Traveller is planning to conduct non-practical work such as desk work, attendance at a seminar, conference or exhibition held in a controlled environment<br />',
				'b_result_mediumrisk' => 'Traveller is planning to conduct practical work (field visits, work in a lab, work in a remote area), and/or an activity where permits/licenses are required (mountaineering, diving, archaeological dig), where the individual is accompanied by a professional guide, or any other work/research that requires the traveller to complete a standard ethics assessment.<br />',
				'c_result_highrisk' => 'Traveller is planning to conduct lone practical work in an area of high risk (field visits, work in a lab, work in a remote area), or an activity where permits/licenses are required (mountaineering, diving) and will not be accompanied by a professional guide.<br />',
				'd_result_highrisk' => 'Traveller is researching a highly sensitive/controversial topic that could put them in danger',
			),
			'entities' => false,
			'discard' => true,
		));
		$form->radiobuttons (array (
			'name'		=> 'choice7',
			'title'		=> '7. What are you going to be doing?',
			'values'	=> array (
				'a_result_highrisk' => 'Traveller is planning to conduct non-practical work such as desk work, attendance at a seminar, conference or exhibition held in a controlled environment<br />',
				'b_result_highrisk' => 'Traveller is planning to conduct practical work (field visits, work in a lab, work in a remote area), and/or an activity where permits/licenses are required (mountaineering, diving, archaeological dig), where the individual is accompanied by a professional guide, or any other work/research that requires the traveller to complete a standard ethics assessment.<br />',
				'c_result_highrisk' => 'Traveller is planning to conduct lone practical work in an area of high risk (field visits, work in a lab, work in a remote area), or an activity where permits/licenses are required (mountaineering, diving) and will not be accompanied by a professional guide.<br />',
				'd_result_highrisk' => 'Traveller is researching a highly sensitive/controversial topic that could put them in danger',
			),
			'entities' => false,
			'discard' => true,
		));
		
		# The 'form' value, which will be used
		$form->radiobuttons (array (
			'name'		=> 'form',
			'title'		=> '<strong>Confirmation:</strong><br />Your activity is classed as:',
			'values'	=> array (
				'form_lowrisk'			=> 'Low risk',
				'form_mediumrisk'		=> 'Medium risk',
				'form_highrisk'			=> 'High risk',
				'form_groupactivity'	=> 'Group activity',
				'form_event'			=> 'Event',
				'form_exemption'		=> 'Exemption from risk assessment',
			),
			'entities' => false,
			'required' => true,		// Not necessary because of the JS but ensures the form cannot pass if JS is disabled
		));
		
		# Return the form handle
		return $form;
	}
	
	
	
	/* Forms */
	# NB If adding a new form below, ensure it is also registered above in the $forms property
	
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
	
	/* Low risk */
	public function form_lowrisk ($data, $watermark) {
		return $this->formClasses['form_lowrisk']->form_lowrisk ($data, $watermark);
	}
	public function form_lowrisk_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_lowrisk']->form_lowrisk_mainAttributes ($formMainAttributes);
	}
	public function form_lowrisk_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_lowrisk']->setCountries ($this->getCountries ());
		return $this->formClasses['form_lowrisk']->form_lowrisk_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_lowrisk_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_lowrisk']->form_lowrisk_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_lowrisk_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_lowrisk']->form_lowrisk_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_lowrisk_validationRules ($form, $data) {
		return $this->formClasses['form_lowrisk']->form_lowrisk_validationRules ($form, $data);
	}
	
	/* Medium risk */
	public function form_mediumrisk ($data, $watermark) {
		return $this->formClasses['form_mediumrisk']->form_mediumrisk ($data, $watermark);
	}
	public function form_mediumrisk_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_mediumrisk']->form_mediumrisk_mainAttributes ($formMainAttributes);
	}
	public function form_mediumrisk_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_mediumrisk']->setCountries ($this->getCountries ());
		return $this->formClasses['form_mediumrisk']->form_mediumrisk_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_mediumrisk_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_mediumrisk']->form_mediumrisk_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_mediumrisk_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_mediumrisk']->form_mediumrisk_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_mediumrisk_validationRules ($form, $data) {
		return $this->formClasses['form_mediumrisk']->form_mediumrisk_validationRules ($form, $data);
	}
	
	/* High risk */
	public function form_highrisk ($data, $watermark) {
		return $this->formClasses['form_highrisk']->form_highrisk ($data, $watermark);
	}
	public function form_highrisk_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_highrisk']->form_highrisk_mainAttributes ($formMainAttributes);
	}
	public function form_highrisk_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_highrisk']->setCountries ($this->getCountries ());
		return $this->formClasses['form_highrisk']->form_highrisk_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_highrisk_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_highrisk']->form_highrisk_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_highrisk_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_highrisk']->form_highrisk_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_highrisk_validationRules ($form, $data) {
		return $this->formClasses['form_highrisk']->form_highrisk_validationRules ($form, $data);
	}
	
	/* Event */
	public function form_event ($data, $watermark) {
		return $this->formClasses['form_event']->form_event ($data, $watermark);
	}
	public function form_event_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_event']->form_event_mainAttributes ($formMainAttributes);
	}
	public function form_event_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_event']->setCountries ($this->getCountries ());
		return $this->formClasses['form_event']->form_event_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_event_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_event']->form_event_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_event_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_event']->form_event_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_event_validationRules ($form, $data) {
		return $this->formClasses['form_event']->form_event_validationRules ($form, $data);
	}
	
	/* Group trip */
	public function form_groupactivity ($data, $watermark) {
		return $this->formClasses['form_groupactivity']->form_groupactivity ($data, $watermark);
	}
	public function form_groupactivity_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_groupactivity']->form_groupactivity_mainAttributes ($formMainAttributes);
	}
	public function form_groupactivity_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_groupactivity']->setCountries ($this->getCountries ());
		return $this->formClasses['form_groupactivity']->form_groupactivity_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_groupactivity_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_groupactivity']->form_groupactivity_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_groupactivity_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_groupactivity']->form_groupactivity_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_groupactivity_validationRules ($form, $data) {
		return $this->formClasses['form_groupactivity']->form_groupactivity_validationRules ($form, $data);
	}
	
	/* Exemption */
	public function form_exemption ($data, $watermark) {
		return $this->formClasses['form_exemption']->form_exemption ($data, $watermark);
	}
	public function form_exemption_mainAttributes ($formMainAttributes) {
		return $this->formClasses['form_exemption']->form_exemption_mainAttributes ($formMainAttributes);
	}
	public function form_exemption_dataBindingAttributes ($dataBindingAttributes, $data) {
		$this->formClasses['form_exemption']->setCountries ($this->getCountries ());
		return $this->formClasses['form_exemption']->form_exemption_dataBindingAttributes ($dataBindingAttributes, $data);
	}
	public function form_exemption_localRequiredFields ($formLocalRequiredFields, $data) {
		return $this->formClasses['form_exemption']->form_exemption_localRequiredFields ($formLocalRequiredFields, $data);
	}
	public function form_exemption_localExcludeFields ($localExcludeFields, $data) {
		return $this->formClasses['form_exemption']->form_exemption_localExcludeFields ($localExcludeFields, $data);
	}
	public function form_exemption_validationRules ($form, $data) {
		return $this->formClasses['form_exemption']->form_exemption_validationRules ($form, $data);
	}
	
	
}

?>
