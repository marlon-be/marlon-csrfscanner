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
			$current = $todo->pop();
			if(!$done->contains($current))
			{
				foreach($current->findLinkedPages() as $found)
				{
					if(!$done->contains($found))
					{
						$todo->add($found);
					}
				}
			}
			$done->add($current);
		}

		return $done;
	}
}