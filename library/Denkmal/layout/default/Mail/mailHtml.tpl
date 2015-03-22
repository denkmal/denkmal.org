<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  </head>
  <body style="margin: 10px 20px">

    {img path="logo.png" title=$siteName height="50"}

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
  </body>
  <style type="text/css">
    {less}
    p, td, h1, li {
      font-family: @fontFamily;
      font-size: @fontSize;
      color: @colorFg;
    }

    h1 {
      margin: 0;
      font-size: 16px;
      font-weight: bold;
    }

    a {
      color: @colorFgLink;
      text-decoration: none
    }

    a:hover {
      text-decoration: underline;
    }
    {/less}
  </style>
</html>
