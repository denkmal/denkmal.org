node default {

  $domain = "denkmal.dev"

  cm::application{'denkmal.org':
    path => '/app/denkmal.org',
    web => true,
    vhosts => {
      "www.${domain}" => {
        aliases => ["denkmal.dev", "admin.${domain}"],
        cdn_origin => "origin-www.${domain}",
      }
    },
  }

}
