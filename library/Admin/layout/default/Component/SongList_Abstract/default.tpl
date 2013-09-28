<ul class="songList">
	{foreach $songList as $song}
		<li class="song">
			{$song->getLabel()|escape}
		</li>
	{/foreach}
</ul>
