{foreach $links as $link}
	<div data-id="{$link->getId()}">
		{$link->getLabel()}
		<a href="{$link->getUrl()}">{$link->getUrl()}</a>
		{if $link->getAutomatic()}[automatic]{/if}
	</div>
{/foreach}
