<?php
namespace Scanner\Collection;

class PageCollection extends ArrayCollection
{
    public function add($value)
    {
        $this->_elements[$value->getUri()] = $value;
        return true;
    }
}