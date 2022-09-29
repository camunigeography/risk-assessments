<?php

# Risk form
class riskAssessments_form_event
{
	# Function to assign defaults additional to the general application defaults
	public function __construct ($settings)
	{
		# Object handles
		$this->settings = $settings;
		
		# Hazards block
		$this->hazardsTotal = 8;
		$this->hazardSections = array ('hazards', 'risk', 'likelihood', 'mitigation', 'advice');
	}
	
	
	# Countries
	public function setCountries ($countries)
	{
		$this->countries = $countries;
	}
	
	
	
	# Function to define the asssessment form template
	public function form_event ($data, $watermark)
	{
		# Form HTML
		$html = '
			<h3>Emergency contacts</h3>
			<ul>
				<li>Geography reception, located by the Main Entrance</li>
				<li>First Aid 39070 (01223 339070)</li>
				<li>Downing Site Security 31818 (01223 331818)</li>
			</ul>
			<p>Please confirm you have made a note of these emergency contact details and will have them available during the event.<br />{contactsNoted|tinyint|Contacts noted}</p>
			
			<h3>A: Details of the event</h3>
			<p>When is the event?<br />{date|date|Date}</p>
			<p>What time?<br />{time}</p>
			<p>Where in the Department is the event taking place?<br />{location}</p>
			<p>Who is attending? E.g. members of the public / members of the Department / members of the University.<br />{attendees}</p>
			<p>If out of hours (after 4pm), have you made arrangements to secure and lock the room at the end of the event?<br />{endSecurity}</p>
			<p>Please list the members of staff who will be present at and supporting the event.{staffMembers}</p>
			
			<h3>B: Risk assessment</h3>
			<p>You should consider the hazards you might encounter when running the event; the risks associated with them; and your measures for minimising or avoiding these risks.</p>
			
			<table class="lines">
				<tr>
					<td></td>
					<td>What hazards do you perceive you might experience while running this event?</td>
					<td>What are the risks associated with these hazards?</td>
					<td>What do you consider is the likelihood of you or an attendee being exposed to these risks?</td>
					<td>How do you propose to avoid or reduce the likelihood of anyone being exposed to the risk?</td>
					<td>If you consider the risk requires that (a) you take advice locally, or (b) you inform someone locally of your intentions, who would this be?</td>
				</tr>
			';
			
			# Add each hazard
			for ($i = 1; $i <= $this->hazardsTotal; $i++) {
				$html .= "
				<tr>
					<td>{$i}:</td>
					<td>{hazards{$i}|mediumtext|Hazards ({$i})}</td>
					<td>{risk{$i}|mediumtext|Risk ({$i})}</td>
					<td>{likelihood{$i}|mediumtext|Likelihood ({$i})}</td>
					<td>{mitigation{$i}|mediumtext|Mitigation ({$i})}</td>
					<td>{advice{$i}|mediumtext|Advice ({$i})}</td>
				</tr>
				";
			}
			
			# Continue HTML
			$html .= '
			</table>
			
			<p>If you have taken advice from someone or used reference material in order to quantify the risks involved listed above, please note them here:<br />{adviceTaken}</p>
			
			<h3>Confirmation</h3>
			<p>{confirmation} I confirm the above is correct.</p>
		';
		
		# Return the HTML
		return $html;
	}
	
	
	# Overrideable function to amend the main form attributes
	public function form_event_mainAttributes ($formMainAttributes)
	{
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_event_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		# Hazards table textarea sizes
		for ($i = 1; $i <= $this->hazardsTotal; $i++) {
			foreach ($this->hazardSections as $section) {
				$dataBindingAttributes["{$section}{$i}"]['cols'] = 15;
			}
		}
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_event_localRequiredFields ($formLocalRequiredFields, $data)
	{
		# Remove optional fields
		$optionalFields = array ();
		for ($i = 2; $i <= $this->hazardsTotal; $i++) {		// Omit 1st
			foreach ($this->hazardSections as $section) {
				$optionalFields[] = "{$section}{$i}";
			}
		}
		$formLocalRequiredFields = array_diff ($formLocalRequiredFields, $optionalFields);
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_event_localExcludeFields ($localExcludeFields, $data)
	{
		
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_event_validationRules ($form, $data)
	{
		# Chained validation for each hazard type
		for ($i = 1; $i <= $this->hazardsTotal; $i++) {
			$fields = array ();
			foreach ($this->hazardSections as $section) {
				$fields[] = "{$section}{$i}";
			}
			$form->validation ('all', $fields);
		}
		
		# Return the modified form object
		return $form;
	}
}

?>
