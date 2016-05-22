<div class="bar">

  <div class="mainMenu-wrapper">
    <div class="logoWrapper">
      <a class="logo" href="{linkUrl page='Denkmal_Page_Events'}">
        <span class="logo-city">{resourceFileContent path='img/logo-city.svg'}</span>
        <span class="logo-denkmal">{resourceFileContent path='img/logo-denkmal.svg'}</span>
      </a>
      <div class="slogan">{translate 'What\'s up in Basel?!'}</div>
    </div>

    {menu name='main' class='menu-header'}
  </div>

  <div class="weekMenu-wrapper">
    <div class="navigate navigate-left">
      <span class="icon-arrow-left"></span>
    </div>
    {menu name='dates' class='menu-header' template='weekdays'}
    <div class="navigate navigate-right">
      <span class="icon-arrow-right"></span>
    </div>
  </div>

</div>
