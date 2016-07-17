{extends file=$render->getLayoutPath('Page/Abstract/default.tpl', 'CM')}

{block name='content'}
  <div class="content-header">
    {menu name="main" class="menu-pills" depth=1}
    {menu name="main" class="menu-pills" depth=2}
  </div>
  {block name='content-title'}{/block}
  {block name='content-main'}{/block}
  <footer>
    {component name='Admin_Component_SelectRegion'}
  </footer>
{/block}
