{block name='headline'}
	{if $searchTerm}
		<h2>{translate 'Suchergebnis für `{$searchTerm}`' searchTerm=$searchTerm}</h2>
	{/if}
{/block}

{if $linkList->getCount()}
	<ul class="linkList">
		{foreach $linkList as $link}
			<li class="link">
				{component name='Admin_Component_Link' link=$link}
			</li>
		{/foreach}
	</ul>
	{paging paging=$linkList}
{else}
	<div class="noContent">{block name='noContent'}{translate 'Keine Links vorhanden.'}{/block}</div>
{/if}

