<?php

# Class implementing a risk assessment system
require_once ('reviewable-assessments/reviewableAssessments.php');
class riskAssessments extends reviewableAssessments
{
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
	
	
	# Database structure
	public function databaseStructureSpecificFields ()
	{
		# Return the SQL
		return $sql = "
			  /* Domain-specific fields */
			  
			  `contactName` varchar(255) DEFAULT NULL COMMENT 'Name of a personal contact',
			  `contactAddress` text COMMENT 'Address of personal contact',
			  `contactPhone` varchar(255) DEFAULT NULL COMMENT 'Phone number of personal contact',
			  `country` varchar(255) DEFAULT NULL COMMENT 'Country',
			  `originCountry` varchar(255) DEFAULT NULL COMMENT 'Country of origin',
			  `travelModes` set('Car','Bus','Rail','Boat','Plane') DEFAULT NULL COMMENT 'Travel mode(s)',
			  `travelPolicyAwareness` enum('Yes','No') DEFAULT NULL COMMENT 'Are you aware of the Department Travel Policy?',
			  `travelPolicyAccountedFor` enum('Yes','No') DEFAULT NULL COMMENT 'Have you taken account of the Travel Policy when making your plans for this trip?',
			  `place` text COMMENT 'Where are you going',
			  `activity` text COMMENT 'What will you be doing there',
			  `when` text COMMENT 'When will you be there',
			  `organicMaterial` enum('Yes','No') DEFAULT NULL COMMENT 'Soil and/or plant material',
			  `fcoWebsiteChecked` enum('Yes','No') DEFAULT NULL COMMENT 'FCO website',
			  `fcoAdviseAgainst` enum('No','Yes') DEFAULT NULL COMMENT 'FCO advice',
			  `insurance` VARCHAR(255) CHARACTER SET utf8 NULL DEFAULT NULL COMMENT 'Insurance',
			  `stayingAddress` text COMMENT 'Local address',
			  `stayingPhone` varchar(255) DEFAULT NULL COMMENT 'Local phone',
			  `stayingMobile` varchar(255) DEFAULT NULL COMMENT 'Local mobile',
			  `travellingWith` text COMMENT 'Travelling with',
			  `advicePerson` text COMMENT 'Taken advice',
			  `riskChartChecked` enum('Yes') DEFAULT NULL COMMENT 'Risk chart checked',
			  `riskLevel` enum('Low', 'Medium', 'High') DEFAULT NULL COMMENT 'Self-assessed risk categorisation',
			  `hazard1_description` text,
			  `hazard1_risks` text,
			  `hazard1_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard1_reduction` text,
			  `hazard1_person` text,
			  `hazard2_description` text,
			  `hazard2_risks` text,
			  `hazard2_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard2_reduction` text,
			  `hazard2_person` text,
			  `hazard3_description` text,
			  `hazard3_risks` text,
			  `hazard3_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard3_reduction` text,
			  `hazard3_person` text,
			  `hazard4_description` text,
			  `hazard4_risks` text,
			  `hazard4_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard4_reduction` text,
			  `hazard4_person` text,
			  `hazard5_description` text,
			  `hazard5_risks` text,
			  `hazard5_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard5_reduction` text,
			  `hazard5_person` text,
			  `hazard6_description` text,
			  `hazard6_risks` text,
			  `hazard6_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard6_reduction` text,
			  `hazard6_person` text,
			  `hazard7_description` text,
			  `hazard7_risks` text,
			  `hazard7_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard7_reduction` text,
			  `hazard7_person` text,
			  `hazard8_description` text,
			  `hazard8_risks` text,
			  `hazard8_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard8_reduction` text,
			  `hazard8_person` text,
			  `hazard9_description` text,
			  `hazard9_risks` text,
			  `hazard9_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard9_reduction` text,
			  `hazard9_person` text,
			  `hazard10_description` text,
			  `hazard10_risks` text,
			  `hazard10_likelihood` enum('','Low','Medium','High') DEFAULT NULL,
			  `hazard10_reduction` text,
			  `hazard10_person` text,
			  `equipment1_name` text,
			  `equipment1_value` int(11) DEFAULT NULL,
			  `equipment1_transportation` text,
			  `equipment1_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment1_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment1_security` text,
			  `equipment2_name` text,
			  `equipment2_value` int(11) DEFAULT NULL,
			  `equipment2_transportation` text,
			  `equipment2_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment2_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment2_security` text,
			  `equipment3_name` text,
			  `equipment3_value` int(11) DEFAULT NULL,
			  `equipment3_transportation` text,
			  `equipment3_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment3_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment3_security` text,
			  `equipment4_name` text,
			  `equipment4_value` int(11) DEFAULT NULL,
			  `equipment4_transportation` text,
			  `equipment4_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment4_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment4_security` text,
			  `equipment5_name` text,
			  `equipment5_value` int(11) DEFAULT NULL,
			  `equipment5_transportation` text,
			  `equipment5_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment5_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment5_security` text,
			  `equipment6_name` text,
			  `equipment6_value` int(11) DEFAULT NULL,
			  `equipment6_transportation` text,
			  `equipment6_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment6_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment6_security` text,
			  `equipment7_name` text,
			  `equipment7_value` int(11) DEFAULT NULL,
			  `equipment7_transportation` text,
			  `equipment7_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment7_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment7_security` text,
			  `equipment8_name` text,
			  `equipment8_value` int(11) DEFAULT NULL,
			  `equipment8_transportation` text,
			  `equipment8_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment8_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment8_security` text,
			  `equipment9_name` text,
			  `equipment9_value` int(11) DEFAULT NULL,
			  `equipment9_transportation` text,
			  `equipment9_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment9_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment9_security` text,
			  `equipment10_name` text,
			  `equipment10_value` int(11) DEFAULT NULL,
			  `equipment10_transportation` text,
			  `equipment10_insurance` enum('','Yes','No') DEFAULT NULL,
			  `equipment10_risk` enum('','Low','Medium','High') DEFAULT NULL,
			  `equipment10_security` text,
			  `seniorPersonSignature` varchar(255) DEFAULT NULL,
			  `seniorPersonDate` datetime DEFAULT NULL,
			  `customsCountry1` varchar(255) DEFAULT NULL COMMENT 'Customs - Country (1)',
			  `customsDocument1` text COMMENT 'Customs - document details (1)',
			  `customsCountry2` varchar(255) DEFAULT NULL COMMENT 'Customs - Country (2)',
			  `customsDocument2` text COMMENT 'Customs - document details (2)',
			  `customsCountry3` varchar(255) DEFAULT NULL COMMENT 'Customs - Country (3)',
			  `customsDocument3` text COMMENT 'Customs - document details (3)',
			  `healthInsuranceProvider` text COMMENT 'Health insurance provider',
			  `healthInsurancePolicy` text COMMENT 'Health insurance policy number',
			  `travelInsuranceProvider` text COMMENT 'Travel insurance provider',
			  `travelInsurancePolicy` text COMMENT 'Travel insurance policy number',
			  `equipmentInsuranceProvider` text COMMENT 'Equipment insurance provider',
			  `equipmentInsurancePolicy` text COMMENT 'Equipment insurance policy number',
		";
	}
	
	
	# Submission form
	public function submissionForm ($data)
	{
		# Get the template
		$template = $this->formTemplate ($data);
		
		/*
		# Remove the ID from the data; it has been written into the template as static HTML - this is so that the template can show either id/parentId without the form logic having to deal with this switching
		unset ($data['id']);
		*/
		
		# Add form buttons to the template
		$template = "\n<p><img src=\"/images/icons/information.png\" alt=\"\" class=\"icon\" /> You can click on {[[SAVE]]} at any time.</p>" . "\n{[[PROBLEMS]]}" . $template . "\n<p>{[[SUBMIT]]} OR you can {[[SAVE]]}</p>";
		
		# Define the database fields that should be treated as NOT NULL when doing a full submission (rather than "Save and continue"), even though the database sets them as NULLable; this is done manually so that the "Save and continue" button is possible
		$notNullFields = array ('description', 'type', 'college', 'seniorPerson', 'contactName', 'contactAddress', 'contactPhone', 'country', 'originCountry', 'travelModes', 'travelPolicyAwareness', 'travelPolicyAccountedFor', 'place', 'activity', 'when', 'organicMaterial', 'fcoWebsiteChecked', 'fcoAdviseAgainst', 'insurance', 'stayingAddress', 'stayingPhone', 'travellingWith', 'riskChartChecked', 'riskLevel', 'hazard1_description', 'hazard1_risks', 'hazard1_likelihood', 'hazard1_reduction', 'hazard1_person', 'confirmation', );
		
		# Set whether the form should include the customs/insurance fields
		$stage2InfoRequired = ($data['stage2InfoRequired']);
		
		# Determine the widget to be used for the senior person field
		$seniorPerson = $this->seniorPersonAttributes ($data['type'], $data['username']);
		
		# Compile the dataBinding attributes
		$dataBindingAttributes = array (
			'description'					=> array ('size' => 70, 'maxlength' => 130),	#!# Reduce to 80
			'name'							=> array ('editable' => false, ),
			'email'							=> array ('editable' => false, ),
			'type'							=> array ('type' => 'radiobuttons', 'disabled' => true, ),
			'college'						=> array ('type' => 'select', 'values' => $this->getColleges (), ),
			'seniorPerson' 					=> $seniorPerson['widget'],
			'contactAddress'				=> array ('rows' => 4, 'cols' => 50, ),
			'country'						=> array ('type' => 'select', 'values' => $this->getCountries (), ),
			'originCountry'					=> array ('type' => 'select', 'values' => $this->getCountries (), ),
			'place'							=> array ('rows' => 4, 'cols' => 50, ),
			'activity'						=> array ('rows' => 4, 'cols' => 50, ),
			'when'							=> array ('cols' => 50, ),
			'organicMaterial'				=> array ('type' => 'radiobuttons', 'values' => array ('No' => 'No', 'Yes' => 'Yes, and I will obtain a foreign soils licence held by the Department and will comply with all relevant regulations.'), ),
			'fcoWebsiteChecked'				=> array ('type' => 'radiobuttons', ),
			'fcoAdviseAgainst'				=> array ('type' => 'radiobuttons', 'values' => array ('No' => 'No', 'Yes' => 'Yes - see note below'), ),
			'stayingAddress'				=> array ('rows' => 4, 'cols' => 50, ),
			'travellingWith'				=> array ('rows' => 5, 'cols' => 50, ),
			'hazard1_description'			=> array ('default' => 'Travel', 'editable' => false, ),
			'customsCountry1'				=> array ('type' => 'select', 'values' => $this->getCountries (), 'required' => $stage2InfoRequired, ),
			'customsDocument1'				=> array ('rows' => 4, 'cols' => 50, 'required' => $stage2InfoRequired, ),
			'customsCountry2'				=> array ('type' => 'select', 'values' => $this->getCountries (), ),
			'customsDocument2'				=> array ('rows' => 4, 'cols' => 50, ),
			'customsCountry3'				=> array ('type' => 'select', 'values' => $this->getCountries (), ),
			'customsDocument3'				=> array ('rows' => 4, 'cols' => 50, ),
			'healthInsuranceProvider'		=> array ('rows' => 3, 'cols' => 40, ),
			'healthInsurancePolicy'			=> array ('rows' => 3, 'cols' => 40, ),
			'travelInsuranceProvider'		=> array ('rows' => 3, 'cols' => 40, ),
			'travelInsurancePolicy'			=> array ('rows' => 3, 'cols' => 40, ),
			'equipmentInsuranceProvider'	=> array ('rows' => 3, 'cols' => 40, ),
			'equipmentInsurancePolicy'		=> array ('rows' => 3, 'cols' => 40, ),
		);
		
		# Get the number of hazard and equipment rows in the database table structure
		$hazardRows = application::array_preg_match_total ('/^hazard[0-9]+_description$/', array_keys ($data));
		$equipmentRows = application::array_preg_match_total ('/^equipment[0-9]+_name$/', array_keys ($data));
		
		# Add in maxlength checking on some fields and give nicer titles (done here to save adding these tediously to each database comment)
		for ($i = 1; $i <= $hazardRows; $i++) {
			$dataBindingAttributes["hazard{$i}_description"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_risks"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_reduction"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_person"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_description"]['title'] = "Hazard {$i} description";
			$dataBindingAttributes["hazard{$i}_risks"]['title'] = "Hazard {$i} risks";
			$dataBindingAttributes["hazard{$i}_likelihood"]['title'] = "Hazard {$i} likelihood";
			$dataBindingAttributes["hazard{$i}_reduction"]['title'] = "Hazard {$i} reduction";
			$dataBindingAttributes["hazard{$i}_person"]['title'] = "Hazard {$i} person";
		}
		for ($i = 1; $i <= $equipmentRows; $i++) {
			$dataBindingAttributes["equipment{$i}_name"]['maxlength'] = 350;
			$dataBindingAttributes["equipment{$i}_transportation"]['maxlength'] = 350;
			$dataBindingAttributes["equipment{$i}_security"]['maxlength'] = 350;
			$dataBindingAttributes["equipment{$i}_name"]['title'] = "Equipment {$i} name";
			$dataBindingAttributes["equipment{$i}_value"]['title'] = "Equipment {$i} value";
			$dataBindingAttributes["equipment{$i}_transportation"]['title'] = "Equipment {$i} transportation";
			$dataBindingAttributes["equipment{$i}_insurance"]['title'] = "Equipment {$i} insurance";
			$dataBindingAttributes["equipment{$i}_risk"]['title'] = "Equipment {$i} risk";
			$dataBindingAttributes["equipment{$i}_security"]['title'] = "Equipment {$i} security";
		}
		
		# Determine fields to exclude
		$exclude = array_merge ($this->internalFields, array ('seniorPersonSignature', 'seniorPersonDate', ));
		if (!$stage2InfoRequired) {
			$stage2Fields = array ('customsCountry1', 'customsDocument1', 'customsCountry2', 'customsDocument2', 'customsCountry3', 'customsDocument3', 'healthInsuranceProvider', 'healthInsurancePolicy', 'travelInsuranceProvider', 'travelInsurancePolicy', 'equipmentInsuranceProvider', 'equipmentInsurancePolicy');
			$exclude = array_merge ($exclude, $stage2Fields);
		}
		
		# Databind a form
		$form = new form (array (
			'databaseConnection' => $this->databaseConnection,
			'nullText' => false,
			'formCompleteText'	=> false,
			'display' => 'template',
			'displayTemplate' => $template,
			'size' => 60,
			'cols' => 25,
			'rows' => 3,
			'unsavedDataProtection' => true,
			'saveButton' => true,
			'div' => false,
		));
		$form->dataBinding (array (
			'database' => $this->settings['database'],
			'table' => $this->settings['table'],
			'data'	=> $data,
			'intelligence'=> true,
			'exclude' => $exclude,
			'attributes' => $dataBindingAttributes,
			'notNullFields' => $notNullFields,
			'int1ToCheckbox' => true,
		));
		
		# Chained validation for the hazard/equipment matrix and customs/insurance
		for ($i = 1; $i <= $hazardRows; $i++) {
			$form->validation ('all', array ("hazard{$i}_description", "hazard{$i}_risks", "hazard{$i}_likelihood", "hazard{$i}_reduction", "hazard{$i}_person"));
		}
		for ($i = 1; $i <= $equipmentRows; $i++) {
			$form->validation ('all', array ("equipment{$i}_name", "equipment{$i}_value", "equipment{$i}_transportation", "equipment{$i}_insurance", "equipment{$i}_risk", "equipment{$i}_security"));
		}
		if ($stage2InfoRequired) {
			$form->validation ('all', array ('customsCountry1', 'customsDocument1'));
			$form->validation ('all', array ('customsCountry2', 'customsDocument2'));
			$form->validation ('all', array ('customsCountry3', 'customsDocument3'));
			$form->validation ('all', array ('healthInsuranceProvider', 'healthInsurancePolicy'));
			$form->validation ('all', array ('travelInsuranceProvider', 'travelInsurancePolicy'));
			$form->validation ('all', array ('equipmentInsuranceProvider', 'equipmentInsurancePolicy'));
			$form->validation ('either', array ('healthInsuranceProvider', 'travelInsuranceProvider', 'equipmentInsuranceProvider'));
		}
		
		# Return the form handle
		return $form;
	}
	
	
	# Function to define the asssessment form template
	public function formTemplateLocal ($data, $watermark)
	{
		# Get the number of hazard and equipment rows in the database table structure
		$hazardRows = application::array_preg_match_total ('/^hazard[0-9]+_description$/', array_keys ($data));
		$equipmentRows = application::array_preg_match_total ('/^equipment[0-9]+_name$/', array_keys ($data));
		
		# Set whether the form should include the customs/insurance fields
		$stage2InfoRequired = ($data['stage2InfoRequired']);
		
		$html  = '<h4>Emergency contact</h4>
		
		<table class="graybox regulated">
			<tr>
				<td>Name of a personal contact to be used in the event of an accident:</td>
				<td>{contactName}</td>
			</tr>
			<tr>
				<td>Address of personal contact:</td>
				<td>{contactAddress}</td>
			</tr>
			<tr>
				<td>Phone number of personal contact:</td>
				<td>{contactPhone}</td>
			</tr>
		</table>
		
		<h4>Details of fieldwork/travel</h4>
		
		<table class="graybox regulated">
			<tr>
				<td>What country are you going to?</td>
				<td>{country}</td>
			</tr>
			<tr>
				<td>What is your country of origin? (E.g. where are you travelling from).</td>
				<td>{originCountry}</td>
			</tr>
			<tr>
				<td>What mode(s) of travel will you be using?</td>
				<td>{travelModes}</td>
			</tr>
			<tr>
				<td>Are you aware of the <a href="/general/sustainability/travelpolicy/" target="_blank">Department Travel Policy</a>?</td>
				<td>{travelPolicyAwareness}</td>
			</tr>
			<tr>
				<td>Have you taken account of the Travel Policy when making your plans for this trip?</td>
				<td>{travelPolicyAccountedFor}</td>
			</tr>
			<tr>
				<td>Where are you going?</td>
				<td>{place}</td>
			</tr>
			<tr>
				<td>What will you be doing there?</td>
				<td>
					' . ($data['type'] == 'Undergraduate' ? 'Paste in your 100-word essay here:<br />' : '') . '
					{activity}
				</td>
			</tr>
			<tr>
				<td>When will you be there?</td>
				<td>{when}</td>
			</tr>
			<tr>
				<td>Will your project involve importing foreign soil and/or plant material?</td>
				<td>{organicMaterial}</td>
			</tr>
			<tr>
				<td>Have you checked the <a href="https://www.gov.uk/foreign-travel-advice" target="_blank">FCO website</a>?</td>
				<td>{fcoWebsiteChecked}</td>
			</tr>
			<tr>
				<td>Does the FCO advise against any travel to your intended destination?</td>
				<td>
					{fcoAdviseAgainst}
					<p>The department will <strong>not</strong> endorse projects that take place in a country/ies or within an area where the UK Foreign and Commonwealth Office (FCO) advises against all travel (or the particular type of travel to be engaged in for the research project), before departure.</p>
				</td>
			</tr>
		</table>
		
		<h4>Insurance</h4>
		<div class="graybox">
		<p>If you are an undergraduate student travelling abroad (and not to your home country), you MUST obtain your own travel insurance cover.</p>
		<p>Please provide the name of your insurer and policy number in the text box below.</p>
		<p>If you are yet to obtain travel insurance, please type \'YES\' in the box to confirm that you will arrange for appropriate cover and send the name of your insurer and policy number to the DSO by e-mail as soon as it is available. You MUST provide this information before travelling.</p>
		<p>If you are a member of staff or a graduate student travelling abroad, you MUST <a href="https://www.insurance.admin.cam.ac.uk/insurance-guidance/travel-insurance/travel-insurance-application-process-all-students-and-employees" target="_blank" title="[Link opens in a new window]">register your travel plans with the University</a> so that they can provide travel insurance cover.</p>
		<p>{insurance}</p>
		</div>
		
		<h4>Local contact details (e.g. where you are staying)</h4>
		
		<table class="graybox regulated">
			<tr>
				<td>Local address</td>
				<td>{stayingAddress}</td>
			</tr>
			<tr>
				<td>Local phone number</td>
				<td>{stayingPhone}</td>
			</tr>
			<tr>
				<td>Local mobile number (if any)</td>
				<td>{stayingMobile}</td>
			</tr>
			<tr>
				<td>Names and contact details of anyone you will be travelling with</td>
				<td>{travellingWith}</td>
			</tr>
		</table>
		
		<h3 class="pagebreak">Section B &#8211; Personal risk assessment</h3>
		
		<hr />
		<p class="right"><a class="noautoicon" href="/safety/riskcategorisation.pdf" target="_blank"><img src="/safety/riskcategorisation.png" alt="Risk Categorisation Table" title="[Link opens in a new tab]" border="0" width="300" height="130" /><br />Risk Categorisation Table<br />[Link opens in a new tab]</a></p>
		<p>Please use the <a href="/safety/riskcategorisation.pdf" target="_blank">Risk Categorisation Table</a> [link opens in a new tab] to assess your proposed activity and determine the categorisation of risk as either Low, Medium or High. You will be asked to confirm your determination in the following questions on the form.</p>
		<p>Have you reviewed the Risk Categorisation Table?<br />{riskChartChecked}</p>
		<p>What is your self-assessed risk categorisation?<br />{riskLevel}</p>
		<hr />
		
		' . $watermark . '
		<p>You should consider the hazards you might encounter (e.g. busy roads, dark streets, cliffs, deep or running water); the risks associated with them (e.g. road collisions, being attacked, falling, drowning or being swept away); and your measures for minimising or avoiding these risks.</p>
		
		<table class="graybox">
			<tr>
				<th></th>
				<th>What hazards do you perceive you might experience while undertaking this fieldwork?</th>
				<th>What are the risks associated with these hazards. (For example: \'Fast-moving traffic\', \'Trip hazard\', \'Armed guards\')</th>
				<th>What do you consider is the likelihood of your being exposed to these risks?</th>
				<th>How do you propose to avoid or reduce the likelihood of being exposed to the risk?</th>
				<th>If you consider the risk requires that (a) you take advice locally, or (b) you inform someone locally of your intentions, who would this be?</th>
			</tr>
		';
		
		# Add each hazard row
		for ($i = 1; $i <= $hazardRows; $i++) {
			$html .= "
			<tr>
				<td>{$i}:</td>
				<td>{hazard{$i}_description}</td>
				<td>{hazard{$i}_risks}</td>
				<td>{hazard{$i}_likelihood}</td>
				<td>{hazard{$i}_reduction}</td>
				<td>{hazard{$i}_person}</td>
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
		
		$html .= '
		</table>
		
		<p>If you have taken advice from someone or used reference material in order to quantify the risks involved listed above, please note them here:<br />
		{advicePerson}</p>
		
		<h3 class="pagebreak">Section C: Equipment risk analysis</h3>
		' . $watermark . '
		
		<p>Please make a <em>provisional</em> return here if you hope to borrow items of Departmental field equipment.' . ($data['type'] == 'Undergraduate' ? ' You will be asked to complete a more detailed assessment in the Easter Term, including customs information and insurance details, and to apply the equipment using the online system at a later date.' : '') . '</p>
		<p>If the equipment has a value of under &#163;100 you do not need to list it here.</p>
		
		<table class="lines">
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
				<td colspan="7">Fill in as many as relevant:</td>
			</tr>
		';
		
		# Add each equipment row
		for ($i = 1; $i <= $equipmentRows; $i++) {
			$html .= "
			<tr>
				<td>{$i}:</td>
				<td>{equipment{$i}_name}</td>
				<td>{equipment{$i}_value}</td>
				<td>{equipment{$i}_transportation}</td>
				<td>{equipment{$i}_insurance}</td>
				<td>{equipment{$i}_risk}</td>
				<td>{equipment{$i}_security}</td>
			</tr>
			";
		}
		
		$html .= '
		</table>
		';
		
		if ($stage2InfoRequired) {
			$html .= '
				<h3 id="stage2info" class="pagebreak">Section D: Customs and insurance information</h3>
				
				<p>Customs: Many countries have very strict customs regulations and when equipment is sent by courier or taken by hand, it must be accompanied by documentation required by that country. This usually consists of a <a title="[Link opens in a new window]" href="https://www.gov.uk/ata-and-cpd-carnets-export-procedures" target="_blank">Customs Carnet (costing around &#163;200 plus a proportion of the import tax)</a> with a full list of all equipment irrespective of the value of that equipment, complete with a signed statement that says you will be exporting the equipment back to the home country after use.</p>
				<table class="lines">
					<tr>
						<th>Country you are visiting</th>
						<th>Finalised document reference numbers and dates<br />(Put \'n/a\' if not applicable)</th>
					</tr>
					<tr>
						<td>{customsCountry1}</td>
						<td>{customsDocument1}</td>
					</tr>
					<tr>
						<td>{customsCountry2}</td>
						<td>{customsDocument2}</td>
					</tr>
					<tr>
						<td>{customsCountry3}</td>
						<td>{customsDocument3}</td>
					</tr>
				</table>
				
				<p>Insurance details: Please give details of insurance where relevant.</p>
				<table class="lines">
					<tr>
						<th></th>
						<th>Provider</th>
						<th>Policy number</th>
					</tr>
					<tr>
						<td>Health insurance:</td>
						<td>{healthInsuranceProvider}</td>
						<td>{healthInsurancePolicy}</td>
					</tr>
					<tr>
						<td>Travel insurance:</td>
						<td>{travelInsuranceProvider}</td>
						<td>{travelInsurancePolicy}</td>
					</tr>
					<tr>
						<td>Equipment insurance:</td>
						<td>{equipmentInsuranceProvider}</td>
						<td>{equipmentInsurancePolicy}</td>
					</tr>
				</table>
				';
		}
		
		# Final confirmation
		$html .= '
			<h3 class="pagebreak">Confirmation</h3>
			<div class="graybox">
				<p>All accidents, however trivial they may seem, should be reported to the Safety Office. I agree that if an accident or incident occurs during the work covered by this Risk Assessment, I will inform the Safety Office and ' . $this->settings['directorDescription'] . ' using an <a href="https://portal.assessweb.co.uk/portal_login.asp?c=359372&amp;r=npQF1rXDLYvDvDLORJDX&amp;f=Jh1wOrlE&amp;i=129&amp;a=nzCIwDeJ1uQKV5J" target="_blank">Accident/Incident Report Form</a>.</p>
				<p><strong>Tick to confirm: {confirmation}</strong></p>
			</div>
		';
		
		# Return the HTML
		return $html;
	}
}

?>
