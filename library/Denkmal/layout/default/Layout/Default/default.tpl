{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='tileColor'}#99cc6b{/block}

{block name='head' append}
{*<meta name="google-site-verification" content="Me65LlbI0NCpU5BFHN_2T0dUI3npK_g_PFuciudyFkU">*}
{/block}

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
