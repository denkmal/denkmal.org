{extends file=$render->getLayoutPath('Layout/Default/default.tpl', 'Denkmal')}

{block name='header'}
  <div class="logoWrapper">
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="logo-symbol">{resourceFileContent path='img/logo-symbol.svg'}</span>
      <span class="logo-type">{resourceFileContent path='img/logo-type.svg'}</span>
    </a>
  </div>
{/block}
