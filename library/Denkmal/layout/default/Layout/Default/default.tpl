{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='tileColor'}#99cc6b{/block}

{block name='body'}
	<div class="headerWrapper">
		<header id="header">
			{block name='header'}
				{component name='Denkmal_Component_HeaderBar'}
			{/block}
		</header>
	</div>
	<section id="middle">
		{component name=$viewObj->getPage()}
	</section>
{/block}
