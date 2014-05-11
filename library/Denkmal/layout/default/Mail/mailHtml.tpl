<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  </head>
  <body style="margin: 0px">

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
    {literal}
    h1 {
      margin: 0;
      font-size: 16px;
      font-weight: bold;
      color: #333;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    p, td {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 12px;
      color: #333;
    }

    a {
      color: #0a7bc3;
      text-decoration: none
    }

    a:hover {
      text-decoration: underline;
    }

    {/literal}
  </style>
</html>
