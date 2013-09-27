{foreach $links as $link}
	<div class="link" data-id="{$link->getId()}">
		{$link->getLabel()|escape}
		<a target="_blank" href="{$link->getUrl()}">{$link->getUrl()}</a>
		{if $link->getAutomatic()}[automatic]{/if}
		<a href="javascript:;" class="delete">Delete</a>
	</div>
{/foreach}
