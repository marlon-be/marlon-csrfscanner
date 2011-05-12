<?php
namespace Scanner\Collection;

use Scanner\Entity\Form;
use Doctrine\Common\Collections\ArrayCollection;

class FormsCollection extends ArrayCollection
{
	public function __construct(array $elements = array())
	{
		parent::__construct();
		foreach($elements as $element) {
			$this->add($element);
		}
	}

	private function check(Form $value)
	{
		// empty, the type hinting will check if $value is a Page instance
	}

    public function add($value)
    {
    	// make sure forms are unique
    	$hash = $this->getHash($value);
        return $this->set($hash, $value);
    }

    public function set($key, $value)
    {
    	$this->check($value);
		return parent::set($key, $value);
    }

	private function getHash(Form $form)
	{
		$fields = array();
    	foreach($form->all() as $field) {
    		$fields[] = array(get_class($field), $field->getName());
    	}

    	$meta = array($fields, $form->getMethod(), $form->getUri());
    	$hash = md5(serialize($meta));

    	return $hash;
	}
}