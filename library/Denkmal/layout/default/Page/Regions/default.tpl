{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <ul class="regions">
    {foreach $siteList as $site}
      <li class="region">
        <div class="region-inner">
          <a class='circle' href="{$render->getUrlPage('Denkmal_Page_Index', [], $site)}">
            <div>
              <span class="label">{$site->getRegion()->getName()|escape}</span>
              <div class="country">{$site->getRegion()->getLocation()->getAbbreviation(CM_Model_Location::LEVEL_COUNTRY)}</div>
            </div>
          </a>
        </div>
      </li>
    {/foreach}
  </ul>
  <p class="contact">{translate 'Do you want to bring Denkmal.org to your city? <a href="{$urlEmail}">Contact us</a>.' urlEmail="mailto:{$render->getSite()->getEmailAddress()}"}</p>
{/block}
