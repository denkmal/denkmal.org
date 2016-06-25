<div class="openerDropdown languageSelector">
  <a href="javascript:;" class="openerDropdown-panel">
    {if $region}{$region->getName()|escape}{else}{translate 'Select your region'}{/if}
  </a>
  <div class="openerDropdown-window flyout triangle-bottom">
    <ul class="menu-sub">
      {if $layoutViewResponse = $render->getGlobalResponse()->getClosestViewResponse('CM_Layout_Abstract')}
        {$page = $layoutViewResponse->get('page')}
      {else}
        {$page = $render->getGlobalResponse()->getClosestViewResponse('CM_Page_Abstract')->getView()}
      {/if}
      {foreach $itemList as $item}
        <li class="{if $item['current']}current{/if}">
          <a href="{$render->getUrlPage($page, $page->getParams()->getParamsEncoded(), $item['site'])}">
            <span class="label">
               {if $item['region']}
                 {$item['region']->getName()|escape}
               {else}
                 {translate 'No region'}
               {/if}
            </span>
            {if $item['current']}<span class="icon-check"></span>{/if}
          </a>
        </li>
      {/foreach}
    </ul>
  </div>
</div>
