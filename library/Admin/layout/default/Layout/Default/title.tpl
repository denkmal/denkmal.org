{extends file=$render->getLayoutPath('Layout/Abstract/title.tpl', 'CM')}

{block name='title' append}{if strlen($pageTitle)} - {/if}Admin {$render->getSiteName()}{/block}
