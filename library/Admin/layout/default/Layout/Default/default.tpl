{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
	<header id="header">
		{link icon="baslerstab" label="denkmal.org" page="Denkmal_Page_Index" class="logo navButton toggleMenu"}
		{menu name='main'}
	</header>
	<section id="middle">
		{component name=$viewObj->getPage()}
	</section>
	{component name='Denkmal_Component_SongPlayer'}
{/block}
