{if $searchTerm}
	<h2>{translate 'Suchergebnis für `{$searchTerm}`' searchTerm=$searchTerm}</h2>
{/if}

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
	<div class="noContent">{translate 'Keine Links gefunden.'}</div>
{/if}

