{extends file=$render->getLayoutPath('Layout/Default/default.tpl', 'Denkmal')}

{block name='header'}
  <div class="logoWrapper">
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="logo-icon">{resourceFileContent path='img/logo-icon.svg'}</span>
      <span class="logo-font">{resourceFileContent path='img/logo-font.svg'}</span>
    </a>
  </div>
{/block}
