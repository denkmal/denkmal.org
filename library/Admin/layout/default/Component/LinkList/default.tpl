<ul class="linkList">
	{foreach $linkList as $link}
		<li class="link" data-id="{$link->getId()}">
			{$link->getLabel()|escape}
			<a target="_blank" href="{$link->getUrl()}">{$link->getUrl()}</a>
			{if !$link->getAutomatic()}[manual]{/if}
			{link icon="delete" class="deleteLink"}
		</li>
	{/foreach}
</ul>

