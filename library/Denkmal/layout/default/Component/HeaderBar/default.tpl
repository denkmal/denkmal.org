<div class="bar">
  <div class="logoWrapper">
    <a class="logo" href="{linkUrl page='Denkmal_Page_Events'}">
      <span class="baslerstab">{resourceFileContent path='img/logo-baslerstab.svg'}</span>
      <span class="denkmal">{resourceFileContent path='img/logo-denkmal.svg'}</span>
    </a>
    <p class="slogan">{translate 'Was loift in Basel?!'}</p>
  </div>
  {link icon="plus" title="{translate 'Event hinzufügen'}" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton"}
  {menu name='dates' template='weekdays'}
  {link icon="calendar" class="showWeek navButton"}
</div>
