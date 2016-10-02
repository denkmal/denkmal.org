{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <h2>{translate 'Facebook Page List'}</h2>
  A list of facebook pages to scrape that don't belong to any venue.
  <div class="addNew">
    <div class="toggleNext">{translate 'Add'}<span class="icon-plus"></span></div>
    <div class="toggleNext-content">
      {if $region}
        {form name='Admin_Form_FacebookPageList' region=$region}
        {formField name='facebookPage'}
        {formAction action='Add' label={translate 'Add'}}
        {/form}
      {else}
        Select a region in order to add a new page.
      {/if}
    </div>
  </div>
  <ul>
    {foreach $facebookPageList as $facebookPage}
      <li data-facebookpage-id="{$facebookPage->getId()}">
        <div class="toggleNext">
          {$facebookPage->getName()|escape}
          <a class="toggleNext-excluded" href="{$facebookPage->getUrl()|escape}"><span class="icon icon-pop-out"></span></a>
        </div>
        <div class="toggleNext-content">
          {button_link class='removeFacebookPage warning' label={translate 'Remove'} icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
        </div>
      </li>
    {/foreach}
  </ul>
  {paging paging=$facebookPageList}

{/block}
