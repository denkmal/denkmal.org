{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  <p class="responsive-text intro">
    {translate '.meta.description' siteName=$render->getSite()->getName()|escape}
  </p>
  <ul class="regions">
    {foreach $siteList as $site}
      <li class="region">
        <div class="region-inner">
          <a class='circle' href="{$render->getUrlPage('Denkmal_Page_Index', [], $site)}" style="background-image: url({resourceUrl path='img/city-thumb.jpg' type='layout' site=$site})">
            <div>
              <span class="label">{$site->getRegion()->getName()|escape}</span>
              <div class="country">{$site->getRegion()->getLocation()->getAbbreviation(CM_Model_Location::LEVEL_COUNTRY)}</div>
            </div>
          </a>
        </div>
      </li>
    {/foreach}
  </ul>
  <div class="contact">
    <hr>
    <p>{translate 'Want to bring {$siteName} to your city? <a href="{$urlEmail}">Contact us</a>.' siteName=$render->getSiteName() urlEmail="mailto:{$render->getSite()->getEmailAddress()}"}</p>
  </div>
{/block}
