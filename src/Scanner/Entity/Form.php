<?php
namespace Scanner\Entity;

use Symfony\Component\DomCrawler\Form as BaseForm;

/**
 * Overridden so we can attach some of our own behavior here
 */
class Form extends BaseForm
{
	/**
	 * Calculate a unique value for this form. This will detect forms that are
	 * identical on different pages
	 */
	public function getHash()
	{
		$fields = array();
    	foreach($this->all() as $field) {
    		$fields[] = array(get_class($field), $field->getName());
    	}

    	$meta = array($fields, $this->getMethod(), $this->getUri());
    	$hash = md5(serialize($meta));

    	return $hash;
	}
}