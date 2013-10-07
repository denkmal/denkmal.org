<ul class="songList">
	{foreach $songList as $song}
		<li class="song">
			{component name='Admin_Component_Song' song=$song}
		</li>
	{/foreach}
</ul>

{paging paging=$songList}
