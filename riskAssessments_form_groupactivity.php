<?php

# Risk form
class riskAssessments_form_groupactivity
{
	# Function to assign defaults additional to the general application defaults
	public function __construct ($settings)
	{
		# Object handles
		$this->settings = $settings;
		
		# Hazard rows (for form and logic below)
		$this->hazardRows = 10;
		$this->equipmentRows = 10;
	}
	
	
	# Countries
	public function setCountries ($countries)
	{
		$this->countries = $countries;
	}
	
	
	# Function to define the asssessment form template
	public function form_groupactivity ($data, $watermark)
	{
		# Form HTML
		$html = "
			<p><img src=\"/images/icons/exclamation.png\" alt=\"!\" class=\"icon\" /> Before filling this out, you <strong>must</strong> read and be aware of the <a href=\"/general/sustainability/travelpolicy/\" target=\"_blank\">Department Travel Policy</a> before making your plans for this trip.</p>
			
			<h3>Emergency contacts</h3>
			<p>For the group leader, name of a personal contact to be used in the event of an accident:<br />{emergencyContactName}</p>
			<p>Address of personal contact:<br />{emergencyContactAddress|mediumtext|Emergency contact address}</p>
			<p>Phone number of personal contact:<br />{emergencyContactPhone}</p>
			<p>As group leader, have you obtained emergency contact details for all those attending the group trip?<br />{emergencyContactsAttendees|enum('','Yes','No')|Emergency contact attendees}</p>
			<p>Will you ensure you have access to these contact details throughout the duration of the trip, in the event of an emergency?<br />{emergencyContactsAvailability|enum('','Yes','No')|Emergency contacts availability}</p>
			<p>Does the Department have a copy of these contact details stored as backup?<br />{emergencyContactsBackup|enum('','Yes','No')|Emergency contacts backup}</p>
			
			<h3>Details of First Aid provision</h3>
			<p>First Aid provision is a <strong>requirement</strong> for group activities.</p>
			<p>I confirm that I have arranged First Aid cover for this trip.<br />{firstAid|tinyint|First Aid cover}</p>
			<p>Please enter the names of any First Aiders accompanying the trip:<br />{firstAiders|mediumtext|First Aiders}</p>
			<p>Please enter details of any First Aid provisions you are making (e.g. First Aiders attending the trip, taking First Aid supplies with you):<br />{firstAidProvisions|mediumtext|First Aid provisions}</p>
			<p>If attending a field site, what First Aid provisions are available on site?<br />{firstAidOnSite|mediumtext|First Aid on site}</p>
			
			<h3>Details of fieldwork/travel</h3>
			<p>What country are you going to?<br />{country}</p>
			<p>What is your country of origin? (E.g. where are you travelling from)<br />{originCountry}</p>
			<p>What mode(s) of travel will you be using?<br />{travelModes}</p>
			<p>Are you aware of the <a href=\"https://intranet.geog.cam.ac.uk/general/sustainability/travelpolicy/\" target=\"_blank\" title=\"[Link opens in a new window]\">Department Travel Policy</a>?<br />{travelPolicyAwareness|enum('','Yes','No')|Travel policy awareness}</p>
			<p>Have you taken account of the Travel Policy when making your plans for this trip?<br />{travelPolicy|enum('','Yes','No')|Travel policy}</p>
			<p>Where are you going?<br />{location}</p>
			<p>What will you be doing there?<br />{activities|mediumtext|Activities}</p>
			<p>When will you be there?<br />{when}</p>
			<p>Will your project involve importing foreign soil and/or plant material?<br />{soils|enum('','Yes','No')|Soils}</p>
			<p>Have you checked the <a href=\"https://www.gov.uk/foreign-travel-advice\" target=\"_blank\" title=\"[Link opens in a new window]\">FCDO website</a>?<br />{fcdoChecked|enum('','Yes','No')|FCDO website}</p>
			<p>Does the FCDO advise against any travel to your intended destination?<br />{fcdoWarning|enum('','Yes','No')|FCDO warning}</p>
			
			<h3>Insurance</h3>
			<p>Please confirm that you have consulted with the Accounts Office to arrange adequate insurance for your Group Trip; this may include individual participants purchasing their own insurance policies.<br />{insurance|enum('','Yes','No')|Insurance}</p>
			
			<h3>Local contact details (e.g. where you are staying)</h3>
			<p>Local address<br />{localAddress|mediumtext|Local address}</p>
			<p>Local phone number<br />{localPhone}</p>
			<p>Local mobile number (if any)<br />{localMobile}</p>
			<p>Names and contact details of anyone you will be travelling with:<br />{localContacts|mediumtext|Local contacts}</p>
			
			<h3>Section B &ndash;Risk assessment</h3>
			<p class=\"right\"><a class=\"noautoicon\" href=\"/safety/riskcategorisation.pdf\" target=\"_blank\"><img src=\"/safety/riskcategorisation.png\" alt=\"Risk Categorisation Table\" title=\"[Link opens in a new tab]\" border=\"0\" width=\"300\" height=\"130\" /><br />Risk Categorisation Table<br />[Link opens in a new tab]</a></p>
			<p>Please use the <a href=\"/safety/riskcategorisation.pdf\" target=\"_blank\">Risk Categorisation Table</a> [link opens in a new tab] to assess your proposed group activity and determine the categorisation of risk as either Low, Medium or High. You will be asked to confirm your determination in the following questions on the form.</p>
			<p>Have you reviewed the Risk Categorisation Table?<br />{riskChartChecked|enum('','Yes')|Risk Categorisation Table checked?}</p>
			<p>What is your self-assessed risk categorisation?<br />{riskLevel|enum('Low','Medium','High')|Self-assessed risk categorisation}</p>
			<p>You should consider the hazards you might encounter; the risks associated with them; and your measures for minimising or avoiding these risks.</p>
			
			<table class=\"lines\">
				<tr>
					<td></td>
					<th>What hazards do you perceive you might experience while undertaking this group trip?</th>
					<th>What are the risks associated with these hazards. (For example: &#39;Fast-moving traffic&#39;, &#39;Trip hazard&#39;, &#39;Armed guards&#39;)</th>
					<th>What do you consider is the likelihood of you or anyone on the trip being exposed to these risks?</th>
					<th>How do you propose to avoid or reduce the likelihood of anyone being exposed to the risk?</th>
					<th>If you consider the risk requires that (a) you take advice locally, or (b) you inform someone locally of your intentions, who would this be?</th>
				</tr>
		";
		
		# Add each hazard row
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$html .= "
			<tr>
				<td>{$i}:</td>
				<td>{hazard{$i}Description|mediumtext|Hazard ({$i}) description}</td>
				<td>{hazard{$i}Risks|mediumtext|Hazard ({$i}) risks}</td>
				<td>{hazard{$i}Likelihood|enum('','Low','Medium','High')|Hazard ({$i}) likelihood}</td>
				<td>{hazard{$i}Reduction|mediumtext|Hazard ({$i}) reduction}</td>
				<td>{hazard{$i}Person|mediumtext|Hazard ({$i}) person}</td>
			</tr>
			";
			if ($i == 1) {
				$html .= "
			<tr>
				<td colspan=\"6\">Fill in as many others as relevant, if any:</td>
			</tr>
				";
			}
		}
			$html .= "
			</table>
			
			<p>If you have taken advice from someone or used reference material in order to quantify the risks involved listed above, please note them here:<br />{adviceTaken}</p>
			
			<h3>Section C: Equipment risk analysis</h3>
			<p>Please make a <em>provisional</em> return here if you hope to borrow items of Departmental field equipment. If the equipment has a value of under &pound;100 you do not need to list it here.</p>
			<p>More information about <a href=\"/facilities/laboratories/loan/\" target=\"_blank\" title=\"[Link opens in a new window]\">borrowing Departmental equipment</a> is available.</p>
			
		<table class=\"lines\">
			<tr>
				<th></th>
				<th>Equipment you envisage taking with you over the value of &#163;100</th>
				<th>Approximate value &#163;</th>
				<th>How will equipment be transported to your field location?</th>
				<th>Will you obtain insurance cover for transit, overnight storage and field use?</th>
				<th>Likelihood of loss, theft or damage from residence or field site</th>
				<th>What arrangements will be made for the security of equipment and any valuables during your field studies</th>
			</tr>
			<tr>
				<td colspan=\"7\">Fill in as many as relevant:</td>
			</tr>
		";
		
		# Add each equipment row
		# NB The $i values are already parsed, e.g. to "{equipment1_name|mediumtext|Equipment (1) name}" before the templatiser sees them
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$html .= "
			<tr>
				<td>{$i}:</td>
				<td>{equipment{$i}Name|mediumtext|Equipment ({$i}) name}</td>
				<td>{equipment{$i}Value|int|Equipment ({$i}) value}</td>
				<td>{equipment{$i}Transportation|mediumtext|Equipment ({$i}) transportation}</td>
				<td>{equipment{$i}Insurance|enum('','Yes','No')|Equipment ({$i}) insurance}</td>
				<td>{equipment{$i}Risk|enum('','Low','Medium','High')|Equipment ({$i}) risk}</td>
				<td>{equipment{$i}Security|mediumtext|Equipment ({$i}) security}</td>
			</tr>
			";
		}
		
