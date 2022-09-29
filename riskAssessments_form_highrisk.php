<?php

# Risk form
class riskAssessments_form_highrisk
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
	public function form_highrisk ($data, $watermark)
	{
		# Determine if the person is a student
		$isStudent = (in_array ($data['type'], array ('Undergraduate', 'Postgraduate')));
		
		# Form HTML
		$html = "
			" .
			($isStudent ? "<p class=\"warning\">For students, all high risk travel must be approved by the <a href=\"https://www.safeguarding.admin.cam.ac.uk/policy-and-guidance/study-away-risk-assessment-committee\" target=\"_blank\">Study Away Risk Assessment Committee (SARAC)</a>; once processed by the Department, your risk assessment will be referred to SARAC and your application will be put on hold until a decision is made. You will not be permitted to travel until you have received a decision from SARAC.</p>" : '') . "
			
			<p><img src=\"/images/icons/exclamation.png\" alt=\"!\" class=\"icon\" /> Before filling this out, you <strong>must</strong> read and be aware of the <a href=\"/general/sustainability/travelpolicy/\" target=\"_blank\">Department Travel Policy</a> before making your plans for this trip.</p>
			
			<h3>A. Contact details</h3>
			<p>Name of a personal contact to be used in the event of an accident or emergency:<br />{emergencyContactName}</p>
			<p>Address of personal contact:<br />{emergencyContactAddress|mediumtext|Personal contact address}</p>
			<p>E-mail address of personal contact:<br />{emergencyContactEmail}</p>
			<p>Phone number of personal contact:<br />{emergencyContactPhone}</p>
			<p>Local contact (away from Cambridge) e.g. " . ($isStudent ? 'on-site supervisor or ' : '') . "host:</p>
			<p>Full name:<br />{awayContactName}</p>
			<p>Contact number (including local area code):<br />{awayContactPhone}</p>
			<p>E-mail address:<br />{awayContactEmail}</p>
			<p>Language(s) spoken:<br />{awayContactLanguages}</p>
			
			<h3>B. Travel itinerary</h3>
			<p>Please include estimated arrival and departure dates for all countries you intend to visit.</p>
			<p>Travel start date:<br />{startDate|date|Start date}</p>
			<p>Travel end date:<br />{endDate|date|End date}</p>
			<p>Start/end dates by country (if more than one):<br />{datesByCountry|mediumtext|Dates by country}</p>
			<p>Countr(ies):<br />{country}</p>
			<p>Location(s) of working away (town/city):<br />{location}</p>
			<p>Address and contact number of your accommodation:<br />{accommodationContact|mediumtext|Accommodation contacts}</p>
			
			<h3>C. Work details</h3>
			<p>Category/type of working away. Please describe e.g. archival work, fieldwork<br />{workType}</p>
			<p>Detailed description of proposed activities including sites you will work across (if there are multiple)<br />{activities|mediumtext|Activities}</p>
			<p>Working in isolation (lone working)?<br />{loneWorking|enum('','Yes','No')|Lone working}</p>
			<p>Supervised?<br />{supervised|enum('','Yes','No')|Supervised}</p>
			<p>Collaborating with others?<br />{collaborating|enum('','Yes','No')|Collaborating}</p>
			
			<h3>D. Foreign, Commonwealth and Development Office (FCDO) travel advice rating</h3>
			<p>
				Please select below to acknowledge correspondence with the University COVID helpdesk whilst planning this trip:<br />
				{covidHelpdesk|enum('','Yes - I have contacted the COVID helpdesk and I am aware of testing and quarantine requirements for this destination','I am aware of testing and quarantine requirements from other resources','I do NOT know the testing and quarantine requirements for this destination')|COVID helpdesk}
			</p>
			<p>
				Please select below the FCDO rating for the area that you will be travelling in/through or staying and working in:<br />
				{fcdoRating|enum('','No specific rating given','See our travel advice before travelling','Advise against all but essential travel OR advise against all travel *')|FCDO rating}
			</p>
			<p>The date you checked the FCDO advice:<br />{fcdoAdviceDate|date|FCDO advice date}</p>
			<p>* If you have selected that the FCDO advises &#39;against all but essential travel&#39; or &#39;against all travel&#39; to the country you are proposing to visit, you must complete the next two questions. If not, please skip these two questions.</p>
			<p>FCDO warnings and suggested control measures<br />{fcdoDetails}</p>
			<p>Justification for proposed work away<br />{justificationWorkAway}</p>
			<p>You can sign up to <a href=\"https://www.gov.uk/foreign-travel-advice\" target=\"_blank\" title=\"[Link opens in a new window]\">FCDO travel alerts</a>. Select your destination and subscribe to the e-mail alerts for the country you propose to visit.</p>
			<p>{travelAlerts|tinyint|Travel alerts} I agree that I will subscribe to and monitor Foreign, Commonwealth and Development Office travel alerts for my proposed destination(s).</p>
			
			<h3>E. Personal characteristics, local laws, and customs</h3>
			<p>Please confirm that you have considered your wellbeing needs and discussed these with your " . ($isStudent ? 'College Tutor' : 'manager (if appropriate)') . " and record any information that you feel is relevant. Please also read all information relating to the local laws and customs of the area you are visiting and consider implications of your personal characteristics within the local culture.</p>
			<p>Relevant summary of the discussion:<br />{cultural|mediumtext|Cultural aspects}</p>
			
			<h3>F. Insurance</h3>
			<p>Please give details of travel insurance that covers your travel/work away outside the UK:</p>
			<p>Name of insurer:<br />{insurerName}</p>
			<p>Policy number:<br />{insurerPolicyNumber}</p>
			
			<h3>G. Contact with Supervisor or Department at Cambridge</h3>
			<p>You must arrange a suitable frequency and method of contact with your " . ($isStudent ? 'Supervisor' : 'manager') . " or other designated person for the duration of the trip. The requirement is that you contact a minimum of once every two weeks for higher risk rating. It is important that the contact person is able to acknowledge all contact communications.</p>
			<p>Contact person (primary and alternate) e.g. " . ($isStudent ? 'Supervisor' : 'manager') . "<br />{contactPerson}</p>
			<p>Contact frequency (the expectation for medium risk travel is once per month as a minimum):<br />{contactFrequency}</p>
			<p>E-mail address / phone number of contact person<br />{contactContact}</p>
			<p>Means of communication e.g. e-mail<br />{contactMeans}</p>
			
			<h3>H. Hazards, risks and control measures</h3>
			<p>The table has been pre-filled with examples of hazards that may be present during your proposed working away. You must amend, remove, or add hazards as appropriate to your work away. Control measures should be specific to you and the work you are proposing. Please click on the topics for more information and examples of risk control measures.</p>
			
			<table class=\"lines\">
				<tr>
					<td>
						<h4>Hazard and description</h4>
						<p>For each topic, list foreseeable issues that may cause you harm.</p>
					</td>
					<td>
						<h4>How is this likely to affect you?</h4>
						<p>Describe how hazards can cause harm to you and how your work activities or personal characteristics could affect the likelihood of you being exposed to harm.</p>
					</td>
					<td>
						<h4>Control measures</h4>
						<p>Actions/precautions you will take to eliminate/reduce the impact of the hazard or likelihood of harm occurring.</p>
					</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/individuals-travelling-health-and-safety-those-working-away/completing-risk-assessment/work-related\" target=\"_blank\">Work related hazards</a></strong></td>
				</tr>
				<tr>
					<td>{workHazardTitle|mediumtext|Work hazard description}</td>
					<td>{workHazardEffect|mediumtext|Work hazard effect}</td>
					<td>{workHazardMitigation|mediumtext|Work hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/crime\" target=\"_blank\">Crime</a></strong></td>
				</tr>
				<tr>
					<td>{crimeHazardTitle|mediumtext|Crime hazard description}</td>
					<td>{crimeHazardEffect|mediumtext|Crime hazard effect}</td>
					<td>{crimeHazardMitigation|mediumtext|Crime hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/political-violenceconflict\" target=\"_blank\">Political Violence/Conflict</a></strong></td>
				</tr>
				<tr>
					<td>{politicalHazardTitle|mediumtext|Political hazard description}</td>
					<td>{politicalHazardEffect|mediumtext|Political hazard effect}</td>
					<td>{politicalHazardMitigation|mediumtext|Political hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/accident-travel-and-personal\" target=\"_blank\">Accident - Travel and Personal</a></strong></td>
				</tr>
				<tr>
					<td>{accidentHazardTitle|mediumtext|Accident hazard description}</td>
					<td>{accidentHazardEffect|mediumtext|Accident hazard effect}</td>
					<td>{accidentHazardMitigation|mediumtext|Accident hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/jurisdiction\" target=\"_blank\">Authorities</a></strong></td>
				</tr>
				<tr>
					<td>{authoritiesHazardTitle|mediumtext|Authorities hazard description}</td>
					<td>{authoritiesHazardEffect|mediumtext|Authorities hazard effect}</td>
					<td>{authoritiesHazardMitigation|mediumtext|Authorities hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/individuals-travelling-health-and-safety-those-working-away/completing-risk-assessment/environment\" target=\"_blank\">Environment</a></strong></td>
				</tr>
				<tr>
					<td>{environmentHazardTitle|mediumtext|Environment hazard description}</td>
					<td>{environmentHazardEffect|mediumtext|Environment hazard effect}</td>
					<td>{environmentHazardMitigation|mediumtext|Environment hazard mitigation}</td>
				</tr>
				<tr>
					<td colspan=\"3\"><strong><a href=\"https://www.safeguarding.admin.cam.ac.uk/health-physical-and-mental\" target=\"_blank\">Health</a></strong> </a></strong>(mental and physical)</td>
				</tr>
				<tr>
					<td>{healthHazardTitle|mediumtext|Health hazard description}</td>
					<td>{healthHazardEffect|mediumtext|Health hazard effect}</td>
					<td>{healthHazardMitigation|mediumtext|Health hazard mitigation}</td>
				</tr>
			</table>
			
			<h3>Management of specific risks</h3>
			<p>If you feel you have already answered these questions within the hazard table above, please indicate this rather than duplicating answers.</p>
			
			<h4>Preparedness</h4>
			<p>Have you travelled to this location(s) before? Detail previous experience/family links<br />{preparednessFamiliarity}</li>
			<p>Have you travelled to other similar locations before? Detail previous experience<br />{preparednessExperience}</li>
			<p>Have you previously completed any health, safety, or security training? Please give details<br />{preparednessTraining}</li>
			
			<h4>Safety &amp; security arrangements</h4>
			<p>If travelling to an existing project is there a health &amp; safety plan, risk assessment and/or emergency plan in place? If so, please describe what they cover and send copies when submitting this form.<br />{safetyPlan}</p>
			<p>Are you being hosted by a partner organisation / local host?<br />{localHost}</p>
			<p>If so, which organisation, and in what ways are you making use of / relying on their safety and security arrangements<br />{hostPrearrangements}</p>
			<p>Will you receive a briefing about the context and recommended safety &amp; security procedure when you arrive?<br />{hostBriefing}</p>
			<p>Are there any festivals, public holidays, or elections happening during your trip? If so, what additional considerations/ provision are you making?<br />{holidaysProvision}</p>
			<p>Are there any environmental issues / natural disasters that could arise during your trip? If so, what additional considerations/ provisions are you making?<br />{environmentalIssues}</p>
			
			<h4>Personal and cultural considerations</h4>
			<p>What information sources do you intend to use to keep up-to-date with safety, security or political developments in country?<br />{culturalInformation}</p>
			<p>Are there any cultural aspects or personal characteristics that you must consider to avoid risk to yourself? (E.g. dress, greetings, behaviour, sex, gender identification, religion, language skills?)<br />{culturalIdentification}</p>
			<p>Is it necessary to have a curfew (latest time of return to your accommodation)?<br />{culturalCurfew}</p>
			<p>What specific measures will you put in place to reduce the chances of illness and/or injury?<br />{culturalInjury}</p>
			<p>Do you require any specialist equipment for this trip (first aid kit, mosquito net etc.)?<br />{culturalEquipment}</p>
			
			<h4>Communications</h4>
			<p>How widespread and reliable are internet and mobile phone communications in your location(s) of travel?<br />{communicationsAvailability}</p>
			<p>What contingency options do you have for communications if normal options are not available?<br />{communicationsContingency}</p>
			
			<h4>Transport</h4>
			<p>What arrangements are in place for transport when you arrive at the destinations (e.g. airports)?<br />{transportArrangements}</p>
			<p>Which international and national airlines will you be travelling with? If not flying, give details of how you will arrive in the country.<br />{transportCarrier}</p>
			<p>What transport will you use for the rest of your trip?<br />{transportLocal}</p>
			<p>Will you be accompanied for all/part of your trip? If so, by whom and when?<br />{transportAccompaniment}</p>
			<p>What limits will you place on the times of travel? (e.g. no travel after dark, no travel before 6am)<br />{transportLimits}</p>
			<p>Have you checked whether it is safe for you to travel on foot? Is it safe to do this at night or by yourself?<br />{transportFoot}</p>
			
			<h4>Accommodation</h4>
			<p>Where will you be staying during your trip? (if not included in itinerary above)<br />{accommodationWhere}</p>
			<p>Has this accommodation been recommended/approved by your host/someone else?<br />{accommodationRecommendation}</p>
			<p>What other venues will you be visiting? What safety/security arrangements will you put in place?<br />{accommodationOtherVenues}</p>
			
			<h4>J. Contingency plans</h4>
			<p>If your plans to deal with specific hazards are not effective what are your contingency (back up) plans? Only add contingency plans for the most severe risks.<br />{contingencyPlans}</p>
			<p>Examples:</p>
			<ul>
			<li>Loss of passport, travel documents</li>
			<li>Airport closed at time of return (due to natural disaster or civil unrest)</li>
			</ul>
			
			<h4>Additional contingency information</h4>
			<p>List medical facilities that you could use in case of an emergency:<br />{medicalFacilities}</p>
			<p>What are your in-country emergency contact points?<br />{emergencyContactPoints}</p>
			<p>If you need to leave your location of travel where will you relocate / evacuate to?<br />{evacuationLocation}</p>
			<p>Who is the first person at the University of Cambridge you will contact?<br />{firstContact}</p>
			<p>Who will be your back-up University of Cambridge contact?<br />{backupContact}</p>
			
			<h3>Agreement and sign-off</h3>
			<p>{confirmation} I am signing to indicate that I have read and will abide by the statements above and will carry out additional risk assessments if and when circumstances change or the risks are not covered by this assessment.</p>
		";
		
		# Return the HTML
		return $html;
	}
	
	
	# Overrideable function to amend the main form attributes
	public function form_highrisk_mainAttributes ($formMainAttributes)
	{
		
		
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_highrisk_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		# Add to the attributes
		$dataBindingAttributes += array (
			'country'	=> array (
				'type' => 'select',
				'values' => $this->countries,
				'multiple' => true,
				'expandable' => true,
				'separator' => '|',
				'defaultPresplit' => true,
				'output' => array ('processing' => 'compiled'),
			),
		);
		
		# Hazards table textarea sizes
		$this->hazardTypes = array ('work', 'crime', 'political', 'accident', 'authorities', 'environment', 'health');
		$this->hazardSections = array ('title', 'effect', 'mitigation');
		foreach ($this->hazardTypes as $hazard) {
			foreach ($this->hazardSections as $section) {
				$section = ucfirst ($section);
				$dataBindingAttributes["{$hazard}Hazard{$section}"]['cols'] = 30;
			}
		}
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_highrisk_localRequiredFields ($formLocalRequiredFields, $data)
	{
		# Remove optional fields
		$optionalFields = array ('datesByCountry', 'fcdoDetails', 'justificationWorkAway');
		$formLocalRequiredFields = array_diff ($formLocalRequiredFields, $optionalFields);
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_highrisk_localExcludeFields ($localExcludeFields, $data)
	{
		
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_highrisk_validationRules ($form, $data)
	{
		# Chained validation for each hazard type
		foreach ($this->hazardTypes as $hazard) {
			$fields = array ();
			foreach ($this->hazardSections as $section) {
				$section = ucfirst ($section);
				$fields[] = "{$hazard}Hazard{$section}";
			}
			$form->validation ('all', $fields);
		}
		
		# Return the modified form object
		return $form;
	}
}

?>
