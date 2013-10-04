{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name="before-html"}
	<!--


		You like to see what's under the hood?

		 __                                 __
		/   _  _ _  _   |\/| _ _|. _    /\ / _
		\__(_|| (_)(_)  |  |(-(_||(_|  /--\\__)
				_/

			  Large Scale Web Development


				--- We Hire ---
			   www.cargomedia.ch


	-->
{/block}
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
