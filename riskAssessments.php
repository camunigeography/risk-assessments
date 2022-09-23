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
		
		# Hazard rows (for form and logic below)
		$this->hazardRows = 10;
		$this->equipmentRows = 10;
		
		# Merge in the default defaults
		$defaults += parent::defaults ();
		
		# Return the defaults
		return $defaults;
	}
	
	
	
	# Function to define the asssessment form template
	public function form_default ($data, $watermark)
	{
		# Set whether the form should include the customs/insurance fields
		$stage2InfoRequired = ($data['stage2InfoRequired']);
		
		$html  = "<h4>Emergency contact</h4>
		
		<table class=\"graybox regulated\">
			<tr>
				<td>Name of a personal contact to be used in the event of an accident:</td>
				<td>{contactName|varchar(255)|Name of a personal contact}</td>
			</tr>
			<tr>
				<td>Address of personal contact:</td>
				<td>{contactAddress|mediumtext|Address of personal contact}</td>
			</tr>
			<tr>
				<td>Phone number of personal contact:</td>
				<td>{contactPhone|varchar(255)|Phone number of personal contact}</td>
			</tr>
		</table>
		
		<h4>Details of fieldwork/travel</h4>
		
		<table class=\"graybox regulated\">
			<tr>
				<td>What country are you going to?</td>
				<td>{country|varchar(255)|Country}</td>
			</tr>
			<tr>
				<td>What is your country of origin? (E.g. where are you travelling from).</td>
				<td>{originCountry|varchar(255)|Country of origin}</td>
			</tr>
			<tr>
				<td>What mode(s) of travel will you be using?</td>
				<td>{travelModes|set('Car','Bus','Rail','Boat','Plane')|Travel mode(s)}</td>
			</tr>
			<tr>
				<td>Are you aware of the <a href=\"/general/sustainability/travelpolicy/\" target=\"_blank\">Department Travel Policy</a>?</td>
				<td>{travelPolicyAwareness|enum('Yes','No')|Are you aware of the Department Travel Policy?}</td>
			</tr>
			<tr>
				<td>Have you taken account of the Travel Policy when making your plans for this trip?</td>
				<td>{travelPolicyAccountedFor|enum('Yes','No')|Have you taken account of the Travel Policy when making your plans for this trip?}</td>
			</tr>
			<tr>
				<td>Where are you going?</td>
				<td>{place|mediumtext|Where are you going}</td>
			</tr>
			<tr>
				<td>What will you be doing there?</td>
				<td>
					" . ($data['type'] == 'Undergraduate' ? 'Paste in your 100-word essay here:<br />' : '') . "
					{activity|mediumtext|What will you be doing there}
				</td>
			</tr>
			<tr>
				<td>When will you be there?</td>
				<td>{when|mediumtext|When will you be there}</td>
			</tr>
			<tr>
				<td>Will your project involve importing foreign soil and/or plant material?</td>
				<td>{organicMaterial|enum('Yes','No')|Soil and/or plant material}</td>
			</tr>
			<tr>
				<td>Have you checked the <a href=\"https://www.gov.uk/foreign-travel-advice\" target=\"_blank\">FCO website</a>?</td>
				<td>{fcoWebsiteChecked|enum('Yes','No')|FCO website}</td>
			</tr>
			<tr>
				<td>Does the FCO advise against any travel to your intended destination?</td>
				<td>
					{fcoAdviseAgainst|enum('No','Yes')|FCO advice}
					<p>The department will <strong>not</strong> endorse projects that take place in a country/ies or within an area where the UK Foreign and Commonwealth Office (FCO) advises against all travel (or the particular type of travel to be engaged in for the research project), before departure.</p>
				</td>
			</tr>
		</table>
		
		<h4>Insurance</h4>
		<div class=\"graybox\">
		<p>If you are an undergraduate student travelling abroad (and not to your home country), you MUST obtain your own travel insurance cover.</p>
		<p>Please provide the name of your insurer and policy number in the text box below.</p>
		<p>If you are yet to obtain travel insurance, please type 'YES' in the box to confirm that you will arrange for appropriate cover and send the name of your insurer and policy number to the DSO by e-mail as soon as it is available. You MUST provide this information before travelling.</p>
		<p>If you are a member of staff or a graduate student travelling abroad, you MUST <a href=\"https://www.insurance.admin.cam.ac.uk/insurance-guidance/travel-insurance/travel-insurance-application-process-all-students-and-employees\" target=\"_blank\" title=\"[Link opens in a new window]\">register your travel plans with the University</a> so that they can provide travel insurance cover.</p>
		<p>{insurance|varchar(255)|Insurance}</p>
		</div>
		
		<h4>Local contact details (e.g. where you are staying)</h4>
		
		<table class=\"graybox regulated\">
			<tr>
				<td>Local address</td>
				<td>{stayingAddress|mediumtext|Local address}</td>
			</tr>
			<tr>
				<td>Local phone number</td>
				<td>{stayingPhone|varchar(255)|Local phone}</td>
			</tr>
			<tr>
				<td>Local mobile number (if any)</td>
				<td>{stayingMobile|varchar(255)|Local mobile}</td>
			</tr>
			<tr>
				<td>Names and contact details of anyone you will be travelling with</td>
				<td>{travellingWith|mediumtext|Travelling with}</td>
			</tr>
		</table>
		
		<h3 class=\"pagebreak\">Section B &#8211; Personal risk assessment</h3>
		
		<hr />
		<p class=\"right\"><a class=\"noautoicon\" href=\"/safety/riskcategorisation.pdf\" target=\"_blank\"><img src=\"/safety/riskcategorisation.png\" alt=\"Risk Categorisation Table\" title=\"[Link opens in a new tab]\" border=\"0\" width=\"300\" height=\"130\" /><br />Risk Categorisation Table<br />[Link opens in a new tab]</a></p>
		<p>Please use the <a href=\"/safety/riskcategorisation.pdf\" target=\"_blank\">Risk Categorisation Table</a> [link opens in a new tab] to assess your proposed activity and determine the categorisation of risk as either Low, Medium or High. You will be asked to confirm your determination in the following questions on the form.</p>
		<p>Have you reviewed the Risk Categorisation Table?<br />{riskChartChecked|enum('','Yes')|Risk Categorisation Table checked?}</p>
		<p>What is your self-assessed risk categorisation?<br />{riskLevel|enum('Low','Medium','High')|Self-assessed risk categorisation}</p>
		<hr />
		
		" . $watermark . "
		<p>You should consider the hazards you might encounter (e.g. busy roads, dark streets, cliffs, deep or running water); the risks associated with them (e.g. road collisions, being attacked, falling, drowning or being swept away); and your measures for minimising or avoiding these risks.</p>
		
		<table class=\"graybox\">
			<tr>
				<th></th>
				<th>What hazards do you perceive you might experience while undertaking this fieldwork?</th>
				<th>What are the risks associated with these hazards. (For example: 'Fast-moving traffic', 'Trip hazard', 'Armed guards')</th>
				<th>What do you consider is the likelihood of your being exposed to these risks?</th>
				<th>How do you propose to avoid or reduce the likelihood of being exposed to the risk?</th>
				<th>If you consider the risk requires that (a) you take advice locally, or (b) you inform someone locally of your intentions, who would this be?</th>
			</tr>
		";
		
		# Add each hazard row
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$html .= "
			<tr>
				<td>{$i}:</td>
				<td>{hazard{$i}_description|mediumtext|Hazard ({$i}) description}</td>
				<td>{hazard{$i}_risks|mediumtext|Hazard ({$i}) risks}</td>
				<td>{hazard{$i}_likelihood|enum('','Low','Medium','High')|Hazard ({$i}) likelihood}</td>
				<td>{hazard{$i}_reduction|mediumtext|Hazard ({$i}) reduction}</td>
				<td>{hazard{$i}_person|mediumtext|Hazard ({$i}) person}</td>
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
		
		<p>If you have taken advice from someone or used reference material in order to quantify the risks involved listed above, please note them here:<br />
		{advicePerson|mediumtext|Taken advice}</p>
		
		<h3 class=\"pagebreak\">Section C: Equipment risk analysis</h3>
		" . $watermark . "
		
		<p>Please make a <em>provisional</em> return here if you hope to borrow items of Departmental field equipment." . ($data['type'] == 'Undergraduate' ? ' You will be asked to complete a more detailed assessment in the Easter Term, including customs information and insurance details, and to apply the equipment using the online system at a later date.' : '') . "</p>
		<p>If the equipment has a value of under &#163;100 you do not need to list it here.</p>
		
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
				<td>{equipment{$i}_name|mediumtext|Equipment ({$i}) name}</td>
				<td>{equipment{$i}_value|int|Equipment ({$i}) value}</td>
				<td>{equipment{$i}_transportation|mediumtext|Equipment ({$i}) transportation}</td>
				<td>{equipment{$i}_insurance|enum('','Yes','No')|Equipment ({$i}) insurance}</td>
				<td>{equipment{$i}_risk|enum('','Low','Medium','High')|Equipment ({$i}) risk}</td>
				<td>{equipment{$i}_security|mediumtext|Equipment ({$i}) security}</td>
			</tr>
			";
		}
		
		$html .= '
		</table>
		';
		
		if ($stage2InfoRequired) {
			$html .= "
				<h3 id=\"stage2info\" class=\"pagebreak\">Section D: Customs and insurance information</h3>
				
				<p>Customs: Many countries have very strict customs regulations and when equipment is sent by courier or taken by hand, it must be accompanied by documentation required by that country. This usually consists of a <a title=\"[Link opens in a new window]\" href=\"https://www.gov.uk/ata-and-cpd-carnets-export-procedures\" target=\"_blank\">Customs Carnet (costing around &#163;200 plus a proportion of the import tax)</a> with a full list of all equipment irrespective of the value of that equipment, complete with a signed statement that says you will be exporting the equipment back to the home country after use.</p>
				<table class=\"lines\">
					<tr>
						<th>Country you are visiting</th>
						<th>Finalised document reference numbers and dates<br />(Put 'n/a' if not applicable)</th>
					</tr>
					<tr>
						<td>{customsCountry1|varchar(255)|Customs - Country (1)}</td>
						<td>{customsDocument1|mediumtext|Customs - document details (1)}</td>
					</tr>
					<tr>
						<td>{customsCountry2|varchar(255)|Customs - Country (2)}</td>
						<td>{customsDocument2|mediumtext|Customs - document details (2)}</td>
					</tr>
					<tr>
						<td>{customsCountry3|varchar(255)|Customs - Country (3)}</td>
						<td>{customsDocument3|mediumtext|Customs - document details (3)}</td>
					</tr>
				</table>
				
				<p>Insurance details: Please give details of insurance where relevant.</p>
				<table class=\"lines\">
					<tr>
						<th></th>
						<th>Provider</th>
						<th>Policy number</th>
					</tr>
					<tr>
						<td>Health insurance:</td>
						<td>{healthInsuranceProvider|mediumtext|Health insurance provider}</td>
						<td>{healthInsurancePolicy|mediumtext|Health insurance policy number}</td>
					</tr>
					<tr>
						<td>Travel insurance:</td>
						<td>{travelInsuranceProvider|mediumtext|Travel insurance provider}</td>
						<td>{travelInsurancePolicy|mediumtext|Travel insurance policy number}</td>
					</tr>
					<tr>
						<td>Equipment insurance:</td>
						<td>{equipmentInsuranceProvider|mediumtext|Equipment insurance provider}</td>
						<td>{equipmentInsurancePolicy|mediumtext|Equipment insurance policy number}</td>
					</tr>
				</table>
				";
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
	
	
	# Overrideable function to amend the main form attributes
	public function form_default_mainAttributes ($formMainAttributes)
	{
		$formMainAttributes['cols'] = 25;
		$formMainAttributes['rows'] = 3;
		//$formMainAttributes['size'] = 25;
		//$formMainAttributes['picker'] = true;
		
		# Return modified version
		return $formMainAttributes;
	}
	
	
	# Function to add elements to the dataBinding
	public function form_default_dataBindingAttributes ($dataBindingAttributes, $data)
	{
		# Set whether the form should include the customs/insurance fields
		$stage2InfoRequired = ($data['stage2InfoRequired']);
		
		# Add to the attributes
		$dataBindingAttributes += array (
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
		
		# Add in maxlength checking on some fields and give nicer titles (done here to save adding these tediously to each database comment)
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$dataBindingAttributes["hazard{$i}_description"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_risks"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_reduction"]['maxlength'] = 350;
			$dataBindingAttributes["hazard{$i}_person"]['maxlength'] = 350;
		}
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$dataBindingAttributes["equipment{$i}_name"]['maxlength'] = 350;
			$dataBindingAttributes["equipment{$i}_transportation"]['maxlength'] = 350;
			$dataBindingAttributes["equipment{$i}_security"]['maxlength'] = 350;
		}
		
		# Return the modified definition
		return $dataBindingAttributes;
	}
	
	
	# Overrideable function to set the required fields for the local section dataBinding
	public function form_default_localRequiredFields ($formLocalRequiredFields, $data)
	{
		# Ignore (reset) the standard definition (all fields, with ...Details handling)
		$formLocalRequiredFields = array ();
		
		# Define the database fields that should be treated as NOT NULL when doing a full submission (rather than "Save and continue"), even though the database sets them as NULLable; this is done manually so that the "Save and continue" button is possible
		$formLocalRequiredFields = array (
			'description', 'type', 'college', 'seniorPerson',
			'contactName', 'contactAddress', 'contactPhone', 'country', 'originCountry', 'travelModes', 'travelPolicyAwareness', 'travelPolicyAccountedFor', 'place', 'activity', 'when', 'organicMaterial', 'fcoWebsiteChecked', 'fcoAdviseAgainst',
			'insurance',
			'stayingAddress', 'stayingPhone', 'travellingWith', 'riskChartChecked', 'riskLevel',
			'hazard1_description', 'hazard1_risks', 'hazard1_likelihood', 'hazard1_reduction', 'hazard1_person', 'confirmation',
		);
		
		# Return the modified definition
		return $formLocalRequiredFields;
	}
	
	
	# Overrideable function to amend the exclude fields for the local section dataBinding
	public function form_default_localExcludeFields ($localExcludeFields, $data)
	{
		# Determine fields to exclude
		$stage2InfoRequired = ($data['stage2InfoRequired']);	# Whether the form should include the customs/insurance fields
		if (!$stage2InfoRequired) {
			$stage2Fields = array (
				'customsCountry1', 'customsDocument1',
				'customsCountry2', 'customsDocument2',
				'customsCountry3', 'customsDocument3',
				'healthInsuranceProvider', 'healthInsurancePolicy',
				'travelInsuranceProvider', 'travelInsurancePolicy',
				'equipmentInsuranceProvider', 'equipmentInsurancePolicy',
			);
			$localExcludeFields = array_merge ($localExcludeFields, $stage2Fields);
		}
		
		# Return the list
		return $localExcludeFields;
	}
	
	
	# Overrideable function to enable form validation rules to be added
	public function form_default_validationRules ($form, $data)
	{
		# Chained validation for the hazard/equipment matrix and customs/insurance
		for ($i = 1; $i <= $this->hazardRows; $i++) {
			$form->validation ('all', array (
				"hazard{$i}_description",
				"hazard{$i}_risks",
				"hazard{$i}_likelihood",
				"hazard{$i}_reduction",
				"hazard{$i}_person"
			));
		}
		for ($i = 1; $i <= $this->equipmentRows; $i++) {
			$form->validation ('all', array (
				"equipment{$i}_name",
				"equipment{$i}_value",
				"equipment{$i}_transportation",
				"equipment{$i}_insurance",
				"equipment{$i}_risk",
				"equipment{$i}_security"
			));
		}
		
		# Linked customs fields
		$stage2InfoRequired = ($data['stage2InfoRequired']);	# Whether the form should include the customs/insurance fields
		if ($stage2InfoRequired) {
			$form->validation ('all', array ('customsCountry1', 'customsDocument1'));
			$form->validation ('all', array ('customsCountry2', 'customsDocument2'));
			$form->validation ('all', array ('customsCountry3', 'customsDocument3'));
			$form->validation ('all', array ('healthInsuranceProvider', 'healthInsurancePolicy'));
			$form->validation ('all', array ('travelInsuranceProvider', 'travelInsurancePolicy'));
			$form->validation ('all', array ('equipmentInsuranceProvider', 'equipmentInsurancePolicy'));
			$form->validation ('either', array ('healthInsuranceProvider', 'travelInsuranceProvider', 'equipmentInsuranceProvider'));
		}
		
		# Return the modified form object
		return $form;
	}
}

?>
