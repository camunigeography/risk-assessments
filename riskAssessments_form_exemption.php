<?php

# Risk form
class riskAssessments_form_exemption
{
	# Function to assign defaults additional to the general application defaults
	public function __construct ($settings)
	{
		# Object handles
		$this->settings = $settings;
		
		
	}
	
	
	# Countries
	public function setCountries ($countries)
	{
		$this->countries = $countries;
	}
	
	
	
	# Function to define the asssessment form template
	public function form_exemption ($data, $watermark)
	{
		# Form HTML
		$html = '
			
			<p class="warning">Students on the MPhil in Anthropocene/Holocene should only complete this form to confirm that they do not require a risk assessment for their proposed activity. This form should be completed following discussion with your dissertation supervisor and your supervisor will be asked to confirm your exemption.</p>
			
			<h3>Exemption from risk assessment</h3>
			<p>Any travel or activity <strong>outside of Cambridge</strong> associated with your course of study &ndash; regardless of duration &ndash; requires completion of a risk assessment.</p>
			<p>Any activity associated with your course <strong>within Cambridge</strong> that involves a higher level of risk than your usual day to day activity as a student requires completion of a risk assessment. This would include conducting interviews for research or similar activity which you would otherwise not carry out in the course of a normal day.</p>
			<h3>Reason</h3>
			<p>If you believe that you do not require a risk assessment, please complete this form; it will be sent to your supervisor for them to sign and confirm that you do not need to complete an assessment (or, in the event that they disagree, will be returned to you with comments and information on the next steps).</p>
			<p>Reasons why a risk assessment is not required:<br />{reason|mediumtext|Reason}</p>
		';
		
		# Return the HTML
		return $html;
	}
	
	
	# Overrideable function to amend the main form attributes
	public function form_exemption_mainAttributes ($formMainAttributes)
	{
		
		
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_exemption_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_exemption_localRequiredFields ($formLocalRequiredFields, $data)
	{
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_exemption_localExcludeFields ($localExcludeFields, $data)
	{
		
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_exemption_validationRules ($form, $data)
	{
		
		
		# Return the modified form object
		return $form;
	}
}

?>
