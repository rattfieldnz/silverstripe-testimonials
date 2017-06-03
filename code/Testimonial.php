<?php

class Testimonial extends DataObject{

	private static $singular_name = "Testimonial";
	private static $plural_name = "Testimonials";

	private static $db = array(
		'Content' => 'Text',
		'Name' => 'Varchar',
		'Business' => 'Varchar', 
		'AdditionalCredits' => 'Varchar(1024)',
		'Date' => 'Date',
		'Hidden' => 'Boolean'
	);

	private static $has_one = array(
		'Image' => 'Image',
		'Member' => 'Member', 
	);

	private static $summary_fields = array(
		'Business',
		'Name',
		'AdditionalCredits', 
		'Date'
	);

	private static $default_sort = "Date DESC";

	public function getCMSFields() {
		$fields = parent::getCMSFields();
        
		$fields->addFieldToTab("Root.Main",
			DropdownField::create(
                "MemberID",
                "Member",
				Member::get()->map("ID","Name")->toArray()
			)->setEmptystring(_t("Testimonials.NoName", "Don't Select Member"))
		);
		
		$fields->addFieldToTab(
		    'Root.Main', 
			TextField::create(
			    'AdditionalCredits',
				_t('Testimonial.AdditionalCredits', 'Additional Credits'), 
				null, 
				1024
			)->setDescription(_t(
                    'Testimonial.AdditionalCredits_Description',
                    'If some authors of this testimonial don\'t have CMS access, enter their name(s) here. You can separate multiple names with a comma.')
            )
		);


		return $fields;
	}

	public function getFrontEndFields($params = null) {
		$fields = $this->scaffoldFormFields($params);
        
		$fields->removeByName('Date');
		$fields->removeByName('Hidden');
        
		if(!$this->isInDB()){
			$fields->removeByName('Image');
		}
		if(isset($params['Testimonial']) && $params['Testimonial']->MemberID){
			$fields->removeByName("Name");
		}
        
		$fields->removeByName("MemberID");
        
		$this->extend('updateFrontEndFields', $fields);

		return $fields;
	}
	
	public function TestimonialContent(){
		
		$wordCount = Config::inst()->get('TestimonialsHolderPage', 'testimonial_words_summary_count');
		
		return self::LimitWordCount($this->Content, $wordCount);
	}
	
	
	/**
	 * Limit this field's content by a number of words.
	 *
	 * @param int $numWords Number of words to limit by
	 * @param string $add Ellipsis to add to the end of truncated string
	 * @return string
	 */
	private static function LimitWordCount($content, $numWords, $add = '...') {
		
		if(!empty($content)){
			$content = trim(Convert::xml2raw($content));
			$ret = explode(' ', $content, $numWords + 1);
			
			if(count($ret) <= $numWords - 1) {
				$ret = $content;
			} else {
				array_pop($ret);
				$ret = implode(' ', $ret) . $add;
			}
			
			return $ret;
		} else {
			return "";
		}
	}

	public function Link() {
		if($page = TestimonialsHolderPage::get()->first()){
			return $page->Link().'#Testimonial'.$this->ID;
		}
	}

	public function Image(){
		$member = $this->Member();
		if($member->exists() && $member->ImageID){
			return $member->Image();
		}
		return $this->getComponent("Image");
	}

	public function Name(){
		if($this->Member()->exists()){
			return $this->Member()->Name;
		}
		return $this->getField("Name");
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();
		if(!$this->Date) {
			$this->Date = date('Y-m-d H:i:s');
		}
	}
	
	/**
     * Resolves static authors linked to this post.
     *
     * @return String
     */
    public function Credits()
    {
        $credits = "";

        if(empty($this->AdditionalCredits) && empty($this->Name) && empty($this->Business)) {
        	return "Anon";
        }

        if(empty($this->AdditionalCredits) && empty($this->Name) && !empty($this->Business)) {
        	return $this->Business;
        }

        if(empty($this->AdditionalCredits) && !empty($this->Name) && !empty($this->Business)) {
        	return $this->Name . ", of " . $this->Business;
        }
		
		if(empty($this->AdditionalCredits) && !empty($this->Name) && empty($this->Business)) {
			return $this->Name;
		}

        if(!empty($this->AdditionalCredits) && !empty($this->Name) && !empty($this->Business)) {
        	
	        $authors = array_filter(preg_split('/\s*,\s*/', $this->AdditionalCredits));
	        array_push($authors, $this->Name());
			sort($authors);

			for($i = 0; $i < count($authors); $i++){
				if($i != (count($authors) - 1)){
					$credits .= $authors[$i] . ", ";
				} 
				else { 
					$credits .= "and " . $authors[$i];
				}
			}
            return $credits . ", of " . $this->Business;
        }
    }
    

	public static function get_random($limit = 3) {
		return Testimonial::get()->sort("RAND()")->limit($limit);
	}

	public function canCreate($member = null) {
        if(!$member) $member = Member::currentUser();
        
		return (boolean)$member;
	}

	public function canEdit($member = null) {
        if(!$member) $member = Member::currentUser();
        
		return Permission::check("CMS_ACCESS_CMSMain") || ($member && $this->MemberID == $member->ID);
	}

	public function canDelete($member = null) {
        if(!$member) $member = Member::currentUser();
        
		return Permission::check("CMS_ACCESS_CMSMain") || ($member && $this->MemberID == $member->ID);
	}

	public function canView($member = null) {
		return true;
	}
	
}