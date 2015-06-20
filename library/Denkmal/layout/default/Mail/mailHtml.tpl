{extends file=$render->getLayoutPath('Mail/mailHtml.tpl', 'CM')}

{block name='content'}
  <table style="width: 100%;">

    <tr>
      <td class="header" style="text-align: center;">
        <a href="{linkUrl page=Denkmal_Page_Index}" style="display: inline-block;">
          {img path="logo.png" title=$siteName height="50"}
        </a>
      </td>
    </tr>

    <tr>
      <td class="content">
        <p>
          {translate 'Oi!'}
        </p>
        <p>
          {$body}
        </p>
        <p>
          {translate 'Have fun'},<br />
          {$siteName}
        </p>
      </td>
    </tr>

  </table>
{/block}
