<div class="bar clearfix">
	<div class="logoWrapper">
		{link icon="baslerstab" label="denkmal.org" page="Denkmal_Page_Index" class="logo navButton toggleMenu"}
		<p class="slogan">{translate 'Was loift in Basel?!'}</p>
	</div>
	{link icon="mailbox" class="contactButton navButton" label="{translate 'Kontakt'}"}
	{link icon="plus" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton addEvent"}
	{link icon="search" class="searchButton navButton showSearch"}
	<div class="searchForm">
		<span class="icon-search"></span>
		{form name='Denkmal_Form_SearchContent'}
		{input name='term' placeholder="{translate 'Suche'}…"}
		{/form}
	</div>
	<ul class="navigation clearfix">
		{foreach $dateList as $date}
			<li>
				<a class="navButton" href="{linkUrl page='Denkmal_Page_Events' date=$date->__toString()}">{$date->getWeekday()}</a>
			</li>
		{/foreach}
	</ul>
</div>