		$html .= '
		</table>
		
		<h3>Confirmation</h3>
		<p>{confirmation} I confirm the above is correct.</p>
		';
		
		# Return the HTML
		return $html;
	}
	
	
	# Overrideable function to amend the main form attributes
	public function form_groupactivity_mainAttributes ($formMainAttributes)
	{
		
		
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_groupactivity_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		# Add to the attributes
		$dataBindingAttributes += array (
			'country'				=> array ('type' => 'select', 'values' => $this->countries, ),
			'originCountry'			=> array ('type' => 'select', 'values' => $this->countries, ),
		);
		
		# Add in maxlength checking on some fields and give nicer titles
		$attributes = array (
			'cols' => 25,
			'rows' => 3,
			'maxlength' => 350,
		);
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$dataBindingAttributes["hazard{$i}Description"] = $attributes;
			$dataBindingAttributes["hazard{$i}Risks"] = $attributes;
			$dataBindingAttributes["hazard{$i}Reduction"] = $attributes;
			$dataBindingAttributes["hazard{$i}Person"] = $attributes;
		}
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$dataBindingAttributes["equipment{$i}Name"] = $attributes;
			$dataBindingAttributes["equipment{$i}Transportation"] = $attributes;
			$dataBindingAttributes["equipment{$i}Security"] = $attributes;
		}
		
		# First hazard is travel
		$dataBindingAttributes["hazard1Description"] = array ('default' => 'Travel', 'editable' => false);
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_groupactivity_localRequiredFields ($formLocalRequiredFields, $data)
	{
		# Remove optional fields
		$optionalFields = array ();
		for ($i = 2; $i <= $this->hazardRows; $i++) {		// Omit 1st
			$optionalFields[] = "hazard{$i}Description";
			$optionalFields[] = "hazard{$i}Risks";
			$optionalFields[] = "hazard{$i}Likelihood";
			$optionalFields[] = "hazard{$i}Reduction";
			$optionalFields[] = "hazard{$i}Person";
		}
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$optionalFields[] = "equipment{$i}Name";
			$optionalFields[] = "equipment{$i}Value";
			$optionalFields[] = "equipment{$i}Transportation";
			$optionalFields[] = "equipment{$i}Insurance";
			$optionalFields[] = "equipment{$i}Risk";
			$optionalFields[] = "equipment{$i}Security";
		}

		$formLocalRequiredFields = array_diff ($formLocalRequiredFields, $optionalFields);
		
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_groupactivity_localExcludeFields ($localExcludeFields, $data)
	{
		
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_groupactivity_validationRules ($form, $data)
	{
		# Chained validation for the hazard/equipment matrix and customs/insurance
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$form->validation ('all', array (
				"hazard{$i}Description",
				"hazard{$i}Risks",
				"hazard{$i}Likelihood",
				"hazard{$i}Reduction",
				"hazard{$i}Person",
			));
		}
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$form->validation ('all', array (
				"equipment{$i}Name",
				"equipment{$i}Value",
				"equipment{$i}Transportation",
				"equipment{$i}Insurance",
				"equipment{$i}Risk",
				"equipment{$i}Security",
			));
		}
		
		# Return the modified form object
		return $form;
	}
}

?>