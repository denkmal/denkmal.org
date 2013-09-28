{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='tileColor'}#99cc6b{/block}

{block name='body'}
	<header id="header">
		<div class="sheet">
			{block name='header'}
				{component name='Denkmal_Component_HeaderBar'}
			{/block}
		</div>
	</header>
	<section id="middle" class="sheet">
		{component name=$viewObj->getPage()}
	</section>
	{component name='Denkmal_Component_SongPlayer'}
{/block}
