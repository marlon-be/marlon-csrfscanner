<?php
namespace Scanner\Tools;

use Scanner\Collection\PagesCollection;

class Spider
{
	/**
	 * @return PagesCollection New collection with all discovered pages
	 */
	public function spider(PagesCollection $startpages)
	{
		$todo = clone $startpages;
		$done = new PagesCollection;
		while(count($todo))
		{
			$current = $todo->current();
			foreach($current->findLinkedPages() as $page)
			{
				if(!$done->contains($page) && !$todo->contains($page))	{
					$todo->add($page);
				}
			}
			$todo->removeElement($current);
			$done->add($current);
		}

		return $done;
	}
}