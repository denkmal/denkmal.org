{foreach $links as $link}
	{$link->getLabel()} -> {$link->getUrl()}
{/foreach}
