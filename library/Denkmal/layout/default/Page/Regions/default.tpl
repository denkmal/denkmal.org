{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  TODO: Select your region
  <ul>
    {foreach $siteList as $site}
      <li>
        <a href="{$render->getUrlPage('Denkmal_Page_Index', [], $site)}">
          {$site->getRegion()->getName()|escape}
        </a>
      </li>
    {/foreach}
  </ul>
{/block}
