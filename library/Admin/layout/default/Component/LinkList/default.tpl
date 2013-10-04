<ul class="linkList">
	{foreach $linkList as $link}
		<li class="link">
			{component name='Admin_Component_Link' link=$link}
		</li>
	{/foreach}
</ul>
