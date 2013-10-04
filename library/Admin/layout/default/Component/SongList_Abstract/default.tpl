<ul class="songList">
	{foreach $songList as $song}
		<li class="song" data-id="{$song->getId()}">
			{$song->getLabel()|escape}
			{link icon="delete" class="deleteSong"}
		</li>
	{/foreach}
</ul>
