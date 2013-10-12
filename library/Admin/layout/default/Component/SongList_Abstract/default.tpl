{if $searchTerm}
	<h2>{translate 'Suchergebnis für `{$searchTerm}`' searchTerm=$searchTerm}</h2>
{/if}

{if $songList->getCount()}
	<ul class="songList">
		{foreach $songList as $song}
			<li class="song">
				{component name='Admin_Component_Song' song=$song}
			</li>
		{/foreach}
	</ul>
	{paging paging=$songList}
{else}
	<div class="noContent">
		{translate 'Keine Songs gefunden.'}
	</div>
{/if}
