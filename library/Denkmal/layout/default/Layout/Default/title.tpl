{extends file=$render->getLayoutPath('Layout/Abstract/title.tpl', 'CM')}

{block name='title' append}{if strlen($pageTitle)} - {/if}{$render->getSiteName()} {translate 'Eventkalender'}{/block}
