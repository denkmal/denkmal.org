<div class="bar clearfix">
	<div class="logoWrapper">
		{link icon="baslerstab" label="denkmal.org" page="Denkmal_Page_Index" class="logo navButton toggleMenu"}
		<p class="slogan">{translate 'Was loift in Basel?!'}</p>
	</div>
	{link icon="mailbox" class="menuButton navButton toggleMenu" label="{translate 'Kontakt'}"}
	{link icon="plus" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton addEvent"}
	{link icon="search" class="searchButton navButton showSearch"}
	<div class="searchForm">
		<span class="icon-search"></span>
		{form name='Denkmal_Form_SearchContent'}
		{input name='term' placeholder="{translate 'Suche'}…"}
		{/form}
	</div>
	<ul class="navigation clearfix">
		<li><a class="navButton" href="javascript:;">Mo</a></li>
		<li><a class="navButton" href="javascript:;">Di</a></li>
		<li class="active"><a class="navButton" href="javascript:;">Mi</a></li>
		<li><a class="navButton" href="javascript:;">Do</a></li>
		<li><a class="navButton" href="javascript:;">Fr</a></li>
		<li><a class="navButton" href="javascript:;">Sa</a></li>
		<li><a class="navButton" href="javascript:;">So</a></li>
	</ul>
</div>
