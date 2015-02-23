<div class="bar">
  <div class="logoWrapper">
    <a class="logo" href="{linkUrl page='Denkmal_Page_Events'}">
      <span class="baslerstab">{resourceFileContent path='img/logo-baslerstab.svg'}</span>
      <span class="denkmal">{resourceFileContent path='img/logo-denkmal.svg'}</span>
    </a>
    <p class="slogan">{translate 'Was loift in Basel?!'}</p>
  </div>
  {link icon="plus" title="{translate 'Event hinzufügen'}" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton"}
  <div class="menu-wrapper">
    <div class="navigate navigate-left">
      <span class="icon-arrow-left"></span>
    </div>
    {menu name='dates' template='weekdays'}
    <div class="navigate navigate-right">
      <span class="icon-arrow-right"></span>
    </div>
  </div>
</div>
