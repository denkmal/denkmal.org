{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  TODO: Select your region
  <ul>
    {foreach $siteList as $site}
      <li>
        Name: {$site->getRegion()->getName()|escape}
        Link: {$render->getUrlPage('Denkmal_Page_Index', [], $site)}
      </li>
    {/foreach}
  </ul>
{/block}
