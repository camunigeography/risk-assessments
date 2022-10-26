<?php

# Risk form
class riskAssessments_form_lowrisk
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
	public function form_lowrisk ($data, $watermark)
	{
		# Determine if the person is a student
		$isStudent = (in_array ($data['type'], array ('Undergraduate', 'Postgraduate')));
		
		# Form HTML
		$html = "
			<p><img src=\"/images/icons/exclamation.png\" alt=\"!\" class=\"icon\" /> Before filling this out, you <strong>must</strong> read and be aware of the <a href=\"/general/sustainability/travelpolicy/\" target=\"_blank\">Department Travel Policy</a> before making your plans for this trip.</p>
			
			<h3>Activity</h3>
			<p>Description of travel and/or work away, including arrangements and locations for interviews, location visits etc. If you will be conducting interviews alone, you should give details of how you will ensure your safety, for example, by sharing your itinerary with a responsible person.<br />{activity|mediumtext|Description}</p>
			<p>Location(s) of activity:<br />{location}</p>
			
			<h3>Dates* of travel/work away (*or range of dates for repeat visits)</h3>
			<p>Leaving Cambridge/UK on<br />{startDate|date|Start date}</p>
			<p>Date of return to UK/Cambridge<br />{endDate|date|End date}</p>
			
			<h3>Assessment of risk</h3>
			<p>The hazards and consequent risks of this activity are similar to what I encounter doing low risk work at Cambridge (e.g. office work, attending lectures). This is therefore a low risk activity. The statements below list the precautions I will take to avoid higher risks.</p>
			<p>I will take reasonable precautions to avoid putting myself at risk, and:</p>
			<ul class=\"spaced\">
				<li>I will contact the COVID Helpdesk for guidance and information on COVID-19 testing and quarantine requirements for this trip. I will check and comply with all legal requirements imposed by the UK (or country of departure) and my destination.</li>
				<li>I will follow the UK Foreign and Commonwealth Office (FCDO) Travel Advice. I understand that this risk assessment is suitable only for travel to countries with the same levels of safety as the UK.</li>
				<li>I will use a regular mode of travel provided by a reputable company" . ($isStudent ? ' (through the University&#39;s travel agent if possible)' : '') . ', allowing adequate travel time to avoid unnecessary risks.</li>
				<li>I will not travel if adverse weather, natural disaster or civil disturbance is indicated.</li>
				<li>I have read the University of Cambridge Travel Insurance Policy and am aware of all exclusions (including higher risk leisure activities).</li>
				<li>I will use accommodation providers as per University and departmental policy.</li>
				<li>My itinerary and contact number have been posted with a departmental contact (e.g. Supervisor or Administrator).</li>
				<li>I will follow the safety advice and guidance of the host organisation, and will report any safety concerns to the host organisation and/or to my department&#39;s management.</li>
				<li>I will avoid lone working and travelling alone as far as possible.</li>
				<li>I understand that further risk assessment is required for higher risk activities e.g. visits to developing countries, work in communities, laboratory work etc, and will consult the nominated person to obtain approval as per the department procedure for Work and Travel Away.</li>
			</ul>
			
			<h3>Emergency contact</h3>' .
			($isStudent ?
				'<p>Name of a personal contact to be used in the event of an accident or emergency:<br />{contactName}</p>
				<p>Address of personal contact:<br />{contactAddress|mediumtext|Contact address}</p>
				<p>Phone number of personal contact:<br />{contactPhone}</p>'
			:
				'<p>Emergency contact number:<br />{contactPhone}</p></p>'
			) . '
			
			<h3>Confirmation</h3>
			<p>{confirmation} I confirm that I have read and will abide by the statements above and will carry out additional risk assessment where necessary.</p>
		';
		
		# Return the HTML
		return $html;
	}
	
	
	# Overrideable function to amend the main form attributes
	public function form_lowrisk_mainAttributes ($formMainAttributes)
	{
		
		
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_lowrisk_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_lowrisk_localRequiredFields ($formLocalRequiredFields, $data)
	{
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_lowrisk_localExcludeFields ($localExcludeFields, $data)
	{
		
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_lowrisk_validationRules ($form, $data)
	{
		
		
		# Return the modified form object
		return $form;
	}
}

?>
