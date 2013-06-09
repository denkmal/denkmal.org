<div class="bar clearfix">
	<div class="logoWrapper">
		{link icon="baslerstab" label="denkmal.org" page="Denkmal_Page_Index" class="logo navButton toggleMenu"}
		<p class="slogan">{translate 'Was loift in Basel?!'}</p>
	</div>
	<a href="mailto:kontakt@denkmal.org" class="link contactButton navButton"><span class="icon icon-mailbox"></span><span class="label">{translate 'Kontakt'}</span></a>
	{link icon="plus" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton addEvent"}
	{link icon="search" class="searchButton navButton showSearch"}
	<div class="searchForm">
		<span class="icon-search"></span>
		{form name='Denkmal_Form_SearchContent'}
		{input name='term' placeholder="{translate 'Suche'}…"}
		{/form}
	</div>
	{menu name='dates'}
</div>
