{extends file=$render->getLayoutPath('Page/Abstract/default.tpl', 'CM')}

{block name='content'}
  {menu name="main" class="menu-pills" depth=1}
  {block name='content-title'}{/block}
  {block name='content-main'}{/block}
{/block}
